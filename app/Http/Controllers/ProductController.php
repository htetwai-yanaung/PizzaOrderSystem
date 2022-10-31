<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product list
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at', 'desc')
        ->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList', compact('pizzas'));
    }

    // create page
    public function createPage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    // create pizza
    public function create(Request $request){
        $this->productValidationCheck($request,"create");
        $data = $this->requestProductInfo($request);

        // for image
        $fileName = uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //delete pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Product successfully deleted!']);
    }

    // edit page
    public function editPage($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                ->where('products.id',$id)
                ->leftJoin('categories','products.category_id','categories.id')
                ->first();
        $categories = Category::select('id','name')->get();
        return view('admin.product.edit',compact('pizza','categories'));
    }

    // pizza update page
    public function updatePage($id){
        $pizza = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('admin.product.update', compact('pizza','categories'));
    }

    // update pizza
    public function update(Request $request){
        $this->productValidationCheck($request,"update");
        $data = $this->requestProductInfo($request);

        if($request->hasFile('pizzaImage')){
            $oldImageName = Product::where('id',$request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $newImage = uniqid().$request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public',$newImage);
            $data['image'] = $newImage;
        }

        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list');
    }












    // request product information
    private function requestProductInfo($request){
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }

    // product validation check
    private function productValidationCheck($request,$action){
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId, //unique for different name
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required',
        ];

        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file';

        Validator::make($request->all(),$validationRules)->validate();
    }
}
