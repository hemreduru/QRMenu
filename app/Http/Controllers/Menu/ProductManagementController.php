<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductManagementController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();

            return view('pages.menu-management.products.index', compact('products'));
        } catch (\Exception $e) {
            \Log::error('Error fetching products: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch products.');
        }
    }

    public function create()
    {
        $categories = Category::all();

        return view('pages.menu-management.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        \DB::beginTransaction();
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->save();

            \DB::commit();
            return redirect()->route('menu-management.products.index')->with(
                'success',
                'Product created successfully.'
            );
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error creating product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create product.');
        }
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            $categories = Category::all();
            return view('pages.menu-management.products.edit', compact('product', 'categories'));
        } catch (\Exception $e) {
            \Log::error('Error fetching product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to fetch product.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        \DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->save();

            \DB::commit();
            return redirect()->route('menu-management.products.index')->with(
                'success',
                'Product updated successfully.'
            );
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error updating product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update product.');
        }
    }

    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            \DB::commit();
            return redirect()->route('menu-management.products.index')->with(
                'success',
                'Product deleted successfully.'
            );
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error deleting product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete product.');
        }
    }

    public function show(Request $request)
    {
        $products = Product::with('category.parent')->get();
        return datatables()->of($products)->addColumn('category_name', function ($product) {
            return $product->category ? $product->category->name : '-';
        })->addColumn('parent_category_name', function ($product) {
            return $product->category && $product->category->parent ? $product->category->parent->name : '-';
        })->make(true);
    }
}
