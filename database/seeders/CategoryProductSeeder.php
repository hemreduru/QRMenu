<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Faker\Factory as Faker;

class CategoryProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('tr_TR');

        $categories = [
            'İçecekler' => ['Alkolsüz İçecekler', 'Alkollü İçecekler'],
            'Yemekler' => ['Ana Yemek', 'Yan Yemek', 'Atıştırmalık', 'Tatlı']
        ];

        foreach ($categories as $parent => $children) {
            $parentCategory = Category::create([
                'name' => $parent,
                'description' => $faker->sentence,
                'image_path' => $faker->imageUrl()
            ]);

            foreach ($children as $child) {
                $childCategory = Category::create([
                    'name' => $child,
                    'parent_id' => $parentCategory->id,
                    'description' => $faker->sentence,
                    'image_path' => $faker->imageUrl()
                ]);

                $productCount = match ($child) {
                    'Alkolsüz İçecekler', 'Alkollü İçecekler' => 25,
                    'Ana Yemek' => 50,
                    'Yan Yemek', 'Atıştırmalık', 'Tatlı' => 20,
                    default => 0,
                };

                for ($i = 0; $i < $productCount; $i++) {
                    Product::create([
                        'name' => $this->generateTurkishProductName($child),
                        'category_id' => $childCategory->id,
                        'description' => $faker->sentence,
                        'content' => $faker->paragraph,
                        'image_path' => $faker->imageUrl(),
                        'status' => $faker->boolean,
                        'price' => $faker->randomFloat(2, 1, 100), // Fiyat alanı eklendi
                    ]);
                }
            }
        }
    }

    private function generateTurkishProductName($category)
    {
        $names = match ($category) {
            'Alkolsüz İçecekler' => ['Kola', 'Gazoz', 'Meyve Suyu', 'Ayran', 'Limonata'],
            'Alkollü İçecekler' => ['Bira', 'Şarap', 'Rakı', 'Votka', 'Viski'],
            'Ana Yemek' => ['Kebap', 'Pilav', 'Makarna', 'Lahmacun', 'Mantı'],
            'Yan Yemek' => ['Salata', 'Çorba', 'Patates Kızartması', 'Yoğurt', 'Turşu'],
            'Atıştırmalık' => ['Cips', 'Kuruyemiş', 'Çikolata', 'Bisküvi', 'Kraker'],
            'Tatlı' => ['Baklava', 'Sütlaç', 'Künefe', 'Revani', 'Kazandibi'],
            default => ['Ürün'],
        };

        return $names[array_rand($names)];
    }
}
