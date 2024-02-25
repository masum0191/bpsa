<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/verify', [App\Http\Controllers\Auth\RegisterController::class, 'pverify']);
Route::get('/pms/', [App\Http\Controllers\Api\ApiControllers::class, 'pms']);
//Route::get('/pms-data/{id}', [App\Http\Controllers\Api\ApiControllers::class, 'pmsdata']);
Route::get('/forgetpass', [App\Http\Controllers\Auth\RegisterController::class, 'forgetpass']);
Route::get('/verify1', [App\Http\Controllers\Auth\RegisterController::class, 'pverify1']);
Route::post('/signup', [App\Http\Controllers\Auth\RegisterController::class, 'sign_up']);
Route::post('/login', [App\Http\Controllers\Auth\RegisterController::class, 'login']);

Route::get('/makeApiRequest', [App\Http\Controllers\Auth\RegisterController::class, 'getAccessToken']);
Route::put('/profile-update/{member_id}', [App\Http\Controllers\Auth\RegisterController::class, 'profile_update']);
Route::get('/profile/{member_id}', [App\Http\Controllers\Auth\RegisterController::class, 'profile']);
Route::get('/profiles', [App\Http\Controllers\Auth\RegisterController::class, 'pmsdata']);
Route::post('/change-password', [App\Http\Controllers\Auth\RegisterController::class, 'change_pass']);
Route::post('/change-password-member', [App\Http\Controllers\Auth\RegisterController::class, 'changepasswordmember']);
Route::post('/member-status', [App\Http\Controllers\Controller::class, 'user_role']);
Route::post('/admin-status', [App\Http\Controllers\Controller::class, 'admin_status']);

Route::middleware('auth:sanctum')->group( function (){
Route::get('/blog/{mid}', [App\Http\Controllers\Controller::class, 'blog']);
Route::get('/blog', [App\Http\Controllers\Controller::class, 'blogs']);
Route::post('/blog-status', [App\Http\Controllers\Controller::class, 'blog_status']);
Route::post('/blog-create', [App\Http\Controllers\Controller::class, 'blog_create']);  
Route::post('/blog-update', [App\Http\Controllers\Controller::class, 'blog_update']);  
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/adminlist/{admin}', [App\Http\Controllers\Controller::class, 'adminlist']);
Route::get('/slider', [App\Http\Controllers\Controller::class, 'slider']);
Route::get('/notice', [App\Http\Controllers\Controller::class, 'notice']);
Route::get('/noticepage', [App\Http\Controllers\Controller::class, 'noticepage']);
Route::get('/highlight', [App\Http\Controllers\Controller::class, 'highlight']);
Route::get('/event', [App\Http\Controllers\Controller::class, 'event']);
Route::get('/get-event/{id}', [App\Http\Controllers\Controller::class, 'get_event']);
Route::get('/success', [App\Http\Controllers\Controller::class, 'success']);
Route::get('/video', [App\Http\Controllers\Controller::class, 'video']);
Route::get('/gallery', [App\Http\Controllers\Controller::class, 'gallery']);
Route::get('/massege', [App\Http\Controllers\Controller::class, 'massege']);
Route::get('/leadership', [App\Http\Controllers\Controller::class, 'leadership']);
Route::get('/service', [App\Http\Controllers\Controller::class, 'service']);
Route::get('/Approvedblog', [App\Http\Controllers\Controller::class, 'Approvedblog']);
//Route::post('/blog-create', [App\Http\Controllers\Controller::class, 'blog_create']);
Route::get('/local', [App\Http\Controllers\Controller::class, 'local']);
Route::get('/international', [App\Http\Controllers\Controller::class, 'international']);
Route::get('/gcategory', [App\Http\Controllers\Controller::class, 'gcategory']);
Route::get('/get_gallery/{gcat_id}', [App\Http\Controllers\Controller::class, 'get_gallery']);
Route::get('/get_video/{gcat_id}', [App\Http\Controllers\Controller::class, 'get_video']);
Route::get('/get_news/{id}', [App\Http\Controllers\Controller::class, 'get_news']);
Route::get('/get_massege/{id}', [App\Http\Controllers\Controller::class, 'get_massege']);
Route::get('/get_home_page_gallery', [App\Http\Controllers\Controller::class, 'get_home_page_gallery']);
Route::post('/contact', [App\Http\Controllers\Controller::class, 'contact']);
Route::get('/former', [App\Http\Controllers\Controller::class, 'former']);
Route::get('/committee', [App\Http\Controllers\Controller::class, 'committee']);
Route::get('/committee/session/{session}', [App\Http\Controllers\Controller::class, 'committee_session']);
// News api
Route::get('/news-update', [App\Http\Controllers\Controller::class, 'update_news']);
Route::get('/news', [App\Http\Controllers\Controller::class, 'news']);
Route::get('/news-morning', [App\Http\Controllers\Controller::class, 'news_morning']);
Route::get('/news-activity-Update', [App\Http\Controllers\Controller::class, 'news_activity_Update']);
Route::get('/news-congratulation-on-achievenemnt', [App\Http\Controllers\Controller::class, 'news_congratulation_on_achievenemnt']);

// about page
Route::get('/document', [App\Http\Controllers\Controller::class, 'document']);