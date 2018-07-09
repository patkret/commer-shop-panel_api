<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Maatwebsite\Excel\Facades\Excel;


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
                print_r($result);

                // Product::create([
                //     'name' => $result['nazwa'],
                // ]);
            }
        
        });
    }
}
