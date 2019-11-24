<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_type')->updateOrInsert([
            'name' => 'phone',
        ], [
            'name' => 'phone',
        ]);
        DB::table('product_type')->updateOrInsert([
            'name' => 'pad',
        ], [
            'name' => 'pad',
        ]);
        DB::table('product_type')->updateOrInsert([
            'name' => 'laptop',
        ], [
            'name' => 'laptop',
        ]);
        DB::table('product_type')->updateOrInsert([
            'name' => 'camera',
        ], [
            'name' => 'camera',
        ]);
    }
}
