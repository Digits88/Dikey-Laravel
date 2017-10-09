<?php

Route::group(['namespace' => 'User'], function(){

    Route::get('/', 'HomeController@index')->name('/');

    Route::get('post/{post}', 'PostController@post')->name('post');//{post?} ? слагаме, като казва да не взимаме задължително предвид пътя който се подава в {} скоби



    Route::get('post/tag/{tag}', 'HomeController@tag')->name('tag');
    Route::get('post/category/{category}', 'HomeController@category')->name('category');

    //vue Routes
    Route::post('getPost','PostController@getAllPosts');//getPosts е използва във файла resources/assets/app.js използваме mounted()

});

Route::group(['namespace' => 'Admin'], function(){
        
        Route::get('admin/home', 'HomeController@index')->name('admin.home');
        
        //Post Routes
		Route::resource('admin/post', 'PostController');

		//User Routes
		Route::resource('admin/user', 'UserController');

        //Role Routes
        Route::resource('admin/role', 'RoleController');

         //Permission Routes
        Route::resource('admin/permission', 'PermissionController');


		//Tag Routes
		Route::resource('admin/tag', 'TagController');

		//Category Routes
		Route::resource('admin/category', 'CategoryController');

        //Admin Auth Routes
        Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
//admin-login показва пътя горе как се казва в URL-то , а name('admin.login') е route във файла login.blade.php във form
        Route::post('admin-login', 'Auth\LoginController@login');

});

/*Route::get('admin/home', function () {
    return view('admin.home');
})->name('post');*/

/*Route::get('admin/post', function () {
    return view('admin.post.post');
});*/

/*Route::get('admin/tag', function () {
    return view('admin.tag.tag');
});*/

/*Route::get('admin/category', function () {
    return view('admin.category.category');
});*/
//do na4aloto 9мин  https://www.youtube.com/watch?v=v4F4EDy5ErQ&index=34&list=PLe30vg_FG4OTELVqQgHaMaq2oELjpSWy_
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
