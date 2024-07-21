<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Product::factory()->create([
            'name' => 'Test User',
            'desc' => '111111111111111111111111',
            'image' => 'noimage_50x50.gif',
            'type' => 'ttttttt',
            'qty' => '1000',
            'price' => '100000'
        ]);
        
    }
}
