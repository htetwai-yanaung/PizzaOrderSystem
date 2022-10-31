<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    // get all product list
    public function productList(){
        $products = Product::get();
        return response()->json($products, 200);
    }

    public function categoryList(){
        $category = Category::orderBy('created_at','desc')->get();
        return response()->json($category, 200);
    }

    public function userList(){
        $user = User::get();
        return response()->json($user, 200);
    }


    //create category
    public function categoryCreate(Request $request){
        // dd($request->header('headerData'));
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $response = Category::create($data);
        return response()->json($response, 200);
    }

    // create contact
    public function createContact(Request $request){
        $data = $this->getContactData($request);
        Contact::create($data);
        $contact = Contact::orderBy('created_at','desc')->get();
        return response()->json($contact, 200);
    }

    // delete category
    public function deleteCategory($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status' => true,'message' => 'delete success', 'delete_data' => $data], 200);
        }

        return response()->json(['status' => false,'message' => 'there is no category'], 200);
    }

    // category details
    public function categoryDetails($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            return response()->json(['status' => true, 'message' => $data], 200);
        }
        return response()->json(['status' => false,'message' => 'there is no category'], 500);
    }

    // update category
    public function categoryUpdate(Request $request){

        $dbSource = Category::where('id',$request->category_id)->first();

        if($dbSource){
            $data = $this->getCategoryData($request);
            Category::where('id',$request->category_id)->update($data);
            $response = Category::where('id',$request->category_id)->first();
            return response()->json(['status' => true, 'message' => 'category update success', 'category' => $response], 200);
        }

        return response()->json(['status' => false,'message' => 'There is no category for update'], 500);
    }








    //get contact data
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->description,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    //get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now()
        ];
    }
}
