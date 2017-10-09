@extends('user/app')




@section('bg-img',Storage::disk('public')->url($post->image)) 



@section('head')

<link rel="stylesheet" href="{{ asset('user/css1/prism.css') }}">

@endsection

@section('title' , $post->title)
@section('subtitle' , $post->subtitle)




@section('main-content')

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v2.10&appId=118825418815023";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
              <small>Created at {{ $post->created_at->diffForHumans() }}</small>
              
                
                   @foreach($post->categories as $category)
                       <a href="{{ route('category', $category->slug) }}"><small class="pull-right" style="margin-right: 20px;">
                           {{ $category->name }} 
                        </small></a>

                   @endforeach
             
                 {!! htmlspecialchars_decode($post->body) !!}

                 {{-- Tag --}}
                  <h3>Tag Clouds</h3>
                  @foreach($post->tags as $tag)
                    <a href="{{ route('tag', $tag->slug) }}"><small class="pull-left" style="margin-right: 20px; border-radius: 5px; border: 1px solid; padding: 2px;">
                            {{ $tag->name }} 
                        </small></a>

                   @endforeach
          </div>
             <!--<div class="fb-comments" data-href="http://localhost/composer/Bitfumes/public" data-numposts="6"></div>-->
             <div class="fb-comments" data-href="{{ Request::url() }}" data-numposts="5"></div>
        </div>
      </div>
    </article>
<hr>

@endsection

@section('footer')

<script src="{{ asset('user/js1/prism.js')}}"></script>

@endsection