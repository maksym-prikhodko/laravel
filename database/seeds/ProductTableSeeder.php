<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 'product', 10)->create()->each(function($product){
            $type = App\ProductType::all()->random(1)->first();
            $type->product()->save($product);
        });
    }
}
