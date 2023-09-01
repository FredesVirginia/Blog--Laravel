<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;


//Aqui estamos dicienendo en la ruta /, se retornara la vista welcome
Route::get('/', function () {
    return view('welcome');
});

Route::view('/' , 'welcome') ->name('home') ;
Route::delete('/blog/{post}' , [PostController::class , 'destroy']) ->name('posts.destroy');
Route::view('/about' , 'about') ->name('about');
Route::get('/blog', [ PostController::class , 'index']) ->name('posts.index');
//esta ruta nos va a llevar a la pagina para mostrar el formulario post posts
Route::get('/blog/create' , [PostController::class , 'create'])->name('posts.create');
//aqui en esta ruta se va almacenar, los datos del formulario
Route::post('/blog' , [PostController::class , 'store'])->name('posts.store');
//esta es la ruta que muestra el detalle de cada post, se le pone
//el nombre que quiera entre la llaves, no se pone el $


Route::get('/blog/{post}' , [PostController::class , 'show']) ->name('posts.show');
//La ruta de abajo es para editat los post
Route::get("/blog/{post}/edit" , [PostController::class ,'edit' ])->name('posts.edit');
//La ruta de abajo es para actualizar ..aqui tenemos dos metodos el put y el patch, el primero es para rem
//plazar y el segundo es para actualizar.
Route::patch("/blog/{post}" , [PostController::class, 'update']) ->name('posts.update');
Route::view('/contacto' , 'contacto') ->name('contacto');


Route::resource('blog', PostController::class, [
    'names' =>'posts',
    'parameters' => ['blog' =>'post']
]);

Route::get('/login' , function(){
    return 'Login page';
}) ->name('login');

Route::view('/login' , 'auth.login')->name('login');
Route::post('/login' , [AuthenticatedSessionController::class , 'store']);
Route::post('/logout' , [AuthenticatedSessionController ::class , 'destroy'])->name('logout');

Route::view('/register' , 'auth.register')->name('register');

//Ruta para register  
Route::post('/register' , [RegisteredUserController::class , 'store']);