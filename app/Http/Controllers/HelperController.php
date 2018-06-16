<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Product;
use App\Client;


class HelperController extends Controller
{
    public function panelSearch(Request $request) {

        $query = escape_like($request['search']);

        $searchNameValues = preg_split('/\s+/', $request['search'], -1, PREG_SPLIT_NO_EMPTY);


        $products = Product::where(function ($q) use ($searchNameValues, $query) {
            foreach ($searchNameValues as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })
            ->orWhere('barcode_simple', 'LIKE', '%'. $query . '%')
            ->orWhere('price', 'LIKE', '%' . $query . '%')
            ->limit(3)
            ->get();

//        $products = Product::where('name', 'LIKE', '%' . $query . '%')
//            ->orWhere('barcode_simple', 'LIKE', '%'. $query . '%')
//            ->orWhere('price', 'LIKE', '%' . $query . '%')
//            ->limit(3)
//            ->get();
//
        $input = '%' .$request['search'] . '%';

        $clients = Client::where('email', 'like', $input)
            ->orWhere('first_name', 'like', $input)
            ->orWhere('last_name', 'like', $input)
            ->orWhere('company', 'like', $input)
            ->orWhere('street', 'like', $input)
            ->orWhere('nip', 'like', $input)
            ->limit(3)
            ->get();

        $result = [ 'clients' => $clients, 'products' => $products];

        return $result;
    }

}
