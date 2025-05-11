<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Darryldecode\Cart\Facades\CartFacade as Cart;
use Cart;

use App\Models\Product;

class CartController extends Controller
{
    // add to cart
    public function AddToCartQV(Request $request)
    {

        $product = Product::find($request->id);

        Cart::add([
        'id'=>$product->id,
        'name'=>$product->name,
        'qty'=>$request->quantity,
        'price'=>$request->price,
        'weight'=>'1',
        'options'=>['size'=>$request->size, 'color'=>$request->color, 'thumbnail'=> $product->thumbnail ?? 'no_image.jpg',]
        ]);
        // dd($product->thumbnail);
        return response()->json("Ado To Cart Successfully");

    }

    //all cart
    public function AllCart()
    {
        $data = array();
        $data['cart_qty'] = Cart::content()->count();
        $data['cart_total'] = Cart::total();
        return response()->json($data);
    }

    //Show My Cart
    public function MyCart()
    {

        $content=Cart::content();
        return view('frontend.cart.cart',compact('content'));
    }

    //Remove Product
    public function RemoveProduct($rowId)
    {
        Cart::remove($rowId);

        return response()->json("Romoved");
    }

    //Update Product
    public function UpdateQty($rowId, $qty)
    {
        Cart::update($rowId, ['qty'=> $qty]);

        return response()->json("Updated");
    }

    //Update Color
    public function UpdateColor($rowId, $color)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $size=$product->options->size;
        Cart::update($rowId, ['options'=> ['color'=> $color, 'thumbnail'=> $thumbnail, 'size'=>$size]]);

        return response()->json("Updated");
    }

    //Update size
    public function UpdateSize($rowId, $size)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $color=$product->options->color;
        Cart::update($rowId, ['options'=> ['color'=> $color, 'thumbnail'=> $thumbnail, 'size'=>$size]]);

        return response()->json("Updated");
    }

    //Cart Empty
    public function EmptyCart()
    {
        Cart::destroy();

        return redirect()->to('/')->with('error', 'You Cart Is Empty');
    }

}
