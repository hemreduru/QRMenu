<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::with(['orders.product'])->get()->map(function ($table) {
            // Her masa için siparişleri grupla ve toplam tutarı hesapla
            $grouped_orders = $table->orders->groupBy('product_id')->map(function ($orders) {
                $product = $orders->first()->product;
                $quantity = $orders->sum('quantity');
                $total = $quantity * $product->price;

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $total,
                ];
            });

            // Toplam masa tutarını hesapla
            $total_amount = $grouped_orders->sum('total');

            // Masa verisini döndür
            return [
                'table' => $table,
                'grouped_orders' => $grouped_orders,
                'total_amount' => $total_amount,
            ];
        });

        // Veriyi view'a gönder
        return view('pages.table.index', ['tables' => $tables]);
    }


    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Table::create($request->all());
        return redirect()->route('tables.index');
    }

    public function clearOrders($tableId)
    {
        $table = Table::findOrFail($tableId);
        $table->orders()->delete();

        return redirect()->back()->with('success', 'Tüm siparişler başarıyla kaldırıldı!');
    }


}
