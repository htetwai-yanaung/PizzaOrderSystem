<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        logger($request->status);
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }
        return response()->json($data, 200);
    }

    // return pizza list
    public function addToCart(Request $request){
        $data = $this->requestOrderData($request);
        Cart::create($data);

        //changing to array format
        $response = [
            'message' => 'Add to cart complete',
            'status' => 'success'
        ];
        return response()->json($response, 200);
    }

    //order
    public function order(Request $request){
        $total = 3000;
        foreach($request->all() as $item){
            $data = OrderList::create($item);

            $total += $data->total;
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total,
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order complete'
        ], 200);
    }

    // clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //delete current product
    public function clearCurrentProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
              ->where('id',$request->order_id)
              ->delete();
    }

    // admin change role
    public function changeRole(Request $request){

        User::where('id',$request->user_id)->update([
            'role' => $request->role
        ]);
        return redirect()->route('admin#list');
    }

    //increase view count
    public function increaseViewCount(Request $request){

        $pizza = Product::where('id',$request->productId)->first();
        $viewCount = [
            'view_count' => $pizza->view_count + 1
        ];
        Product::where('id',$request->productId)->update($viewCount);
    }

















    // request order data
    private function requestOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
