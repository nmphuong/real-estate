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




Route::middleware('guest:web')->group(function(){
	Route::post('xu-ly-dang-nhap',[
        'as'=>'xu-ly-dang-nhap',
        'uses'=> 'PageAdminController@loginadmins'
    ]);

    Route::get('admin-login', [
        'as'=> 'admin-login',
        'uses'=>'PageAdminController@LoginView'
    ]);
    
});

Route::get('/statistical-admin', [
    'as'=> 'statistical-admin',
    'uses'=>'PageAdminController@overall'
]);

Route::get('/get-detail-news/{id}', [
    'as'=> 'get-detail-news',
    'uses'=>'PageAdminController@getDetailNews'
]);

Route::get('/add-news', [
    'as'=> 'add-news',
    'uses'=>'PageAdminController@viewAddNews'
]);

Route::post('/xu-ly-them-tin-tuc', [
    'as'=> 'xu-ly-them-tin-tuc',
    'uses'=>'PageAdminController@AddNews'
]);

Route::post('/xu-ly-cap-nhat/{id}', [
    'as'=> 'xu-ly-cap-nhat',
    'uses'=>'PageAdminController@update'
]);

Route::get('/search', [
    'as'=> 'search',
    'uses'=>'PageAdminController@SearchProject'
]);
//căn hộ
Route::get('/list-apartment', [
    'as'=> 'list-apartment',
    'uses'=>'PageAdminController@getApartment'
]);
//đất nền
Route::get('/list-the-ground', [
    'as'=> 'list-the-ground',
    'uses'=>'PageAdminController@getTheground'
]);
//nhà phố townhouse
Route::get('/list-townhouse', [
    'as'=> 'list-townhouse',
    'uses'=>'PageAdminController@getTownhouse'
]);
//biệt thự getVilla
Route::get('/list-villa', [
    'as'=> 'list-villa',
    'uses'=>'PageAdminController@getVilla'
]);
//chung cư
Route::get('/list-apartment2', [
    'as'=> 'list-apartment2',
    'uses'=>'PageAdminController@getallApartment'
]);
//nhà trọ Motel
Route::get('/list-motel', [
    'as'=> 'list-motel',
    'uses'=>'PageAdminController@getMotel'
]);
//cho thuê Lease
Route::get('/list-lease', [
    'as'=> 'list-lease',
    'uses'=>'PageAdminController@getLease'
]);

Route::get('/detail-post/{id}', [
    'as' => 'detail-post',
    'uses' => 'PageAdminController@getDetailPost'
]);

Route::get('/delete-pro/{id}', [
    'as'=> 'delete-pro',
    'uses'=>'PageAdminController@DeleteProject'
]);

Route::get('del-news/{id}', [
    'as' => 'del-news',
    'uses' => 'PageAdminController@DelNews'
]);

Route::get('update-news/{id}', [
    'as' => 'update-news',
    'uses' => 'PageAdminController@UpdateNews'
]);

Route::get('/delete-post/{id}', [
    'as'=> 'delete-post',
    'uses'=>'PageAdminController@DeletePost'
]);

Route::get('/delete-user/{id}', [
    'as'=> 'delete-user',
    'uses'=>'PageAdminController@DeleteAccount'
]);

Route::get('/detail-project/{id}', [
    'as'=> 'detail-project',
    'uses'=>'PageAdminController@detailProject'
]);

Route::get('/confirm-project/{id}', [
    'as'=> 'confirm-project',
    'uses'=>'PageAdminController@ConfirmProject'
]);

Route::get('/ban-project/{id}', [
    'as'=> 'ban-project',
    'uses'=>'PageAdminController@BanProject'
]);

Route::get('/list-customer', [
    'as'=> 'list-customer',
    'uses'=>'PageAdminController@ListAccount'
]);

Route::get('/detail-account/{id}', [
    'as'=> 'detail-account',
    'uses'=>'PageAdminController@detailCustomer'
]);

Route::get('/list-all-project', [
    'as'=> 'list-all-project',
    'uses'=>'PageAdminController@ListJob'
]);

Route::get('/change-status-job/{id}', [
    'as'=> 'change-status-job',
    'uses'=>'PageAdminController@ChangeStatusJob'
]);

Route::get('/get-all-news', [
    'as'=> 'get-all-news',
    'uses'=>'PageAdminController@GetAllNews'
]);

Route::get('/logout-admin', [
    'as'=> 'logout-admin',
    'uses'=>'PageAdminController@Logout'
]);

Route::get('/slideshow', [
    'as'=> 'slideshow',
    'uses'=>'PageAdminController@ViewBanner'
]);

Route::get('/add-banner', [
    'as'=> 'add-banner',
    'uses'=>'PageAdminController@ViewAddBanner'
]);

Route::post('/add-category', [
    'as'=> 'add-category',
    'uses'=>'PageAdminController@AddCategory'
]);

Route::post('/add-job', [
    'as'=> 'add-job',
    'uses'=>'PageAdminController@AddJob'
]);

Route::get('/delete-job/{id}', [
    'as'=> 'delete-job',
    'uses'=>'PageAdminController@DeleteJob'
]);

Route::get('/category', [
    'as'=> 'category',
    'uses'=>'PageAdminController@ViewCategory'
]);

Route::get('/detail-category/{id}', [
    'as'=> 'detail-category',
    'uses'=>'PageAdminController@DetailCategory'
]);

Route::post('/update-category/{id}', [
    'as'=> 'update-category',
    'uses'=>'PageAdminController@UpdateCategory'
]);

Route::get('/delete-category/{id}', [
    'as'=> 'delete-category',
    'uses'=>'PageAdminController@DeleteCategory'
]);

Route::get('/restore-category', [
    'as'=> 'restore-category',
    'uses'=>'PageAdminController@binCategory'
]);

Route::get('/restore/{id}', [
    'as'=> 'restore',
    'uses'=>'PageAdminController@restoreCategory'
]);

Route::post('/xu-ly-them-banner', [
    'as'=> 'xu-ly-them-banner',
    'uses'=>'PageAdminController@AddBanner'
]);

Route::get('/hide-banner/{id}', [
    'as'=> 'hide-banner',
    'uses'=>'PageAdminController@HideBanner'
]);

Route::get('/delete-banner/{id}', [
    'as'=> 'delete-banner',
    'uses'=>'PageAdminController@DelBanner'
]);

Route::get('view-detail-project/{id}',[
    'as'=> 'view-detail-project',
    'uses'=>'PageAdminController@DetailProjectMail'
]);

Route::get('chat',[
    'as'=> 'chat',
    'uses'=>'ChatController@index'
]);

Route::get('user-chat',[
    'as'=> 'user-chat',
    'uses'=>'ChatController@userchat'
]);

Route::get('list-project', [
    'as' => 'list-project',
    'uses' => 'PageAdminController@ListProject'
]);

Route::get('exception', [
    'as' => 'exception',
    'uses' => 'PageAdminController@Exception'
]);

Route::get('/message/{id}', [App\Http\Controllers\ChatController::class, 'getMessage'])->name('message');
Route::post('message', [App\Http\Controllers\ChatController::class, 'sendMessage']);

Route::get('firebase','FirebaseController@index');