<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        $tags = Tag::all();
        return view('admin.posts.index', compact('posts','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title'=> 'required|max:255',
            'content'=> 'required',
            'category_id'=>'required',
            'tags[]'=>'exists:tags,id',
            'image'=>'nullable|image'
        ]);

        $postData = $request->all();
        if(array_key_exists('image', $postData)){
            $img_path = Storage::put("uploads", $postData["image"]);
            $postData['cover'] = $img_path;
        }
        $newPost = new Post();
        $newPost->fill($postData);
        $newPost->slug = Post::uniqueSlug($newPost->title);
        $newPost->save();
        $newPost->tags()->sync($postData['tags']);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = Category::all();
        $post = Post::findOrFail($id);
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title'=> 'required|max:255',
            'content'=> 'required',
            'category_id'=>'required',
            'tags[]'=>'exists:tags,id',
            'image'=>'nullable|image'

        ]);

        $post = Post::findOrFail($id);
        $postData = $request->all();
        if(array_key_exists('image', $postData)){
            if($post->cover){
                Storage::delete($post->cover);
            }
            $img_path = Storage::put("uploads", $postData["image"]);
            $postData['cover'] = $img_path;
        }
        $post->fill($postData);
        $post->slug = Post::uniqueSlug($post->title);
        $post->save();
        $post->tags()->sync($postData['tags']);
        $post->save();

        return redirect()->route('admin.posts.index', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        $post->tags()->sync([]);
        if($post->cover){
            Storage::delete($post->cover);
        }
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}