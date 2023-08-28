<?php

use Illuminate\Support\Facades\Route;
use MailchimpTransactional\ApiClient;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\Admin\AdminPostController;

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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->whereAlphaNumeric('post:slug');
Route::post('/posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->whereAlphaNumeric('post:slug')->name('postcommentcreate');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest')->name('create');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest')->name('store');

Route::get('logout', [SessionsController::class, 'destroy'])->middleware('auth');
Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');
// Route::get('/categories/{category:slug}', [PostController::class, 'categoryPost'])->whereAlphaNumeric('category:slug') ->name('category');

// Route::get('/authors/{author:username}', [PostController::class, 'authorPost']);


//backend routes
Route::get('/admin/posts', [AdminPostController::class, 'index' , ])->name('adminposts')->middleware('admin')->name('adminposts');
Route::get('/admin/posts/create', [AdminPostController::class, 'create'])->name('post.create')->middleware('admin')->name('createpost');
Route::post('/admin/posts/create', [AdminPostController::class, 'store'])->name('post.store')->middleware('admin');
Route::get('/admin/posts/{post:slug}/edit', [AdminPostController::class, 'edit'])->name('post.edit')->middleware('admin');
Route::patch('/admin/posts/{post:slug}', [AdminPostController::class, 'update'])->name('post.update')->middleware('admin');
Route::delete('/admin/posts/{post:slug}', [AdminPostController::class, 'destroy'])->name('post.destroy')->middleware('admin');


Route::get('ping', function(){

 
        try {

            $mailchimp = new MailchimpTransactional\ApiClient();
            // $mailchimp->setApiKey('services.mailchimp');
            // // $mailchimp->setServer
            // $response = $mailchimp->users->ping()->get();
            $mailchimp->setConfig([
                'apikey' => config('services.mailchimp.key'),
                'server' => config('us6')
            ]);
            $response=$mailchimp->ping()->get();
            ddd( $response);


         } catch (Error $e) {
               echo 'Error: ',  $e->getMessage(), "\n";
         }
       
});