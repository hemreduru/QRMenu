<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Table;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request, Table $table)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $table->orders()->create($request->all());
        return redirect()->route('tables.index');
    }

    public function show(Table $table)
    {
        $orders = $table->orders()->with('product')->get();
        return view('orders.show', compact('table', 'orders'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $order->update(['quantity' => $validated['quantity']]);

        return redirect()->back()->with('success', 'Sipariş başarıyla güncellendi.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->back()->with('success', 'Sipariş başarıyla kaldırıldı.');
    }


}
