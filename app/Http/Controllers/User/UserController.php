<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizzas = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home', compact('pizzas','category','cart','history'));
    }

    //Direct user list page
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list', compact('users'));
    }

    //change user role
    public function userChangeRole(Request $request){
        User::where('id',$request->user_id)->update([
            'role' => $request->role
        ]);
    }

    //user password change page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //user password change
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
            return redirect()->route('user#changePasswordPage')->with(['changeSuccess' => 'Password successfully changed!']);
        }
        return back()->with(['notMatch' => 'The old password not match! Try again!']);
    }

    // user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    // user account update
    public function accountUpdate(Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',Auth::user()->id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('user#accountUpdate')->with(['updateSuccess' => 'User account updated!']);
    }

    // filter
    public function filter($id){
        $pizzas = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home', compact('pizzas','category','cart','history'));
    }

    // Direct pizza details page
    public function pizzaDetails($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    // cart list
    public function cartList(){
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image')
                          ->leftJoin('products','products.id','carts.product_id')
                          ->where('carts.user_id',Auth::user()->id)
                          ->get();
        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty;
        }
        return view('user.main.cart',compact('cartList', 'totalPrice'));
    }

    //history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history', compact('order'));
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

    // password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|same:newPassword'
        ])->validate();
    }
}
