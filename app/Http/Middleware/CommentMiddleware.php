<?php

namespace App\Http\Middleware;

use App\Models\CommentModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $comment = $request->route('comment');
         $user = $request->user();
        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }
        $comment = CommentModel::find($comment);
        // Only owner or admin
        if ($comment->user_id !== $user->id && !$user->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
