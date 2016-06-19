<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostsController extends Controller
{
    //
    private $post;

    public function  __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(){
        $posts = $this->post->all();
        return view('posts.index',['posts'=>$posts]);
    }
}
