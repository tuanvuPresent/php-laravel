<?php

use Illuminate\Database\Seeder;

class TypeProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\TypeProduct', 10)->create();
    }
}
