<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Table ID'leri arasından rastgele 10 masa seç
        $randomTables = Table::inRandomOrder()->take(10)->get();

        foreach ($randomTables as $table) {
            // Her masa için 3 ile 15 arasında rastgele ürün siparişi oluştur
            $orderCount = rand(3, 15);
            for ($i = 0; $i < $orderCount; $i++) {
                Order::create([
                    'table_id' => $table->id, // Masanın ID'si
                    'product_id' => Product::inRandomOrder()->first()->id, // Rastgele bir ürün seç
                    'quantity' => rand(1, 10), // Her üründen 1 ile 10 arasında miktar
                ]);
            }
        }
    }
}
