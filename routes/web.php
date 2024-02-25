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
Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});
Route::get('/optimize', function() {
    Artisan::call('clear-compiled');
    return "Website is optimized";
});

Route::get('/', function () {
    return view('auth/login');
});
Route::get('/log', function () {
  
  auth()->logout();
   auth()->logout();
  return redirect('https://admin.bpsa.com.bd/');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');
Route::get('writer/home', [App\Http\Controllers\HomeController::class, 'writerHome'])->name('writer.home')->middleware('is_writer');
Route::get('editor/home', [App\Http\Controllers\HomeController::class, 'editorHome'])->name('editor.home')->middleware('is_editor');

Route::middleware(['web'])->group(function () {
Route::get('writer/committee', [App\Http\Controllers\CommitteeController::class, 'windex']);
Route::get('writer/committee/create', [App\Http\Controllers\CommitteeController::class, 'wcreate']);
Route::post('writer/committee/store', [App\Http\Controllers\CommitteeController::class, 'wstore']);
Route::get('writer/committee/edit/{id}', [App\Http\Controllers\CommitteeController::class, 'wedit']);
Route::post('writer/committee/update', [App\Http\Controllers\CommitteeController::class, 'wupdate']);
Route::get('writer/committee/destroy/{id}', [App\Http\Controllers\CommitteeController::class, 'wdestroy']);


Route::get('writer/gallery', [App\Http\Controllers\GalleryController::class, 'windex']);
Route::get('writer/gallery/create', [App\Http\Controllers\GalleryController::class, 'wcreate']);
Route::post('writer/gallery/store', [App\Http\Controllers\GalleryController::class, 'wstore']);
Route::get('writer/gallery/destroy/{id}', [App\Http\Controllers\GalleryController::class, 'wdestroy']);
Route::get('writer/gallery/edit/{id}', [App\Http\Controllers\GalleryController::class, 'wedit']);
Route::post('writer/gallery/update', [App\Http\Controllers\GalleryController::class, 'wupdate']);
Route::get('writer/gallery/innotice/{id}', [App\Http\Controllers\GalleryController::class, 'winnotice']);
Route::get('writer/gallery/acnotice/{id}', [App\Http\Controllers\GalleryController::class, 'wacnotice']);



Route::get('writer/post', [App\Http\Controllers\PostController::class, 'windex']);
Route::get('writer/post/create', [App\Http\Controllers\PostController::class, 'wcreate']);
Route::post('writer/post/store', [App\Http\Controllers\PostController::class, 'wstore']);
Route::get('writer/post/destroy/{id}', [App\Http\Controllers\PostController::class, 'wdestroy']);

Route::get('writer/post/sinnotice/{id}', [App\Http\Controllers\PostController::class, 'wsinnotice']);
Route::get('writer/post/sacnotice/{id}', [App\Http\Controllers\PostController::class, 'wsacnotice']);
Route::get('writer/post/ninnotice/{id}', [App\Http\Controllers\PostController::class, 'wninnotice']);
Route::get('writer/post/nacnotice/{id}', [App\Http\Controllers\PostController::class, 'wnacnotice']);
Route::get('writer/post/hinnotice/{id}', [App\Http\Controllers\PostController::class, 'whinnotice']);
Route::get('writer/post/hacnotice/{id}', [App\Http\Controllers\PostController::class, 'whacnotice']);
Route::post('writer/post/update', [App\Http\Controllers\PostController::class, 'wupdate']);
Route::post('writer/post/publish', [App\Http\Controllers\PostController::class, 'wpublish']);
Route::post('writer/post/remove', [App\Http\Controllers\PostController::class, 'wremove']);
});


// Route::get('writer/committee', [App\Http\Controllers\CommitteeController::class, 'windex'])->middleware('is_writer');
// Route::get('writer/committee/create', [App\Http\Controllers\CommitteeController::class, 'wcreate'])->middleware('is_writer');
// Route::post('writer/committee/store', [App\Http\Controllers\CommitteeController::class, 'wstore'])->middleware('is_writer');
// Route::get('writer/committee/edit/{id}', [App\Http\Controllers\CommitteeController::class, 'wedit'])->middleware('is_writer');
// Route::post('writer/committee/update', [App\Http\Controllers\CommitteeController::class, 'wupdate'])->middleware('is_writer');
// Route::get('writer/committee/destroy/{id}', [App\Http\Controllers\CommitteeController::class, 'wdestroy'])->middleware('is_writer');


// Route::get('writer/gallery', [App\Http\Controllers\GalleryController::class, 'windex'])->middleware('is_writer');
// Route::get('writer/gallery/create', [App\Http\Controllers\GalleryController::class, 'wcreate'])->middleware('is_writer');
// Route::post('writer/gallery/store', [App\Http\Controllers\GalleryController::class, 'wstore'])->middleware('is_writer');
// Route::get('writer/gallery/destroy/{id}', [App\Http\Controllers\GalleryController::class, 'wdestroy'])->middleware('is_writer');
// Route::get('writer/gallery/edit/{id}', [App\Http\Controllers\GalleryController::class, 'wedit'])->middleware('is_writer');
// Route::post('writer/gallery/update', [App\Http\Controllers\GalleryController::class, 'wupdate'])->middleware('is_writer');
// Route::get('writer/gallery/innotice/{id}', [App\Http\Controllers\GalleryController::class, 'winnotice'])->middleware('is_writer');
// Route::get('writer/gallery/acnotice/{id}', [App\Http\Controllers\GalleryController::class, 'wacnotice'])->middleware('is_writer');



// Route::get('writer/post', [App\Http\Controllers\PostController::class, 'windex'])->middleware('is_writer');
// Route::get('writer/post/create', [App\Http\Controllers\PostController::class, 'wcreate'])->middleware('is_writer');
// Route::post('writer/post/store', [App\Http\Controllers\PostController::class, 'wstore'])->middleware('is_writer');
// Route::get('writer/post/destroy/{id}', [App\Http\Controllers\PostController::class, 'wdestroy'])->middleware('is_writer');

// Route::get('writer/post/sinnotice/{id}', [App\Http\Controllers\PostController::class, 'wsinnotice'])->middleware('is_writer');
// Route::get('writer/post/sacnotice/{id}', [App\Http\Controllers\PostController::class, 'wsacnotice'])->middleware('is_writer');
// Route::get('writer/post/ninnotice/{id}', [App\Http\Controllers\PostController::class, 'wninnotice'])->middleware('is_writer');
// Route::get('writer/post/nacnotice/{id}', [App\Http\Controllers\PostController::class, 'wnacnotice'])->middleware('is_writer');
// Route::get('writer/post/hinnotice/{id}', [App\Http\Controllers\PostController::class, 'whinnotice'])->middleware('is_writer');
// Route::get('writer/post/hacnotice/{id}', [App\Http\Controllers\PostController::class, 'whacnotice'])->middleware('is_writer');
// Route::post('writer/post/update', [App\Http\Controllers\PostController::class, 'wupdate'])->middleware('is_writer');
// Route::post('writer/post/publish', [App\Http\Controllers\PostController::class, 'wpublish'])->middleware('is_writer');
// Route::post('writer/post/remove', [App\Http\Controllers\PostController::class, 'wremove'])->middleware('is_writer');





// Route::resource('admin/slider','App\Http\Controllers\SliderController')->middleware('is_admin');
// Route::get('admin/slider/destroy/{id}', [App\Http\Controllers\SliderController::class, 'destroy'])->middleware('is_admin');
// Route::get('admin/slider/edit/{id}', [App\Http\Controllers\SliderController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/slider/update', [App\Http\Controllers\SliderController::class, 'update'])->middleware('is_admin');
// Route::get('admin/slider/innotice/{id}', [App\Http\Controllers\SliderController::class, 'innotice'])->middleware('is_admin');
// Route::get('admin/slider/acnotice/{id}', [App\Http\Controllers\SliderController::class, 'acnotice'])->middleware('is_admin');


// Route::get('admin/post', [App\Http\Controllers\PostController::class, 'index'])->middleware('is_admin');
// Route::get('admin/post/create', [App\Http\Controllers\PostController::class, 'create'])->middleware('is_admin');
// Route::post('admin/post/store', [App\Http\Controllers\PostController::class, 'store'])->middleware('is_admin');
// Route::get('admin/post/destroy/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->middleware('is_admin');
// Route::get('admin/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->middleware('is_admin');
// Route::get('admin/post/sinnotice/{id}', [App\Http\Controllers\PostController::class, 'sinnotice'])->middleware('is_admin');
// Route::get('admin/post/sacnotice/{id}', [App\Http\Controllers\PostController::class, 'sacnotice'])->middleware('is_admin');
// Route::get('admin/post/ninnotice/{id}', [App\Http\Controllers\PostController::class, 'ninnotice'])->middleware('is_admin');
// Route::get('admin/post/nacnotice/{id}', [App\Http\Controllers\PostController::class, 'nacnotice'])->middleware('is_admin');
// Route::get('admin/post/hinnotice/{id}', [App\Http\Controllers\PostController::class, 'hinnotice'])->middleware('is_admin');
// Route::get('admin/post/hacnotice/{id}', [App\Http\Controllers\PostController::class, 'hacnotice'])->middleware('is_admin');
// Route::post('admin/post/update', [App\Http\Controllers\PostController::class, 'update'])->middleware('is_admin');
// Route::post('admin/post/publish', [App\Http\Controllers\PostController::class, 'publish'])->middleware('is_admin');
// Route::post('admin/post/remove', [App\Http\Controllers\PostController::class, 'remove'])->middleware('is_admin');

// Route::get('admin/gallery', [App\Http\Controllers\GalleryController::class, 'index'])->middleware('is_admin');
// Route::get('admin/gallery/create', [App\Http\Controllers\GalleryController::class, 'create'])->middleware('is_admin');
// Route::post('admin/gallery/store', [App\Http\Controllers\GalleryController::class, 'store'])->middleware('is_admin');
// Route::get('admin/gallery/destroy/{id}', [App\Http\Controllers\GalleryController::class, 'destroy'])->middleware('is_admin');
// Route::get('admin/gallery/edit/{id}', [App\Http\Controllers\GalleryController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/gallery/update', [App\Http\Controllers\GalleryController::class, 'update'])->middleware('is_admin');
// Route::get('admin/gallery/innotice/{id}', [App\Http\Controllers\GalleryController::class, 'innotice'])->middleware('is_admin');
// Route::get('admin/gallery/acnotice/{id}', [App\Http\Controllers\GalleryController::class, 'acnotice'])->middleware('is_admin');


// Route::get('admin/leadership', [App\Http\Controllers\LeadershipController::class, 'index'])->middleware('is_admin');
// Route::get('admin/leadership/create', [App\Http\Controllers\LeadershipController::class, 'create'])->middleware('is_admin');
// Route::post('admin/leadership/store', [App\Http\Controllers\LeadershipController::class, 'store'])->middleware('is_admin');
// Route::get('admin/leadership/destroy/{id}', [App\Http\Controllers\LeadershipController::class, 'destroy'])->middleware('is_admin');
// Route::get('admin/leadership/edit/{id}', [App\Http\Controllers\LeadershipController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/leadership/update', [App\Http\Controllers\LeadershipController::class, 'update'])->middleware('is_admin');
// Route::get('admin/leadership/innotice/{id}', [App\Http\Controllers\LeadershipController::class, 'innotice'])->middleware('is_admin');
// Route::get('admin/leadership/acnotice/{id}', [App\Http\Controllers\LeadershipController::class, 'acnotice'])->middleware('is_admin');






// Route::get('admin/massege', [App\Http\Controllers\MassegeController::class, 'index'])->middleware('is_admin');
// Route::get('admin/massege/create', [App\Http\Controllers\MassegeController::class, 'create'])->middleware('is_admin');
// Route::post('admin/massege/store', [App\Http\Controllers\MassegeController::class, 'store'])->middleware('is_admin');
// Route::get('admin/massege/destroy/{id}', [App\Http\Controllers\MassegeController::class, 'destroy'])->middleware('is_admin');
// Route::get('admin/massege/edit/{id}', [App\Http\Controllers\MassegeController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/massege/update', [App\Http\Controllers\MassegeController::class, 'update'])->middleware('is_admin');
// Route::get('admin/massege/innotice/{id}', [App\Http\Controllers\MassegeController::class, 'innotice'])->middleware('is_admin');
// Route::get('admin/massege/acnotice/{id}', [App\Http\Controllers\MassegeController::class, 'acnotice'])->middleware('is_admin');


// Route::get('admin/former', [App\Http\Controllers\FormerController::class, 'index'])->middleware('is_admin');
// Route::get('admin/former/create', [App\Http\Controllers\FormerController::class, 'create'])->middleware('is_admin');
// Route::post('admin/former/store', [App\Http\Controllers\FormerController::class, 'store'])->middleware('is_admin');
// Route::get('admin/former/destroy/{id}', [App\Http\Controllers\FormerController::class, 'destroy'])->middleware('is_admin');
// Route::get('admin/former/edit/{id}', [App\Http\Controllers\FormerController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/former/update', [App\Http\Controllers\FormerController::class, 'update'])->middleware('is_admin');
// Route::get('admin/former/innotice/{id}', [App\Http\Controllers\FormerController::class, 'innotice'])->middleware('is_admin');
// Route::get('admin/former/acnotice/{id}', [App\Http\Controllers\FormerController::class, 'acnotice'])->middleware('is_admin');


// Route::get('admin/successe', [App\Http\Controllers\SuccessController::class, 'index'])->middleware('is_admin');
// Route::get('admin/successe/create', [App\Http\Controllers\SuccessController::class, 'create'])->middleware('is_admin');
// Route::post('admin/successe/store', [App\Http\Controllers\SuccessController::class, 'store'])->middleware('is_admin');
// Route::get('admin/successe/destroy/{id}', [App\Http\Controllers\SuccessController::class, 'destroy'])->middleware('is_admin');
// Route::get('admin/successe/edit/{id}', [App\Http\Controllers\SuccessController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/successe/update', [App\Http\Controllers\SuccessController::class, 'update'])->middleware('is_admin');
// Route::get('admin/successe/innotice/{id}', [App\Http\Controllers\SuccessController::class, 'innotice'])->middleware('is_admin');
// Route::get('admin/successe/acnotice/{id}', [App\Http\Controllers\SuccessController::class, 'acnotice'])->middleware('is_admin');


// Route::get('admin/video', [App\Http\Controllers\VideoController::class, 'index'])->middleware('is_admin');
// Route::get('admin/video/create', [App\Http\Controllers\VideoController::class, 'create'])->middleware('is_admin');
// Route::post('admin/video/store', [App\Http\Controllers\VideoController::class, 'store'])->middleware('is_admin');
// Route::get('admin/video/destroy/{id}', [App\Http\Controllers\VideoController::class, 'destroy'])->middleware('is_admin');
// Route::get('admin/video/edit/{id}', [App\Http\Controllers\VideoController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/video/update', [App\Http\Controllers\VideoController::class, 'update'])->middleware('is_admin');
// Route::get('admin/video/innotice/{id}', [App\Http\Controllers\VideoController::class, 'innotice'])->middleware('is_admin');
// Route::get('admin/video/acnotice/{id}', [App\Http\Controllers\VideoController::class, 'acnotice'])->middleware('is_admin');



// Route::get('admin/docment', [App\Http\Controllers\DocmentController::class, 'index'])->middleware('is_admin');
// Route::get('admin/docment/create', [App\Http\Controllers\DocmentController::class, 'create'])->middleware('is_admin');
// Route::post('admin/docment/store', [App\Http\Controllers\DocmentController::class, 'store'])->middleware('is_admin');
// Route::get('admin/docment/edit/{id}', [App\Http\Controllers\DocmentController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/docment/update', [App\Http\Controllers\DocmentController::class, 'update'])->middleware('is_admin');
// Route::get('admin/docment/destroy/{id}', [App\Http\Controllers\DocmentController::class, 'destroy'])->middleware('is_admin');


// Route::get('admin/user', [App\Http\Controllers\UserController::class, 'index'])->middleware('is_admin');
// Route::get('admin/user/create', [App\Http\Controllers\UserController::class, 'create'])->middleware('is_admin');
// Route::post('admin/user/store', [App\Http\Controllers\UserController::class, 'store'])->middleware('is_admin');
// Route::get('admin/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/user/update', [App\Http\Controllers\UserController::class, 'update'])->middleware('is_admin');
// Route::get('admin/user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('is_admin');


// Route::get('admin/committee', [App\Http\Controllers\CommitteeController::class, 'index'])->middleware('is_admin');
// Route::get('admin/committee/create', [App\Http\Controllers\CommitteeController::class, 'create'])->middleware('is_admin');
// Route::post('admin/committee/store', [App\Http\Controllers\CommitteeController::class, 'store'])->middleware('is_admin');
// Route::get('admin/committee/edit/{id}', [App\Http\Controllers\CommitteeController::class, 'edit'])->middleware('is_admin');
// Route::post('admin/committee/update', [App\Http\Controllers\CommitteeController::class, 'update'])->middleware('is_admin');
// Route::get('admin/committee/destroy/{id}', [App\Http\Controllers\CommitteeController::class, 'destroy'])->middleware('is_admin');

// Route::get('admin/event', [App\Http\Controllers\EventController::class, 'index'])->middleware('is_admin');
// Route::get('admin/service', [App\Http\Controllers\ServiceController::class, 'index'])->middleware('is_admin');
// Route::get('admin/blog', [App\Http\Controllers\BlogController::class, 'index'])->middleware('is_admin');


Route::middleware(['is_admin'])->group(function () {
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');  
Route::resource('admin/slider','App\Http\Controllers\SliderController');
Route::get('admin/slider/destroy/{id}', [App\Http\Controllers\SliderController::class, 'destroy']);
Route::get('admin/slider/edit/{id}', [App\Http\Controllers\SliderController::class, 'edit']);
Route::post('admin/slider/update', [App\Http\Controllers\SliderController::class, 'update']);
Route::get('admin/slider/innotice/{id}', [App\Http\Controllers\SliderController::class, 'innotice']);
Route::get('admin/slider/acnotice/{id}', [App\Http\Controllers\SliderController::class, 'acnotice']);


Route::get('admin/post', [App\Http\Controllers\PostController::class, 'index']);
Route::get('admin/post/create', [App\Http\Controllers\PostController::class, 'create']);
Route::post('admin/post/store', [App\Http\Controllers\PostController::class, 'store']);
Route::get('admin/post/destroy/{id}', [App\Http\Controllers\PostController::class, 'destroy']);
Route::get('admin/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit']);
Route::get('admin/post/sinnotice/{id}', [App\Http\Controllers\PostController::class, 'sinnotice']);
Route::get('admin/post/sacnotice/{id}', [App\Http\Controllers\PostController::class, 'sacnotice']);
Route::get('admin/post/ninnotice/{id}', [App\Http\Controllers\PostController::class, 'ninnotice']);
Route::get('admin/post/nacnotice/{id}', [App\Http\Controllers\PostController::class, 'nacnotice']);
Route::get('admin/post/hinnotice/{id}', [App\Http\Controllers\PostController::class, 'hinnotice']);
Route::get('admin/post/hacnotice/{id}', [App\Http\Controllers\PostController::class, 'hacnotice']);
Route::post('admin/post/update', [App\Http\Controllers\PostController::class, 'update']);
Route::post('admin/post/publish', [App\Http\Controllers\PostController::class, 'publish']);
Route::post('admin/post/remove', [App\Http\Controllers\PostController::class, 'remove']);

Route::get('admin/gallery', [App\Http\Controllers\GalleryController::class, 'index']);
Route::get('admin/gallery/create', [App\Http\Controllers\GalleryController::class, 'create']);
Route::post('admin/gallery/store', [App\Http\Controllers\GalleryController::class, 'store']);
Route::get('admin/gallery/destroy/{id}', [App\Http\Controllers\GalleryController::class, 'destroy']);
Route::get('admin/gallery/edit/{id}', [App\Http\Controllers\GalleryController::class, 'edit']);
Route::post('admin/gallery/update', [App\Http\Controllers\GalleryController::class, 'update']);
Route::get('admin/gallery/innotice/{id}', [App\Http\Controllers\GalleryController::class, 'innotice']);
Route::get('admin/gallery/acnotice/{id}', [App\Http\Controllers\GalleryController::class, 'acnotice']);


Route::get('admin/leadership', [App\Http\Controllers\LeadershipController::class, 'index']);
Route::get('admin/leadership/create', [App\Http\Controllers\LeadershipController::class, 'create']);
Route::post('admin/leadership/store', [App\Http\Controllers\LeadershipController::class, 'store']);
Route::get('admin/leadership/destroy/{id}', [App\Http\Controllers\LeadershipController::class, 'destroy']);
Route::get('admin/leadership/edit/{id}', [App\Http\Controllers\LeadershipController::class, 'edit']);
Route::post('admin/leadership/update', [App\Http\Controllers\LeadershipController::class, 'update']);
Route::get('admin/leadership/innotice/{id}', [App\Http\Controllers\LeadershipController::class, 'innotice']);
Route::get('admin/leadership/acnotice/{id}', [App\Http\Controllers\LeadershipController::class, 'acnotice']);






Route::get('admin/massege', [App\Http\Controllers\MassegeController::class, 'index']);
Route::get('admin/massege/create', [App\Http\Controllers\MassegeController::class, 'create']);
Route::post('admin/massege/store', [App\Http\Controllers\MassegeController::class, 'store']);
Route::get('admin/massege/destroy/{id}', [App\Http\Controllers\MassegeController::class, 'destroy']);
Route::get('admin/massege/edit/{id}', [App\Http\Controllers\MassegeController::class, 'edit']);
Route::post('admin/massege/update', [App\Http\Controllers\MassegeController::class, 'update']);
Route::get('admin/massege/innotice/{id}', [App\Http\Controllers\MassegeController::class, 'innotice']);
Route::get('admin/massege/acnotice/{id}', [App\Http\Controllers\MassegeController::class, 'acnotice']);


Route::get('admin/former', [App\Http\Controllers\FormerController::class, 'index']);
Route::get('admin/former/create', [App\Http\Controllers\FormerController::class, 'create']);
Route::post('admin/former/store', [App\Http\Controllers\FormerController::class, 'store']);
Route::get('admin/former/destroy/{id}', [App\Http\Controllers\FormerController::class, 'destroy']);
Route::get('admin/former/edit/{id}', [App\Http\Controllers\FormerController::class, 'edit']);
Route::post('admin/former/update', [App\Http\Controllers\FormerController::class, 'update']);
Route::get('admin/former/innotice/{id}', [App\Http\Controllers\FormerController::class, 'innotice']);
Route::get('admin/former/acnotice/{id}', [App\Http\Controllers\FormerController::class, 'acnotice']);


Route::get('admin/successe', [App\Http\Controllers\SuccessController::class, 'index']);
Route::get('admin/successe/create', [App\Http\Controllers\SuccessController::class, 'create']);
Route::post('admin/successe/store', [App\Http\Controllers\SuccessController::class, 'store']);
Route::get('admin/successe/destroy/{id}', [App\Http\Controllers\SuccessController::class, 'destroy']);
Route::get('admin/successe/edit/{id}', [App\Http\Controllers\SuccessController::class, 'edit']);
Route::post('admin/successe/update', [App\Http\Controllers\SuccessController::class, 'update']);
Route::get('admin/successe/innotice/{id}', [App\Http\Controllers\SuccessController::class, 'innotice']);
Route::get('admin/successe/acnotice/{id}', [App\Http\Controllers\SuccessController::class, 'acnotice']);


Route::get('admin/video', [App\Http\Controllers\VideoController::class, 'index']);
Route::get('admin/video/create', [App\Http\Controllers\VideoController::class, 'create']);
Route::post('admin/video/store', [App\Http\Controllers\VideoController::class, 'store']);
Route::get('admin/video/destroy/{id}', [App\Http\Controllers\VideoController::class, 'destroy']);
Route::get('admin/video/edit/{id}', [App\Http\Controllers\VideoController::class, 'edit']);
Route::post('admin/video/update', [App\Http\Controllers\VideoController::class, 'update']);
Route::get('admin/video/innotice/{id}', [App\Http\Controllers\VideoController::class, 'innotice']);
Route::get('admin/video/acnotice/{id}', [App\Http\Controllers\VideoController::class, 'acnotice']);



Route::get('admin/docment', [App\Http\Controllers\DocmentController::class, 'index']);
Route::get('admin/docment/create', [App\Http\Controllers\DocmentController::class, 'create']);
Route::post('admin/docment/store', [App\Http\Controllers\DocmentController::class, 'store']);
Route::get('admin/docment/edit/{id}', [App\Http\Controllers\DocmentController::class, 'edit']);
Route::post('admin/docment/update', [App\Http\Controllers\DocmentController::class, 'update']);
Route::get('admin/docment/destroy/{id}', [App\Http\Controllers\DocmentController::class, 'destroy']);


Route::get('admin/user', [App\Http\Controllers\UserController::class, 'index']);
Route::get('admin/user/create', [App\Http\Controllers\UserController::class, 'create']);
Route::post('admin/user/store', [App\Http\Controllers\UserController::class, 'store']);
Route::get('admin/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::post('admin/user/update', [App\Http\Controllers\UserController::class, 'update']);
Route::get('admin/user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy']);


Route::get('admin/committee', [App\Http\Controllers\CommitteeController::class, 'index']);
Route::get('admin/committee/create', [App\Http\Controllers\CommitteeController::class, 'create']);
Route::post('admin/committee/store', [App\Http\Controllers\CommitteeController::class, 'store']);
Route::get('admin/committee/edit/{id}', [App\Http\Controllers\CommitteeController::class, 'edit']);
Route::post('admin/committee/update', [App\Http\Controllers\CommitteeController::class, 'update']);
Route::get('admin/committee/destroy/{id}', [App\Http\Controllers\CommitteeController::class, 'destroy']);

Route::get('admin/event', [App\Http\Controllers\EventController::class, 'index']);
Route::post('admin/event/store', [App\Http\Controllers\EventController::class, 'store']);
Route::post('admin/event/update', [App\Http\Controllers\EventController::class, 'update']);
Route::get('admin/event/destroy/{id}', [App\Http\Controllers\EventController::class, 'destroy']);

Route::get('admin/service', [App\Http\Controllers\ServiceController::class, 'index']);
Route::get('admin/blog', [App\Http\Controllers\BlogController::class, 'index']);
});

