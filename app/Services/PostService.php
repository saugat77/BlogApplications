<?php

namespace App\Services;

use App\Models\PostModel;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class PostService
{
    public function getAllPosts($request)
    {

        $posts = QueryBuilder::for(PostModel::class)
            ->allowedFilters(['title', 'author.name', 'category.name', 'tags.name'])
            ->allowedIncludes(['author', 'category', 'tags', 'comments.user'])
            ->with(['author', 'category', 'tags', 'comments.user'])
            ->latest()
            ->paginate(6)
            ->appends($request->query());
        return $posts;
    }
    public function createPost(array $data, $user): PostModel
    {
        return DB::transaction(function () use ($data, $user) {
            $categoryId = null;
            if (!empty($data['category_ids'])) {
                $first = $data['category_ids']['id'];
                // $categoryId = is_array($first) ? $first['id'] : $first;
            }
            // Create post
            $post = $user->posts()->create([
                'title' => $data['title'],
                'body' => $data['body'],
                'thumbnail' => $data['thumbnail'] ?? null,
                'category_id' => $first,
            ]);
            // Attach tags if provided
            $tagIds = array_column($data['tag_ids'], 'id');
            if (!empty($tagIds)) {
                $post->tags()->sync($tagIds);
            }
            return $post->load('tags', 'category', 'author');
        });
    }
    public function updatePost(PostModel $post, array $data): PostModel
    {
        return DB::transaction(function () use ($post, $data) {
            // --- Determine category ID ---
            $categoryId = null;
            if (!empty($data['category_ids'])) {
                $first = $data['category_ids']['id'];
            }

            $post->update([
                'title' => $data['title'],
                'body' => $data['body'],
                'thumbnail' => $data['thumbnail'] ?? null,
                'category_id' => $first,
            ]);

            $tagIds = [];
            if (!empty($data['tag_ids'])) {
                $tagIds = array_map(fn($tag) => is_array($tag) ? $tag['id'] : $tag, $data['tag_ids']);
            }

            $post->tags()->sync($tagIds);

            // --- Return with relations loaded ---
            return $post->load('tags', 'category', 'author');
        });
    }
}
