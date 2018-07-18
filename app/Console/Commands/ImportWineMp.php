<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Maatwebsite\Excel\Facades\Excel;
use App\Vendor;
use App\Product;
use App\Category;
use App\VatRate;
class ImportWineMp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:wine-mp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products to wine-mp';

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
                //print_r($result);
                $barcode_simple = $result['kod_kreskowy'];
                $barcode_simple = escape_like($result['kod_kreskowy']);
                
                $vendor = Vendor::where('name', $result['producent'])->first();
                if($vendor) {
                    $vendor = $vendor->id;
                } else {
                    $vendor = Vendor::where('name', 'All')->first()->id;
                }

                $this->info($result['nazwa'] . ' - ' . $result['producent'] . ' - ' . $result['wys_vat'] . ' - ' . $result['marka']);

                $category = Category::where('name', $result['marka'])->first();
                if(!$category) {
                    $category = Category::where('name', 'All')->first()->id;
                } else {
                    $category = Category::where('name', $result['marka'])->first()->id;
                }

                Product::create([
                    'name' => $result['nazwa'],
                    'symbol' => $result['symbol'],
                    'barcode' => ($result['kod_kreskowy']) ? $result['kod_kreskowy'] : 1,
                    'barcode_simple' => $barcode_simple,
                    'pkwiuCode' => 0,
                    'weight' => 0,
                    'height' => 0,
                    'width' => 0,
                    'depth' => 0,
                    'meta_description' => $result['opis_zast'],
                    'meta_keywords' => 0,
                    'url' => 0,
                    'vendor' => $vendor,
                    'visibility' => intval($result['status']),
                    'vat_rate' => VatRate::where('rate', $result['wys_vat'])->first()->id,
                    'shortDescription' => 0,
                    'longDescription' => 0,
                    'price' => $result['cena_det_brutto'],
                    'main_category' => $category,
                    'stockAvail' => 0,
                    'attributeSets' => 0,
                    'variantSets' => 0,
                    'selectedVariantSet' => 0,
                    'stock' => 1,
                    'wholesale_price' => 0

                ]);
                
            }
        
        });
    }
}
