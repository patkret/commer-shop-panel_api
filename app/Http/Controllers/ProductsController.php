<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Log;

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


    public function store(Request $request, Product $product)
    {
        $new_product = $request->product;

        $new_product['barcode_simple'] = escape_like($new_product['barcode']);

        $created = Product::create($new_product);
        $created->categories()->attach($new_product['categories']);

        Log::createNew($product->mod_id, $created->name, 'add');

        return $created;
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
        $name_before_update = $product->name;
        $product->update($request->product);
        $product->categories()->sync($request->categories);

        Log::createNew($product->mod_id, $name_before_update, 'edit');

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

        Log::createNew($product->mod_id, $product->name, 'delete');

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

    public function deleteAll($products, Product $product)
    {

        $products = json_decode($products);
        Product::destroy($products);

        foreach ($products as $deleted_product) {

            $product = Product::where('id', $deleted_product)->first();

            Log::createNew($product->mod_id, $product['name'], 'delete');
        }

    }

    public function numberOfProducts()
    {

        $noOfProducts = DB::table('products')->count();
        return $noOfProducts;
    }

    public function changeVisibility(Request $request, Product $product)
    {
        $ids = $request->ids;
        $visibility = $request->visibility;
        Product::whereIn('id', $ids)
            ->update(['visibility' => $visibility]);

        foreach ($ids as $id) {

            $prod = $product->where('id', $id)->first();
            Log::createNew($product->mod_id, $prod['name'], 'editVisibility');
        }
    }

    public function changeMainCategory(Request $request, Product $product)
    {
        $ids = $request->ids;
        $main_category_id = $request->main_category;
        Product::whereIn('id', $ids)
            ->update(['main_category' => $main_category_id]);

        foreach ($ids as $id) {

            $prod = $product->where('id', $id)->first();
            Log::createNew($product->mod_id, $prod['name'], 'editMainCategory');
        }
    }

    public function changeVendor(Request $request, Product $product)
    {
        $ids = $request->ids;
        $vendor_id = $request->vendor;
        Product::whereIn('id', $ids)
            ->update(['vendor' => $vendor_id]);

        foreach ($ids as $id) {

            $prod = $product->where('id', $id)->first();
            Log::createNew($product->mod_id, $prod['name'], 'editVendor');
        }
    }

    public function changePrice(Request $request, Product $product)
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

        foreach ($ids as $id) {

            $prod = $product->where('id', $id)->first();
            Log::createNew($product->mod_id, $prod['name'], 'editPrice');
        }

    }

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
