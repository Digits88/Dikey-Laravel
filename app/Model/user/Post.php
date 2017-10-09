<?php

namespace App\Model\user;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function tags(){

        return $this->belongsToMany('App\Model\user\Tag', 'post_tags')->withTimestamps();//втория параметър е името на свързващата таблица post_tags' при релация много към много 
    }

    public function categories(){

    	return $this->belongsToMany('App\Model\user\Category', 'category_posts')->withTimestamps();
    }

    public function getRouteKeyName(){

    	return 'slug';//връща slug от post -те в  admin ,които slug е junior. Подава секато параметър във файла  web.php {post}. После в PostController с return $post; връща всички данни за човека заглавие подзаглавие текст от post -те в  admin панела на Блога.
    	//вместо  'slug' може да е 'title' 'subtile'
    }
  
   public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value);
    }



}
