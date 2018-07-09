<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        $pathToFile = storage_path('app/towary.csv');

        Excel::load($pathToFile, function($reader) {

   
            $results = $reader->all();

            foreach($results->toArray() as $result) {
                print_r($result);
                die;
            }
        
        });
    }
}
