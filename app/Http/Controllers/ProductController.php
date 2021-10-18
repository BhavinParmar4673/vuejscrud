<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all()->toarray();
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' =>'required',
            'description' =>'required|max:255',
            'path' => 'mimes:jpeg,jpg,png,gif|required'
        ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $path = $request->file('path')->store('path');

        $product = new Product([
            'title' =>$title,
            'description' =>$description,
            'path' =>$path,
        ]);

        $product->save();
        return response()->json('Product Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findorFail($id);
        return response()->json($product);
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
        $product = Product::findorFail($id);

        $title = $request->input('title');
        $description = $request->input('description');


        $product->title = $title;
        $product->description = $description;

        if ($request->file('path')){
            Storage::delete($product->path);
            $path = $request->file('path')->store('path');
            $product->path = $path;
        }


        $product->save();
        return response()->json('Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorFail($id);
        $product->delete();

        return response()->json('Product deleted');
    }
}
