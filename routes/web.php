<?php

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

Route::view('/', 'home.index')->name('home.index');

Route::view('/contact', 'home.contact')->name('home.contact');

// parameters get passed to the function in the order that they are defined
// you can add constraints to routes using where clause that accepts an array
Route::get('/posts/{id}', function ($id) {

    $posts = [
        1 => [
            'title' => 'Intro to Laravel',
            'content' => 'This is a short intro to Laravel'
        ],
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP'
        ]
    ];

    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['posts' => $posts[$id]]);
})
//    ->where([
//    'id' => '[0-9]+'
//])
    ->name('posts.show');

// routes can have optional parameters and should have a default value
Route::get('/recent-posts/{days_ago?}', function($daysAgo = 2) {
    return 'posts from ' . $daysAgo . ' days ago.';
});
