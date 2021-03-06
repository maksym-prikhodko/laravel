<?php

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
        $this->call(ProductTypeTableSeeder::class);
        $this->call(ProductAttributeTableSeeder::class);
        $this->call(ProductTableSeeder::class);
    }
}
