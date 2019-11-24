<?php

use Illuminate\Database\Seeder;

class ProductAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_attribute')->updateOrInsert([
            'name' => 'price',
        ], [
            'name' => 'price',
        ]);
        DB::table('product_attribute')->updateOrInsert([
            'name' => 'weight',
        ], [
            'name' => 'weight',
        ]);
        DB::table('product_attribute')->updateOrInsert([
            'name' => 'size',
        ], [
            'name' => 'size',
        ]);
        DB::table('product_attribute')->updateOrInsert([
            'name' => 'color',
        ], [
            'name' => 'color',
        ]);

        foreach (\App\ProductType::all() as $type) {
            $attributes = App\ProductAttribute::all()->random(3);
            foreach ($attributes as $attribute){
                $type->atts()->save($attribute);
            }
        }
    }
}
