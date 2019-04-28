<?php
namespace App\Http\Controllers;


use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        $post->load('comments.owner');
        $comments = $post->getComments();
        $comments['root'] = $comments[''];
        return view('posts.show', compact('post', 'comments'));
    }

    public function comment(Post $post)
    {
        $post->comments()->create([
            'body' => request('body'),
            'user_id' => \Auth::id(),
            'parent_id' => request('parent_id', null),
        ]);
        return back();
    }
}