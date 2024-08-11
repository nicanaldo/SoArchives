<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // $posts = Post::all();
        // $posts = Post::where('user_id', $user->UserID)->get();  
        $posts = Post::where('visible', true)
        ->withCount('likes')
        ->with('comments')
        ->withCount('likes')
        ->with('user')
        ->get();

        return view('community', compact('posts', 'user'));
    }

    public function like(Request $request, Post $post)  
    {
        // Check if the user has already liked the post
        $user = Auth::user();

        // Create a new like
        $like = new Like();
        $like->post_id = $post->id;
        $like->user_id = $user->id; // Associate the comment with the authenticated user
        $like->save();

        return redirect()->back()->with('message', 'Like recorded successfully.');
    }

    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        
        $user = Auth::user(); // Get the authenticated user

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->post_id = $post->id;
        $comment->user_id = $user->id; // Associate the comment with the authenticated user
        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully');
    }


    public function storePost(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to create a post.');
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $user = Auth::user(); // Get the authenticated user

        $post = new Post();
        $post->content = $request->input('content');
        $post->user_id = $user->id; // Associate the post with the authenticated user
        $post->deleted_at = now();
        $post->save();

        return redirect()->back()->with('success', 'Post created successfully.');
    }

    public function PostData(Request $request)
    {
        // $posts = Post::all();
        // return $posts;

        $posts = Post::with('content')->get();
        return $posts;
    }

    public function showPosts()
    {
        $posts = Post::all();
        return view('Community.community', compact('post'));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function editPost(Post $post)
    {
        return view('community.editPost', compact('post'));
    }

    public function updatePost(Request $request, Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->route('community.index')->with('error', 'You are not authorized to edit this post.');
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $post->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('community.index')->with('success', 'Post updated successfully');
    }

    public function deletePost(Post $post)
    {
        // Check if the authenticated user is the owner of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('community.index')->with('error', 'You are not authorized to delete this post.');
        }
        $post->visible = false;
        $post->save();

        return redirect()->route('community.index')->with('success', 'Post hidden successfully');
    }

    public function editComment(Comment $comment)
    {
        return view('community.editComment', compact('comment'));
    }

    public function updateComment(Request $request, Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if (auth()->user()->id !== $comment->user_id) {
            return redirect()->route('community.index')->with('error', 'You are not authorized to update this comment.');
        }

        // Validate the request data
        $request->validate([
            'content' => 'required|string',
        ]);

        // If the authenticated user is the owner, update the comment's content
        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('community.index')->with('success', 'Comment updated successfully');
    }

    public function deleteComment(Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if (auth()->user()->id !== $comment->user_id) {
            return redirect()->route('community.index')->with('error', 'You are not authorized to delete this comment.');
        }

        // If the authenticated user is the owner, delete the comment
        $comment->delete();

        return redirect()->route('community.index')->with('success', 'Comment deleted successfully');
    }
}
