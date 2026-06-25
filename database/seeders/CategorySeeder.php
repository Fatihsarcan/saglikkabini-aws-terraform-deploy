<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Serum',
                'slug' => 'serum',
                'content' => 'Serum hizmeti',
                'image' => 'img/car1.jpg',
                'status' => 1,
                'childrens' => [
                    [
                        'name' => 'Serum Hizmeti',
                        'slug' => 'serum-hizmeti-katogori',
                        'content' => 'Serum Hizmeti ',
                        'image' => 'img/car1.jpg',
                        'status' => 1,
                    ],
                ]
            ],
            [
                'name' => 'Damar Yolu Açma',
                'slug' => 'damar-yolu-açma',
                'content' => 'Damar Yolu Açma ',
                'image' => 'img/car2.jpg',
                'status' => 1,
                'childrens' => []
            ],
            [
                'name' => 'Enjeksiyon Hizmeti',
                'slug' => 'enjeksiyon-hizmeti',
                'content' => 'Enjeksiyon Hizmeti ',
                'image' => 'img/car3.jpg',
                'status' => 1,
                'childrens' => []
            ],
        ];

        foreach ($categories as $key => $category) {
            unset($category['childrens']);
            $category = Category::create($category);
            if (!empty($categories[$key]['childrens'])) {
                foreach ($categories[$key]['childrens'] as $children) {
                    $children = Category::create($children);
                    $children->parent_id = $category->id;
                    $children->save();
                }
            }
        }
    }
}
