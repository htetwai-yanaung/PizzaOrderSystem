<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //direct contact page
    public function contactPage(){
        return view('user.contact.message');
    }

    // send message
    public function sendMessage(Request $request){
        $this->contactValidationCheck($request);
        Contact::create($request->all());
        return redirect()->route('user#home');
    }

    // admin message page
    public function messagePage(){
        $message = Contact::paginate(5);
        return view('admin.user.message', compact('message'));
    }

    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return redirect()->route('admin#messagePage');
    }

    // contact validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ])->validate();
    }
}
