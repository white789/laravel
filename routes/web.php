<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    // view function expects a view, you can pass parameters in an array
//    return view('home.index', []);
//})->name('home.index');
//
//Route::get('/contact', function() {
//    return view('home.contact');
//})->name('home.contact');

$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ],
    3 => [
        'title' => 'third blog post',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ]
];

Route::get('/', [HomeController::class, 'home'])->name('home.index');

Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

Route::get('/single', AboutController::class);

Route::resource('posts', PostsController::class);
    //->only('index', 'show', 'create', 'store', 'edit', 'update');

Auth::routes();

//Route::get('/posts', function() use($posts) {
//    //dd(request()->all());
//    dd((int)request()->query('page', 1));
//    // compact(%posts) === ['posts' => $posts];
//    return view('posts.index', ['posts' => $posts]);
//});
//
//// parameters get passed to the function in the order that they are defined
//// you can add constraints to routes using where clause that accepts an array
//Route::get('/posts/{id}', function ($id) use($posts) {
//
//    abort_if(!isset($posts[$id]), 404);
//
//    return view('posts.show', ['posts' => $posts[$id]]);
//})
////    ->where([
////    'id' => '[0-9]+'
////])
//    ->name('posts.show');
//
//// routes can have optional parameters and should have a default value
//Route::get('/recent-posts/{days_ago?}', function($daysAgo = 2) {
//    return 'posts from ' . $daysAgo . ' days ago.';
//});

// grouping urls
Route::prefix('fun')->name('fun.')->group(function() use($posts) {
    Route::get('responses', function() use($posts) {
        return response($posts, 201)
            ->header('Content-Type', 'application/json')
            ->cookie('MY_COOKIR', 'Michael White', 3600);
    })->name('responses');

    Route::get('redirect', function() {
        return redirect('/contact');
    })->name('redirect');

    Route::get('back', function() {
        return back();
    })->name('back');

    Route::get('named-route', function() {
        return redirect()->route('posts.show', ['id' => 1]);
    })->name('named-route');

    Route::get('away', function() {
        return redirect()->away('https://google.co.uk');
    })->name('away');

    Route::get('json', function() use($posts) {
        return response()->json($posts);
    })->name('json');

    Route::get('download', function() use($posts) {
        return response()->download(public_path('/daniel.jpg'), 'face.jpg');
    })->name('download');
});

