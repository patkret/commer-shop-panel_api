<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\OrderStatus::create([
            'name'=> 'nowe',
            'type'=> 1,
            'active'=> 1,
            'tag_color' => 'BlueViolet',
            'email_notification' => 1
        ]);

        \App\OrderStatus::create([
            'name'=> 'w realizacji',
            'type'=> 2,
            'active'=> 1,
            'tag_color' => 'DarkOrange',
            'email_notification' => 1
        ]);

        \App\OrderStatus::create([
            'name'=> 'zrealizowane',
            'type'=> 3,
            'active'=> 1,
            'tag_color' => 'MediumSeaGreen',
            'email_notification' => 1
        ]);

        \App\OrderStatus::create([
            'name'=> 'niezrealizowane',
            'type'=> 4,
            'active'=> 1,
            'tag_color' => 'Tomato',
            'email_notification' => 1
        ]);
    }
}
