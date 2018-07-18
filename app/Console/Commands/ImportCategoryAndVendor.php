<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Vendor;
use App\Category;
use App\Warehouse;
use App\VatRate;

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

		Category::create([
			'name' => 'All'
		]);

		VatRate::create([
			'rate' => 23
		]);

		VatRate::create([
			'rate' => 3
		]);

		VatRate::create([
			'rate' => 2
		]);

		VatRate::create([
			'rate' => 5
		]);

		VatRate::create([
			'rate' => 8
		]);

		VatRate::create([
			'rate' => 22
		]);

		VatRate::create([
			'rate' => 7
		]);

		Vendor::create([
			'name' => 'All'
		]);

        Excel::load($pathToFile, function($reader) {

   
			$results = $reader->all();
			foreach($results->toArray() as $result) {
				if($result['marka']!=null){
					$category = Category::where('name', $result['producent'])->first();
					if(!$category) {
						Category::create([
							'name' => $result['marka']
						]);
					}

				}
				if($result['producent']!=null){

					$vendor = Vendor::where('name', $result['producent'])->first();
					if(!$vendor) {
						Vendor::create([
							'name' => $result['producent']
						]);
					}

			
				}
				if($result['nazwa']==null){
					$result['nazwa'] = 'brak';
				}


				Warehouse::create([
					'name' => $result['nazwa']
				]);
				
				$this->info('added: ' . $result['nazwa']);

			}
			
		});
	}
}

