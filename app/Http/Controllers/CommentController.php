<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();

        Comment::create([
            'post_id' => $validated['post_id'],
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Komentarz został dodany!');
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(StoreCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        
        $validated = $request->validated();
        $comment->update(['content' => $validated['content']]);

        return redirect()->back()->with('success', 'Komentarz został zaktualizowany!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        $comment->delete();

        return redirect()->back()->with('success', 'Komentarz został usunięty!');
    }
}
