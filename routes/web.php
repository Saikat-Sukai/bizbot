<?php

use App\Http\Controllers\CallbacksController;
use App\Http\Controllers\ProfileController;
use App\Models\Module;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//use Freebizbot\SimpleArticles\Models\Article;
//Route::get('/test',function(){
////    return Article::all();
//
//    $module = Module::find(1);
//
//    $m = new $module->constructor();
//
//    $params = [ 'post_title' => 'POst Title', 'post_content' => 'Post Content',
//        'post_excerpt' => 'Post Excerpt', 'post_name' => 'Post Name', 'guid' => '5' ];
//
//    return $m->call('create_wordpress_post',$params);
//
//});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
