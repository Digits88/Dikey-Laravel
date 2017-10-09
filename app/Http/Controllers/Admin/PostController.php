<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Model\user\Post;
use App\Model\user\Tag;
use App\Model\user\Category;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $posts =  Post::all();
        return view('admin.post.show', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('posts.create')) {
          
           
                $tags = Tag::all();
                $categories = Category::all();
               return view('admin.post.post', compact('tags', 'categories'));
        }

        return redirect(route('admin.home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

                 'title' => 'required',
                 'subtitle' => 'required',
                 'slug' => 'required',
                 'body' => 'required',
                 'image' => 'required',

            ]);
          if ($request->hasFile('image')) {
            $imageName = $request->image->store('public');
        }
        
        $post = new Post;
        $post->image = $imageName;
        $post->title =  $request->title;
        $post->subtitle =  $request->subtitle;
        $post->slug =  $request->slug;
        $post->body =  $request->body;
        $post->status =  $request->status;
        $post->save();

        $post->tags()->sync($request->tags); //tags e name="tags[]" от select елемента в post.blade.php
        $post->categories()->sync($request->categories);
 //първото categories e от имет она ф-ята в Post модела, а второто categories е name="categories[]" от select елемента в post.blade.php същото е и за tags

        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('posts.update')) {

                $post = Post::with('tags', 'categories')->where('id', $id)->first(); //with('tags') слага се за редактиране на таговете
                // return $post;
                $tags = Tag::all();
                $categories = Category::all();
                return view('admin.post.edit', compact('tags', 'categories', 'post'));
                //return view('admin.post.edit', compact('post'));
        }

        return redirect(route('admin.home'));
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
             $this->validate($request, [

                 'title' => 'required',
                 'subtitle' => 'required',
                 'slug' => 'required',
                 'body' => 'required',
                 'image' => 'required'

            ]);

             if ($request->hasFile('image')) {

               //return $request->image->getClientOriginalName(); //тази ф-я връща точното име на снимката както сме е записали

              $imageName = $request->image->store('public'); //тук посочваме пътя къде да запишем снимката

             }

        $post = Post::find($id);
        $post->image = $imageName; //снимката не се появява във файл post.blade.php на 3ред защото трябва свъжем папката storage/app/public
        // с външната папка public с php artisan storage:link . така имаме във public/storage
        $post->title =  $request->title;
        $post->subtitle =  $request->subtitle;
        $post->slug =  $request->slug;
        $post->body =  $request->body;
         $post->status =  $request->status;
       $post->tags()->sync($request->tags); //tags e name="tags[]" от select елемента в post.blade.php
       $post->categories()->sync($request->categories); //categories e name="categories[]" от select елемента в post.blade.php
        $post->save();

        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->can('posts.delete')) {

               $post = Post::where('id', $id)->delete();
               return redirect()->back();
         }
          return redirect(route('admin.home'));

     }

       
}
