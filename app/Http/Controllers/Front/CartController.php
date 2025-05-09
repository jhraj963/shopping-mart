<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
// use Cart;

use App\Models\Product;

class CartController extends Controller
{
    // add to cart
    public function AddToCartQV(Request $request)
    {
        $product=Product::where('id',$request->id)->first();
        Cart::add([
        'id'=>$product->id,
        'name'=>$product->name,
        'quantity'=>$request->quantity,
        'price'=>$request->price,
        'weight'=>'1',
        'options'=>['size'=>$request->size, 'color'=>$request->color, 'thumbnail'=>$product->thumbnail]
        ]);

        return response()->json("Ado To Cart Successfully");

    }

    //all cart
    public function AllCart()
    {
        $data = array();
        $data['cart_qty'] = Cart::count();
        $data['cart_total'] = Cart::total();
        return response()->json($data);
    }

    //Show My Cart
    public function MyCart()
    {
        $content=Cart::getContent();
        return view('frontend.cart.cart',compact('content'));
    }

}
