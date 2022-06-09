<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    //
    //protected $guarded = [''];
    protected $fillable = ['title', 'content', 'slug', 'category_id'];

    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    // FUNZIONE CHE RITORNA UNO SLUG UNICO
    public static function uniqueSlug($title){
        $slug = Str::slug($title);
        $otherSlug = $slug;
        $postExist = Post::where('slug', $slug)->first();
        $counter = 1;
        while($postExist){
            $otherSlug = $slug . '_' . $counter;
            $counter++;
            $postExist = Post::where('slug', $otherSlug)->first();
        }
        return $otherSlug;
    }
}
