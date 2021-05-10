<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
        // if($fields->fails()) {
        //     return response()->json(['message'=>$validator->messages(),'data'=>null],400);
        // }
        $file = $request->file('image');
        $filename = 'profile-photo-' . time() . '.' . $file->getClientOriginalExtension();

        // save to storage/app/photos as the new $filename
        $path = $file->storeAs('photos', $filename);
        $post = new Post();

        $post->title = $fields['title'];
        $post->description = $fields['description'];
        $post->image = $path;
        $post->user_id = $id;
        $post->save();
        return response()->json(['message'=>'Comment Saved','data'=>$post],200);
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
