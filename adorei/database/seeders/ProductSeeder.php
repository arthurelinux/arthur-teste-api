<?php

namespace Database\Seeders;

use App\Models\Products;
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
        Products::create([
            'name' => 'Celular 1',
            'price' => 1800,
            'description' => 'Lorenzo Ipsulum'
        ]);

        Products::create([
            'name' => 'Celular 2',
            'price' => 3200,
            'description' => 'Lorem ipsum dolor'
        ]);

        Products::create([
            'name' => 'Celular 3',
            'price' => 9800,
            'description' => 'Lorem ipsum dolor sit amet'
        ]);
    }
}
