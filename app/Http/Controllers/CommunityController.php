<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Flair;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $flairs = Flair::all();
        $flairsopt = Flair::pluck('name', 'FlairsID')->toArray();
        $selectedFlair = $request->query('flair');
        $search = $request->input('search');

        // Base query
        $postsQuery = Post::where('visible', true)
                            ->withCount('likes')
                            ->with('comments')
                            ->with('user');

        // Filter by flair if selected
        if ($selectedFlair) {
            $postsQuery->where('flairs', $selectedFlair);
        }

        // Search function
        if ($search) {
            $postsQuery->where(function($query) use ($search) {
                $query->where('content', 'like', "%{$search}%")
                    ->orWhere('flairs', 'like', "%{$search}%");
            });
        }

        $posts = $postsQuery->get()->each(function ($post) use ($user) {
            $post->user_has_liked = Like::where('post_id', $post->id)
                                        ->where('user_id', $user->id)
                                        ->exists();
        });

        return view('community', compact('posts', 'user', 'flairs', 'flairsopt', 'selectedFlair', 'search'));
    }

    public function like(Request $request, Post $post)
    {
        $user = Auth::user();

        // Check if the user has already liked the post
        $existingLike = Like::where('post_id', $post->id)
                            ->where('user_id', $user->id)
                            ->first();

        if ($existingLike) {
            // Unlike it if the user already liked the post
            $existingLike->delete();
            $message = 'Like removed successfully.';
        } else {
            // Like the post
            $like = new Like();
            $like->post_id = $post->id;
            $like->user_id = $user->id;
            $like->save();
            $message = 'Like recorded successfully.';
        }

        return redirect()->back()->with('message', $message);
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
            'flairs' => 'required|string',
        ]);

        $user = Auth::user(); // Get the authenticated user

        $post = new Post();
        $post->content = $request->input('content');
        $post->user_id = $user->id; // Associate the post with the authenticated user
        $post->flairs = $request->input('flairs'); // Save the selected flair
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
