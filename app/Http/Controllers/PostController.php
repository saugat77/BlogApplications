<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\PostModel;
use App\Services\PostService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    public $postService;
    public function __construct(PostService $postService)
    {
       $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->postService->getAllPosts($request);
        return response()->json($data, 201);
    }
    public function fetchAllPosts(Request $request)
    {
        $data = PostModel::with(['author', 'category', 'tags'])->latest()->paginate(6);
        return response()->json($data, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
         $post = $this->postService->createPost($request->validated(), $request->user());
        return response()->json($post, 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request,PostModel $post)
    {
        $updatedPost = $this->postService->updatePost($post, $request->validated());

        return response()->json([
            'message' => 'Post updated successfully',
            'post' => $updatedPost,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostModel $post)
    {
    $post->delete();

    return response()->json([
        'message' => 'Post deleted successfully',
    ]);
    }
}
