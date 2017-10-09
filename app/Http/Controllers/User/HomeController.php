<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Model\user\Post;
use App\Model\user\Tag;
use App\Model\user\Category;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){

    	$posts = Post::where('status', 1)->orderBy('created_at', 'DESC')->paginate(3);

        return view('user.blog', compact('posts'));
    	//return view('user.blog');
    }

    public function tag(Tag $tag) {
    	 $posts = 	$tag->posts();
    return view('user.blog', compact('posts'));

    }

    public function category(Category $category){

    $posts = 	$category->posts();
    return view('user.blog', compact('posts'));
    

    }
}
