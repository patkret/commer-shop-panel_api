<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {

        $created = Product::create($request->product);
        $created->categories()->attach($request->categories);

        return ['status' => 1];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return array
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->product);
        $product->categories()->sync($request->categories);

        return ['status' => 1];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return ['status' => 1];
    }

    public function getMainCategories()
    {
        $mainCategories = Category::where('parent_id', '=', '0')->get();
        return $mainCategories;
    }

    public function getProduct($id){
       $product =  Product::where('id', $id)->first();

       return $product;
    }

    public function deleteAll($products){
        Product::destroy($products);
    }
}
