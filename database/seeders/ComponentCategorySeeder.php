<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ComponentCategory;

class ComponentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'CPU', 'slug' => 'cpu'],
            ['name' => 'RAM', 'slug' => 'ram'],
            ['name' => 'GPU', 'slug' => 'gpu'],
            ['name' => 'Case', 'slug' => 'case'],
            ['name' => 'Storage', 'slug' => 'storage'],
        ];

        foreach ($categories as $category) {
            ComponentCategory::create($category);
        }
    }
}