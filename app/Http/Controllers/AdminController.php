<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    // change password
    public function changePassword(Request $request){
        /*
            1. all field must be filled
            2. new password and confirm password length must be greater than 6
            3. new pw and confirm pw must same
            4. client old password must same with db password
            5. password change
        */
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbPassword = $user->password;
        if(Hash::check($request->oldPassword, $dbPassword)){
            User::where('id',$currentUserId)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return redirect()->route('category#list')->with(['changeSuccess' => 'Password successfully changed!']);
        }
        return back()->with(['notMatch' => 'The old password not match! Try again!']);
    }

    // direct admin details page
    public function details() {
        return view('admin.account.details');
    }

    // direct admin edit page
    public function edit() {
        return view('admin.account.edit');
    }

    // update account
    public function update($id,Request $request){

        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            // 1. take old image name
            // 2. check => delete
            // 3. store
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin account updated!']);
    }

    // admin list
    public function list(){
        $admin = User::when(request('key'),function($query) {
            $query->orwhere('name','like','%'.request('key').'%')
                  ->orwhere('email','like','%'.request('key').'%')
                  ->orwhere('gender','like','%'.request('key').'%')
                  ->orwhere('phone','like','%'.request('key').'%')
                  ->orwhere('address','like','%'.request('key').'%');
        })->where('role','admin')->paginate(3);

        $admin->appends(request()->all());
        return view('admin.account.adminList',compact('admin'));
    }

    // delete admin account
    public function delete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess' => 'Admin account deleted!']);
    }

    // change role
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    // change
    public function change($id,Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }










    // account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ])->validate();
    }

    // request user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

    private function requestUserData($request){
        return [
            'role' => $request->role,
        ];
    }

    // password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword'
        ])->validate();
    }
}
