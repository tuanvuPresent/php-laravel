<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        Model::unguard(); // Disable mass assignment

        $this->call(TypeProductTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(UserTableSeeder::class);

        Model::reguard(); // Enable mass assignment
    }
}
