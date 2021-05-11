<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $fields = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $file = $request->file('image');
        $contents = $file->openFile()->fread($file->getSize());
        $path = $request->file('image')->store('public/images');
        $post = Post::create([
            'title' => $fields['title'],
            'description' => $fields['description'],
            'image' => $path,
            'user_id' => auth()->id(),
        ]);
        return response()->json(['message'=>'post Saved','data'=>$post],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id)->posts;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $id)
    {
        
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
    }
}
