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
        $products = Product::paginate(5);

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
     * @param  \Illuminate\Http\Request $request
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
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Product $product
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
     * @param  \App\Product $product
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

    public function getProduct($id)
    {
        $product = Product::where('id', $id)->first();

        return $product;
    }

    public function deleteAll($products)
    {

        $products = json_decode($products);
        Product::destroy($products);

    }

    public function numberOfProducts()
    {

        $noOfProducts = DB::table('products')->count();
        return $noOfProducts;
    }

    public function changeVisibility(Request $request)
    {
        $ids = $request->ids;
        $visibility = $request->visibility;
        Product::whereIn('id', $ids)
            ->update(['visibility' => $visibility]);
    }

    public function changeMainCategory(Request $request)
    {
        $ids = $request->ids;
        $main_category_id = $request->main_category;
        Product::whereIn('id', $ids)
            ->update(['main_category' => $main_category_id]);
    }

    public function changeVendor(Request $request)
    {
        $ids = $request->ids;
        $vendor_id = $request->vendor;
        Product::whereIn('id', $ids)
            ->update(['vendor' => $vendor_id]);
    }

    public function changePrice(Request $request)
    {
        $ids = $request->ids;

        if ($request->selectedPriceOption['id'] === 0) {
            if ($request->selectedCurr['id'] === 1) {
                Product::whereIn('id', $ids)
                    ->increment('price', $request->priceValue);
            } else {
                $price = $request->priceValue;
                $updatePrice = 1 + $price / 100;

                Product::whereIn('id', $ids)
                    ->update(['price' => DB::raw('round(price * ' . $updatePrice . ',2)')]);
            }
        } else {

            if ($request->selectedCurr['id'] === 1) {
                Product::whereIn('id', $ids)
                    ->decrement('price', $request->priceValue);
            } else {
                $price = $request->priceValue;
                $updatePrice = 1 - $price / 100;
                print_r($updatePrice);

                Product::whereIn('id', $ids)
                    ->update(['price' => DB::raw('round(price * ' . $updatePrice . ', 2)')]);
            }

        }

    }

//    public function sortByPriceAsc()
//    {
//        $products = Product::orderBy('price', 'asc')->get();
//
//        return $products;
//    }
//
//    public function sortByPriceDesc()
//    {
//        $products = Product::orderBy('price', 'desc')->get();
//
//        return $products;
//    }
//
//    public function sortByName()
//    {
//        $products = Product::orderBy('name', 'asc')->get();
//
//        return $products;
//    }
//
//    public function sortByRecentlyAdded()
//    {
//        $products = Product::orderBy('created_at', 'desc')->get();
//
//        return $products;
//    }

    public function getMaxPrice()
    {

        $max_price = Product::max('price');

        return $max_price;
    }

    public function filter(Request $request)
    {

        $orderby = $request->get('order_by');
        $order = $request->get('order');
        $rows = $request->get('rows');
        $price_from = $request->get('price_from', false);
        $price_to = $request->get('price_to', false);
        $vendor = $request->get('vendor', false);
        $category = $request->get('main_category', false);
        $visibility = $request->get('visibility', false);

        return Product::when($visibility != 'null', function ($query) use ($visibility) {
            return $query->where('visibility', 1);
            })
            ->when($vendor, function ($query) use ($vendor) {
                return $query->where('vendor', $vendor);
            })
            ->when($category, function ($query) use ($category) {
                return $query->where('main_category', $category);
            })
            ->when(($price_from && $price_to), function ($query) use ($price_from, $price_to) {
                return $query->whereBetween('price', [$price_from, $price_to]);
            })
            ->orderBy($orderby, $order)
            ->paginate($rows);
    }


}
