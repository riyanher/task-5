<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get 5 posts per page
        $posts = Post::latest()->paginate(5);

        //return collection of posts as a resource
        return new PostResource(true, 'List Data Posts', $posts);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //get id from user
        $user_id = auth()->user()->id;

        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
            //'user_id'   => 'required',
            'category_id' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        //create post
        $post = Post::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
            'user_id'   => $user_id,
            'category_id' => $request->category_id
        ]);

        //return response
        return new PostResource(true, 'New Post has been added!', $post);
    }

    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    public function show(Post $post)
    {
        //return single post as a resource
        return new PostResource(true, 'Post found!', $post);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/' . $post->image);

            //update post with new image
            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        } else {

            //update post without image
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        }

        //return response
        return new PostResource(true, 'Post has been modified!', $post);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy(Post $post)
    {
        //delete image
        Storage::delete('public/posts/' . $post->image);

        //delete post
        $post->delete();

        //return response
        return new PostResource(true, 'Post has been deleted!', null);
    }
}
