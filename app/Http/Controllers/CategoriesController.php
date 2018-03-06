<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  Category::all();

        $categoriesTree = [];

        foreach($categories as $category) {
            if($category->parent_id) {
                $categoriesTree[$category->parent_id]['children'][] = $category->toArray();
            } else {
                $categoriesTree[$category->id] = $category->toArray();
            }
        }

       return $categoriesTree;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Category::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $category = Category::find($id);

        $category->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::destroy($id);

    }

    public function duplicate($id){
        $current_category = Category::find($id);
//        $category_subcategories = Category::where('parent_id', $id)->get();
        
        $duplicate_category = $current_category->replicate();
        $duplicate_category->name = $duplicate_category->name.'_copy';
        $duplicate_category->save();
    }

    public function getCategory($id){

        $category = Category::where('id', $id)->get();

        return $category;
    }

    public function getParent($id){

        $parent_id = Category::where('id', $id)->value('parent_id');

        $parent = Category::where('id', $parent_id)->get();

        return $parent;
    }



}
