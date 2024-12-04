<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoryManagementController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            return view('pages.menu-management.categories.index', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            return redirect()->route('menu-management.categories.index')->with('error', 'Error fetching categories.');
        }
    }

    public function create()
    {
        try {
            $categories = Category::all();
            return view('pages.menu-management.categories.create', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error fetching categories for create: ' . $e->getMessage());
            return redirect()->route('menu-management.categories.index')->with('error', 'Error fetching categories.');
        }
    }

    public function store(CategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->parent_id = $request->parent_id;
            $category->save();
            $path = $request->file('image_path')->store('categories', 'public');
            $category->image_path = $path;
            $category->save();
            DB::commit();
            return redirect()->route('menu-management.categories.index')->with(
                'success',
                'Category created successfully.'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating category: ' . $e->getMessage());
            return redirect()->route('menu-management.categories.index')->with('error', 'Error creating category.');
        }
    }

    public function edit(Category $category)
    {
        try {
            $categories = Category::all();
            return view('pages.menu-management.categories.edit', compact('category', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error fetching categories for edit: ' . $e->getMessage());
            return redirect()->route('menu-management.categories.index')->with('error', 'Error fetching categories.');
        }
    }

    public function update(CategoryRequest $request, Category $category)
    {
        DB::beginTransaction();

        try {
            $category->name = $request->name;
            $category->description = $request->description;
            $category->parent_id = $request->parent_id;
            $category->save();

            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                $extension = $file->getClientOriginalExtension();

                if ($category->image_path) {
                    $existingFilePath = str_replace(asset('storage/'), '', $category->image_path);
                    Storage::disk('public')->delete($existingFilePath);
                }

                $baseFileName = $category->id;
                $filePath = "categories/$baseFileName.$extension";
                $counter = 1;

                while (Storage::disk('public')->exists($filePath)) {
                    $filePath = "categories/{$baseFileName}-{$counter}.$extension";
                    $counter++;
                }

                $file->storeAs('categories', basename($filePath), 'public');
                $category->image_path = asset('storage/' . $filePath);
            }

            $category->save();

            DB::commit();
            return redirect()->route('menu-management.categories.index')->with(
                'success',
                'Category updated successfully.'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating category: ' . $e->getMessage());
            return redirect()->route('menu-management.categories.index')->with('error', 'Error updating category.');
        }
    }


    public function destroy(Category $category)
    {
        DB::beginTransaction();

        try {
            if ($category->image_path) {
                $filePath = str_replace(asset('storage/'), '', $category->image_path);
                Storage::disk('public')->delete($filePath);
            }
            $category->delete();

            DB::commit();
            return redirect()->route('menu-management.categories.index')->with(
                'success',
                'Category deleted successfully.'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting category: ' . $e->getMessage());
            return redirect()->route('menu-management.categories.index')->with('error', 'Error deleting category.');
        }
    }

    public function show(Request $request)
    {
        $categories = Category::all();
        if ($request->has('parent_id') && $request->parent_id !== null) {
            $categories = $categories->where('parent_id', $request->parent_id);
        }

        return datatables()->of($categories)->addColumn('parent_name', function ($category) {
            return $category->parent ? $category->parent->name : '-';
        })->make(true);
    }
}
