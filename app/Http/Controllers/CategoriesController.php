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
        return Category::paginate(10);
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

        $last_insert_id = DB::table('information_schema.tables')
            ->where('table_name', 'categories')
            ->whereRaw('table_schema = DATABASE()')
            ->select('AUTO_INCREMENT')->first()->AUTO_INCREMENT-1;

        $subcategory_id = $request->selectedCategory;

       if(isset($last_insert_id))
       {
           Category::where('id', $last_insert_id)->update(['parent_id' => $subcategory_id]);
       }
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

        Category::find($id)->update($request->all());

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
}
