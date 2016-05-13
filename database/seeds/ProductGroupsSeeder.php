<?php

use Illuminate\Database\Seeder;

class ProductGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_groups')->insert([
            'name' => 'Food',
            'order' => 1
        ]);
        
        DB::table('product_groups')->insert([
            'name' => 'Drinks',
            'order' => 2
        ]);
        
        DB::table('product_groups')->insert([
            'name' => 'Extras',
            'order' => 3
        ]);
        
        DB::table('product_groups')->insert([
            'name' => 'Sweets',
            'order' => 4
        ]);
    }
}
