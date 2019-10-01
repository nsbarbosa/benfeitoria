<?php
namespace App\Repositories;

use App\Post;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PostRepository
{
    protected $post;

    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post  = $post;
    }

    public function getAll()
    {
        $posts = $this->post->orderBy('id', 'desc')->get();
        return $posts;
    }

    /**
     * Create a new post.
     *
     * @param ({
     *      @Parameter("params", type="array", required="true", description="Params to register a new post"),
     *      @Parameter("url", type="string", required="true", description="Path for url creation"),
     * })
     * @return Post
     */

    public function create($params, $url)
    {
        $params['image'] = $url;
        $post = $this->post->forceCreate($this->formatCreate($params));
        return $post;
    }

    /**
     * Find post by Slug or fail
     *
     * @param string $slug
     * @return Post
     */

    public function findOrFail($slug)
    {
        $post = $this->post->findBySlug($slug)->get();

        if (! $post) {
            throw ValidationException::withMessages(['message' => trans('post.could_not_find')]);
        }

        return $post;
    }

    /**
     * Prepare given params for inserting into database.
     *
     * @param array $params
     * @return array
     */

    private function formatCreate($params)
    {
        $formatted = [
            'author' => isset($params['author']) ? $params['author'] : 'Author',
            'image' => isset($params['image']) ? asset($params['image']) : 'Image',
            'title' => isset($params['title']) ? $params['title'] : 'Title',
            'content' => isset($params['content']) ? $params['content'] : 'Content',
            'slug' => $this->createSlug($params['title'])
        ];
        return $formatted;
    }
    private function createSlug($title)
    {
        $slug = str_slug($title, '-');
        $post = $this->post->findBySlug($slug)->get();
        if($post){
            $slug = str_slug($title.'-'.Carbon::now(), '-');
        }
        return $slug;
    }
}