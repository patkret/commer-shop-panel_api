<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
	public function createCategory($mainOrder, $parent)
	{
		$faker = \Faker\Factory::create('pl_PL');
		return \App\Category::create([
			'name' => $faker->sentence(1),
			'photo' => '',
			'visibility' => 1,
			'parent_id' => $parent,
			'order_no' => $mainOrder,
            'page_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'url' => '',
		]);
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$mainOrder = 1;
    	$subOrder = 1;
        for($i = 0; $i < 12; $i++) {
        	if($mainOrder === 1) {
        		$this->createCategory(1, 0);
	        } else if($mainOrder > 1 && $mainOrder < 5) {
		        $this->createCategory($subOrder, 1);
	        } else if($mainOrder === 5) {
		        $this->createCategory(2, 0);
	        } else if($mainOrder > 5) {
		        $this->createCategory($subOrder, 5);
	        }
	        $mainOrder++;
	        $subOrder++;
        }
    }
}
