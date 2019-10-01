<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author', 'image', 'title', 'content', 'slug'
    ];
    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function scopeFindBySlug($query, $slug)
    {
        if(!$slug){
            return $query;
        }
        return $query->where('slug', $slug);
    }
}
