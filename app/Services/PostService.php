<?php

namespace App\Services;

use App\Models\PostModel;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class PostService
{
    public function getAllPosts($request){

        $posts = QueryBuilder::for(PostModel::class)
            ->allowedFilters(['title', 'author.name', 'category.name', 'tags.name'])
            ->allowedIncludes(['author', 'category', 'tags', 'comments'])
            ->with(['author', 'category', 'tags', 'comments.user'])
            ->latest()
            ->get();

        return response()->json($posts);
    }
     public function createPost(array $data, $user): PostModel
    {
        return DB::transaction(function () use ($data, $user) {
            // Create post
          $post = $user->posts()->create([
                'title' => $data['title'],
                'body' => $data['body'],
                'thumbnail' => $data['thumbnail'] ?? null,
                'category_id' => $data['category_ids']['id'],
            ]);
            // Attach tags if provided
            if (!empty($data['tags'])) {
                dd(('here'));
                $post->tags()->sync($data['tags']);
            }
            dd('here');
            return $post->load('tags', 'category', 'author');
        });
    }

}
