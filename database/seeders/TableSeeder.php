<?php

namespace Database\Seeders;

use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        // Üst kat (5 masa)
        for ($i = 1; $i <= 5; $i++) {
            Table::create([
                'name' => 'U-' . $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Alt kat (10 masa)
        for ($i = 1; $i <= 10; $i++) {
            Table::create([
                'name' => 'A-' . $i,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
