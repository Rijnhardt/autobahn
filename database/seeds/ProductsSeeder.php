<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /*
            Product Groups
            1 -- Food
            2 -- Drinks
            3 -- Extras
            4 -- Sweets
        */
        
        //1
        DB::table('products')->insert([
            'name' => 'Bacon & Egg Rolls',
            'price' => 22.0,
            'is_prepared' => true,
            'product_group_id' => 1
        ]);
        
        //2
        DB::table('products')->insert([
            'name' => 'Bacon Rolls',
            'price' => 18.0,
            'is_prepared' => true,
            'product_group_id' => 1
        ]);
        
        //3
        DB::table('products')->insert([
            'name' => 'Chicken prego',
            'price' => 23.0,
            'is_prepared' => true,
            'product_group_id' => 1
        ]);
        
        //4
        DB::table('products')->insert([
            'name' => 'Hamburger',
            'price' => 23.0,
            'is_prepared' => true,
            'product_group_id' => 1
        ]);
        
        //5
        DB::table('products')->insert([
            'name' => 'Bacon Burger',
            'price' => 26.0,
            'is_prepared' => true,
            'product_group_id' => 1
        ]);
        
        //6
        DB::table('products')->insert([
            'name' => 'Cheese',
            'price' => 3.0,
            'is_prepared' => true,
            'product_group_id' => 3
        ]);
        
        //7
        DB::table('products')->insert([
            'name' => 'Cheese & Salad Roll',
            'price' => 15.0,
            'is_prepared' => true,
            'product_group_id' => 1
        ]);
        
        //8
        DB::table('products')->insert([
            'name' => 'Hot Dogs',
            'price' => 15.0,
            'is_prepared' => true,
            'product_group_id' => 1
        ]);
        
        //9
        DB::table('products')->insert([
            'name' => 'Curry & Rice',
            'price' => 30.0,
            'is_prepared' => true,
            'product_group_id' => 1
        ]);
        
        //10
        DB::table('products')->insert([
            'name' => 'Cold Drinks',
            'price' => 12.0,
            'is_prepared' => false,
            'product_group_id' => 2
        ]);
        
        //11
        DB::table('products')->insert([
            'name' => 'Oros',
            'price' => 10.0,
            'is_prepared' => false,
            'product_group_id' => 2
        ]);
        
        //12
        DB::table('products')->insert([
            'name' => 'Water',
            'price' => 10.0,
            'is_prepared' => false,
            'product_group_id' => 2
        ]);
        
        //13
        DB::table('products')->insert([
            'name' => 'Powerade',
            'price' => 15.0,
            'is_prepared' => false,
            'product_group_id' => 2
        ]);
        
        //14
        DB::table('products')->insert([
            'name' => 'Ice Tea',
            'price' => 15.0,
            'is_prepared' => false,
            'product_group_id' => 2
        ]);
        
        //15
        DB::table('products')->insert([
            'name' => 'Tea & Cofffee',
            'price' => 8.0,
            'is_prepared' => false,
            'product_group_id' => 2
        ]);
        
        //16
        DB::table('products')->insert([
            'name' => 'Hot Chocolate',
            'price' => 10.0,
            'is_prepared' => false,
            'product_group_id' => 2
        ]);
        
        //17
        DB::table('products')->insert([
            'name' => 'Wine Gums',
            'price' => 8.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //18
        DB::table('products')->insert([
            'name' => 'Gomutcho Sweets',
            'price' => 7.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //19
        DB::table('products')->insert([
            'name' => 'Jellytots',
            'price' => 7.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //20
        DB::table('products')->insert([
            'name' => 'Chips',
            'price' => 7.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //21
        DB::table('products')->insert([
            'name' => 'Chocolates',
            'price' => 6,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //22
        DB::table('products')->insert([
            'name' => 'KitKat 2 Finger',
            'price' => 4.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //23
        DB::table('products')->insert([
            'name' => 'Wonderbar',
            'price' => 4.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //24
        DB::table('products')->insert([
            'name' => 'Filled liquorice',
            'price' => 3.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //25
        DB::table('products')->insert([
            'name' => 'Sour Strips',
            'price' => 3.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //26
        DB::table('products')->insert([
            'name' => 'Jelly Snake',
            'price' => 2.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //27
        DB::table('products')->insert([
            'name' => 'Sour Bombs x 2',
            'price' => 1.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //28
        DB::table('products')->insert([
            'name' => 'Black Crazy Balls x 2',
            'price' => 1.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //29
        DB::table('products')->insert([
            'name' => 'Toffee Eclairs x2',
            'price' => 1.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
        
        //30
        DB::table('products')->insert([
            'name' => 'Fizzers',
            'price' => 1.0,
            'is_prepared' => false,
            'product_group_id' => 4
        ]);
    }
}
