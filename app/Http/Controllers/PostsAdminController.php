<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use App\Tag;


class PostsAdminController extends Controller
{
    //

    private $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    
    public function index(){
        $posts = $this->post->paginate(5);
        return view('admin.posts.index',compact('posts'));
    }

    public function create(){
        return view('admin.posts.create');
    }
    public function store(PostRequest $request){
        $post=$this->post->create($request->all());
        $post->tags()->sync($this->getTagIds($request->tags));
        return redirect()->route('admin.index');
    }
    public function edit($id){
        $post = $this->post->find($id);
        return view('admin.posts.edit',compact('post'));
    }
    public function update($id,PostRequest $request){
        $post = $this->post->find($id);
        $post->update($request->all());
        $post->tags()->sync($this->getTagIds($request->tags));
        return redirect()->route('admin.index');
    }
    public function destroy($id){
        $post = $this->post->find($id)->delete();
        return redirect()->route('admin.index');
    }
    public function cancel(){
        return redirect()->route('admin.index');
    }


    private function getTagIds($tagsRequest){
        $tags = array_filter(array_map('trim',explode(',',$tagsRequest)));
        $tagIds =[];
        foreach ($tags as $tagName){
            $tagIds[] = Tag::firstOrCreate(['name'=>$tagName])->id;
        }
        return $tagIds;
    }
}
