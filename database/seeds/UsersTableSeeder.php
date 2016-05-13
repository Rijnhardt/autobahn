<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Rijnhardt Kotze',
            'email' => 'rhino.kotze@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
