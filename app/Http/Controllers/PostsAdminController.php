<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class PostsAdminController extends Controller
{
    //

    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    
    public function index(){
        return view('admin.posts.index');
    }
}