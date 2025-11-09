<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use App\Models\PostModel;
use Illuminate\Http\Request;

class CommentController extends Controller
{

  public function store(Request $request, $postId)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post = PostModel::findOrFail($postId);

        $comment = $post->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment->load('user')
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = CommentModel::findOrFail($id);

        $comment->update([
            'body' => $request->body,
        ]);

        return response()->json([
            'message' => 'Comment updated successfully',
            'comment' => $comment->load('user')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommentModel $comment)
    {
        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully',
            'comment_id' => $comment->id,
        ]);
    }
}
