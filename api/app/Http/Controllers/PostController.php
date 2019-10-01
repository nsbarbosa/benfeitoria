<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepository;
use Carbon\Carbon;

class PostController extends Controller
{
    //
    protected $post;

    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    /**
     * Used to get all posts
     * @get ("/api/posts")
     * @return Response
     */
    public function getAll()
    {
        $posts = $this->post->getAll();
        return $this->success(compact('posts'));
    }
    /**
     * Used to get a post by id
     * @get ("/api/post/{slug}")
     * @param ({
     *      @Parameter("slug", type="string", required="true", description="Slug of Post")
     * })
     * @return Response
     */
    public function get($slug)
    {
        $post = $this->post->findOrFail($slug);
        return $this->success(compact('post'));
    }
    /**
     * Used to create a post
     * @post ("/api/post")
     * @param ({
     *      @Parameter("author", type="string", required="true", description="Name of the author"),
     *      @Parameter("image", type="image", required="true", description="Image to illustrate the post"),
     *      @Parameter("title", type="string", required="true", description="Title of the post"),
     *      @Parameter("content", type="string", required="true", description="The content of the post")
     * })
     * @return Response
     */
    public function create(PostRequest $request)
    {
        $url = $this->uploadImage($request);
        $post = $this->post->create($request->all(), $url);
        return $this->success(compact('post'));
    }

    private function uploadImage($request)
    {
        $extension = request()->image->getClientOriginalExtension();
        $upload_path = 'uploads/';
        $name = Carbon::now().'.'.$extension;     
        request()->image->move($upload_path, $name);
        $url = '/'.$upload_path. $name;
        return $url;
    }
}
