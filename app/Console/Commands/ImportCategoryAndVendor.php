<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Vendor;
use App\Category;
use App\Warehouse;
class ImportCategoryAndVendor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:vendorcategory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import vendor and category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pathToFile = storage_path('app/towary.csv');


        Excel::load($pathToFile, function($reader) {

   
            $results = $reader->all();
            foreach($results->toArray() as $result) {
        if($result['marka']==null){
            $result['marka'] = 'brak';
        }
        if($result['producent']==null){
            $result['producent'] = 'brak';
        }
        if($result['nazwa']==null){
            $result['nazwa'] = 'brak';
        }
        Vendor::create([
            'name' => $result['producent']
        ]);
        Category::create([
            'name' => $result['marka']
        ]);
        Warehouse::create([
            'name' => $result['nazwa']
        ]);
        
        print_r('done');

    }
        
});
}
}

