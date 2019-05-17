<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;

class CartController extends Controller
{
    public function __construct()
    {

    }
    
    public function index()
    {
        return view('carts.indexcarts');
    }

    public function add($id)
    {
        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }

        $cart = session()->get('cart');

        if(!$cart) {
            $cart = [
                $id => [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image_src" => $product->images()->first()->image_src
            ]
        ];

        session()->put('cart', $cart);

        return redirect('/carts')->with('success', 'Product added to cart successfully!');
        }

        //
        if(isset($cart[$id])){
            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return redirect('/carts')->with('success', 'Product added to cart successfully!');
        }

        //
        $cart[$id] = [

                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image_src" => $product->images()->first()->image_src
        ];

        session()->put('cart', $cart);

        return redirect('/carts')->with('success','Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id and $request->quantity) { 
        
            $cart = session()->get('cart');

            $cart[$request->id]['quantity'] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success','Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
        {
             $cart = session()->get('cart');

                 if(isset($cart[$request->id])) {
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);  
                 }

                 session()->flash('success', 'Product removed successfully');
             }
         }
    }
}