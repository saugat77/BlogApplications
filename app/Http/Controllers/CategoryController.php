<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       $perPage = $request->get('per_page', 10); // optional, default 10
        $page = $request->get('page', 1);

        $query = DB::table('category_models')->where('deleted_at', null)->orderBy('id', 'desc');

        $categories = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($categories);
    }

    public function fetchAllCategories(){
        $categories = CategoryModel::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category_models,name',
        ]);

        $category = CategoryModel::create($validated);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryModel $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,CategoryModel $category)
    {
       $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category_models,name,'.$category->id,
        ]);

        $category->update($validated);
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryModel $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
