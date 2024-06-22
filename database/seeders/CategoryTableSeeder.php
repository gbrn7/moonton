<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Romance',
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate ut nulla ex iure sed hic, perferendis veniam omnis soluta numquam.'
            ],
            [
                'name' => 'Sci-fi',
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptate ut nulla ex iure sed hic, perferendis veniam omnis soluta numquam.'
            ],
        ]);
    }
}
