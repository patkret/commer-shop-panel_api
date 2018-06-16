<?php

use Illuminate\Database\Seeder;
use App\PanelModule;

class PanelModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PanelModule::create([
            'name' => 'Kategoria',
        ]);

        PanelModule::create([
            'name' => 'Produkt',
        ]);

        PanelModule::create([
            'name' => 'Zamówienie',
        ]);

        PanelModule::create([
            'name' => 'Użytkownik',
        ]);

        PanelModule::create([
            'name' => 'Zestaw atrybutów',
        ]);

        PanelModule::create([
            'name' => 'Zestaw wariantów',
        ]);

        PanelModule::create([
            'name' => 'Stawka VAT',
        ]);

        PanelModule::create([
            'name' => 'Producent',
        ]);

        PanelModule::create([
            'name' => 'Magazyn',
        ]);

        PanelModule::create([
            'name' => 'Klient',
        ]);

        PanelModule::create([
            'name' => 'Strona informacyjna',
        ]);

    }
}
