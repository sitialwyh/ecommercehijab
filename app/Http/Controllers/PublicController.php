<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_Review;
use Auth;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productInstance = new Product();
        $products = $productInstance->orderProducts($request->get('order_by'));
        // Apabila request ajax makaa akan return JSON
        if($request->ajax()){
            return response()->json($products, 200);
        }
        // Apabila request HTML makaa akan return HTML
        return view('public', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productReview = new product_review();
        $productReview->user_id = Auth::user()->id;
        $productReview->product_id = $request->post('product_id');
        $productReview->description = $request->post('description');
        $productReview->rating = $request->post('rating');
        
        if ($productReview->rating > 5) {
            return redirect('/')->with('error', 'Rating must be 1 - 5');
        }
        $productReview->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        $reviews = Product_Review::where('product_id',$product->id)->get();

        return view('lihat', compact('product','reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function image($imageName)
    {
        $filePath = storage_path(env('PATH_IMAGE').'product/'.$imageName);

        return Image::make($filePath)->response();
    }
}
