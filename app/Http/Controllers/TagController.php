<?php

namespace App\Http\Controllers;

use App\Models\TagsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $perPage = $request->get('per_page', 6); // optional, default 10
        $page = $request->get('page', 1);

        $query = DB::table('tags_models')->where('deleted_at', null)->orderBy('id', 'desc');

        $tags = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($tags);
    }

    public function fetchAllTags(){
        $tags = TagsModel::all();
        return response()->json($tags);
    }

    public function store(Request $request)
    {
           $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category_models,name',
        ]);

        $category = TagsModel::create($validated);
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TagsModel $tag)
    {
       return response()->json($tag);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,TagsModel $tag)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255|unique:category_models,name,'.$tag->id,
        ]);

        $tag->update($validated);
        return response()->json($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagsModel $tag)
    {
           $tag->delete();
        return response()->json(['message' => 'Category deleted']);
    }
}
