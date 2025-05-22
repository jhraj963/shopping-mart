<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Darryldecode\Cart\Facades\CartFacade as Cart;
use Cart;
use Auth;
use DB;
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
        'options'=>['size'=>$request->size, 'color'=>$request->color, 'thumbnail'=> $product->thumbnail ?? 'no_image.jpg', 'tax' => 0]
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


    //Add Wishlist
    public function AddWishlist($id)
    {

        if (Auth::check()) {
            $check = DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();
            if ($check) {
                return redirect()->back()->with('error', 'Already have it on your wishlist !');
            } else {
                $data = array();
                $data['product_id'] = $id;
                $data['user_id'] = Auth::id();
                $data['date'] = date('Y-m-d');
                DB::table('wishlists')->insert($data);;
                return redirect()->back()->with('success', 'Product added on wishlist!');
            }
        }
        return redirect()->back()->with('error', 'Login Your Account!');
    }

    //My Wishlist
    public function MyWishlist()
    {
        if(Auth::check()){

        $wishlist=DB::table('wishlists')->leftJoin('products', 'wishlists.product_id','products.id')->select('products.name','products.thumbnail','products.slug','wishlists.*')->where('wishlists.user_id', Auth::id())->get();

        return view('frontend.cart.wishlist', compact('wishlist'));
    }
        return redirect()->back()->with('error', 'Login Your Account!');
    }

    //My Wishlist Clear
    public function ClearWishlist()
    {
        DB::table('wishlists')->where('user_id', Auth::id())->delete();
        return redirect()->to('/')->with('success', 'Wishlist Cleared');
    }

    //My Wishlist Product Delete
    public function WishlistProductDelete($id)
    {
        DB::table('wishlists')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Removed From Wishlist');
    }

}
