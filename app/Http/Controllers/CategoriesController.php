<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Log;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    private function buildTree($elements, $parentId = 0) {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
//                dump($element['id']);
//                dump($children);
                if ($children) {

                    $element['children'] = $children;
                }
                $branch[] = $element;
                unset($elements[$element['id']]);
            }
        }
        return $branch;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  Category::orderBy('order_no', 'ASC')
					        ->get();

        $categoriesTree = $this->buildTree($categories->toArray());

        return $categoriesTree;

//        $categoriesTree = [];
//		$i = 0;
//        foreach($categories as $category) {
//			$categoriesTree[] = $category->toArray();
//
//			$children = Category::where('parent_id', $category->id)
//		                    ->orderBy('order_no', 'ASC')
//		                    ->get();
//			foreach($children as $child) {
//				$categoriesTree[$i]['children'][] = $child->toArray();
//			}
//			$i++;
//
//       return $categoriesTree;
    }

    public function saveOrders(Request $request)
    {
    	$orderMain = 1;
    	foreach($request->get('categories') as $category) {
		    $categoryObject = Category::find($category['id']);
		    $categoryObject->update([
		    	'order_no' => $orderMain,
			    'parent_id' => 0
		    ]);
		    if(isset($category['children'])) {
			    foreach ( $category['children'] as $child ) {
				    $categoryChildObject = Category::find( $child['id'] );
				    $categoryChildObject->update( [
					    'order_no'  => $orderMain,
					    'parent_id' => $categoryObject->id
				    ] );
				    $orderMain ++;
			    }
		    }

		    $orderMain++;
	    }

		return ['status' => 'ok'];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Category $category)
    {
        $all = $request->all();
    	if(intval($all['parent_id']) > 0) {
    	    $lastCategory = Category::orderBy('order_no', 'DESC')
		                        ->first();
		    $all['order_no'] = ++$lastCategory->order_no;
	    } else {
		    $all['order_no'] = 0;
		    $all['parent_id'] = 0;
	    }
        Category::create($all);

        Log::createNew($category->module_id, 'add');

	    return ['status' => 'ok'];
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
        $category->update($request->editedCategory);

        Log::createNew(Category::MODULE_ID, 'edit');
        return $category;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$category->delete();
        function kill($id) {
            if(Category::where('parent_id', $id)->count()) {
                foreach (Category::where('parent_id', $id)->get() as $child) {
                    kill($child->id);
                }
            }
                Category::destroy($id);
            Log::createNew(Category::MODULE_ID, 'delete');
        }

        kill($id);

//        Category::destroy($id);

    }

    public function duplicate($id){
        $current_category = Category::find($id);

        function duplicate($id, $newParent) {
            $duplicate_category = Category::find($id)->replicate();
            $duplicate_category->name = $duplicate_category->name.'_copy';
            $duplicate_category->parent_id = $newParent;
            $duplicate_category->save();

            if(Category::where('parent_id', $id)->count()) {
                foreach (Category::where('parent_id', $id)->get() as $child) {
                    duplicate($child->id, $duplicate_category->id);
                }
            }

        }

        duplicate($id, 0);

        Log::createNew(Category::MODULE_ID, 'duplicate');
//        $category_subcategories = Category::where('parent_id', $id)->get();
        
//        $duplicate_category = $current_category->replicate();
//        $duplicate_category->name = $duplicate_category->name.'_copy';
//        $duplicate_category->save();
    }

    public function getCategory($id){

        $category = Category::where('id', $id)->first();

        $children = Category::where('parent_id', $id)->get();

        $category['children'] = $children;

        return $category;
    }

    public function getParent($id){

        $parent_id = Category::where('id', $id)->value('parent_id');

        $parent = Category::where('id', $parent_id)->first();

        return $parent;
    }

    public function getAllCategories(){

        return Category::all();
    }

    public function getAttributeSets($id) {

        $category = Category::with('attributeSets')->where('id', $id)->first();

        return $category;
    }



}
