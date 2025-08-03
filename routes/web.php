<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ITEquipmentController;
use App\Http\Controllers\RequisitionController;

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

if(env('APP_ENV')=='production'){
    \Illuminate\Support\Facades\URL::forceScheme('https');
}

Route::get('/', function () {
    return view('landing.landing');
});

/***
 ** AUTHENTICATION Routing Start Here
 ***/
Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@authenticate')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');
/***
 ** AUTHENTICATION Routing End Here
 ***/

/***
 ** ERROR 404
 ***/
Route::get('/nopermission', function(){
    return back();
})->name('nopermission');

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('profile','ProfileController@profile')->name('profile');
Route::post('profile','ProfileController@profileUpdate')->name('profile.update');
Route::post('change-password','ProfileController@changePassword')->name('profile.change-password');

Route::get('/dashboard', 'DashboardController@Dashboard')->name('dashboard');
Route::get('/map-dashboard', 'DashboardController@MapDashboard')->name('map-dashboard');
Route::get('/district-dashboard', 'DashboardController@DistrictDashboard')->name('district-dashboard');
Route::get('/upazila-dashboard', 'DashboardController@UpazilaDashboard')->name('upazila-dashboard');
//Route::get('/dashboard', 'DocumentController@dashboard')->name('dashboard');

Route::post('/getAdminByCode', 'AdminController@GetInfo')->name('getAdminByCode');
Route::post('/getGeomByCode', 'AdminController@GetGeom')->name('getGeomByCode');
Route::post('/GetCascadeGeom', 'AdminController@GetCascadeGeom')->name('GetCascadeGeom');
Route::post('/GetMauzaSummary', 'AdminController@GetMauzaSummary')->name('GetMauzaSummary');
Route::post('/GetMauzaFilterdSummary', 'AdminController@GetMauzaFilterdSummary')->name('GetMauzaFilterdSummary');

Route::post('/GetPlotInfo', 'AdminController@GetPlotInfo')->name('GetPlotInfo');


Route::middleware('auth')->group(function () {
    // Route::resource('comments', 'CommentController');
    Route::get('/notifications', 'NotificationController@index');
    Route::post('/notification/create', 'NotificationController@addNotification')->name('notification.add');
    Route::post('/seen/notification/{notificationId}', 'NotificationController@notificationSeen')->name('notification.seen');
    Route::get('/notification/count', 'NotificationController@count');

    Route::get('/feedback-list', 'FeedbackController@index');
    Route::get('/feedback/{feedbackId}/show', 'FeedbackController@show');
    Route::put('/feedback/{feedbackId}/resolved', 'FeedbackController@resolve')->name('feedback.resolve');
});

// ONLY ADMIN - App Access
Route::group(['middleware' => ['auth','roles'], 'roles' => ['devadmin', 'superadmin', 'admin']], function(){
    Route::resource('documents', 'DocumentController');
    //Route::get('/documents-dashboard', 'DocumentController@dashboard')->name('documents.dashboard');
    Route::delete('/documents/{id}', 'DocumentController@destroy')->name('documents.destroy');
    //Route::post('/save-doc-type','DocTypeController@store');
    Route::post('/delete-doc-file','DocumentFileController@delete');
});

Route::group(['prefix'=>'admin','as'=>'admin.','middleware' => ['auth','roles'], 'roles' => ['devadmin', 'superadmin', 'admin']], function(){
    Route::resource('users','UserController');
    Route::get('/FilteredUserData', 'UserController@FilteredUserData')->name('FilteredUserData');
    Route::get('/UserSwitchUpdate', 'UserController@UserSwitchUpdate')->name('UserSwitchUpdate');
    Route::resource('user-roles','RoleController');
    Route::get('/RoleSwitchUpdate', 'RoleController@RoleSwitchUpdate')->name('RoleSwitchUpdate');

    Route::resource('menus', 'MenuController');
    Route::get('/menu-role-permission', 'PermissionController@menuRolePermissions')->name('MenuRolePermission');
    Route::get('/menu-role-permission/{menuId}', 'PermissionController@AssignRolePermission')->name('AssignPermission.data');
    Route::post('/menu-role-permission/update/{menuId}', 'PermissionController@UpdatePermission')->name('AssignPermission.update');

    Route::resource('permissions','PermissionController');
    Route::get('/assign-permission/{permissionId}', 'PermissionController@assignPermission')->name('permission.assign');
    Route::post('/assign-permission/update/{permissionId}', 'PermissionController@assignPermissionUpdate')->name('permission.assign.update');

    Route::get('/sms-configuration', 'SmsConfigurationController@create')->name('SmsConfiguration.create');
    Route::post('sms-configuration', 'SmsConfigurationController@store')->name('SmsConfiguration.store');
    //RUH
   // Route::resource('itequipments','ITEquipmentController');  // Use Route This way
    Route::resource('memos','MemoController');
    Route::resource('comment','CommentController');
    //Requisition
    Route::resource('requisitions','RequisitionController');
    Route::get('/transfer-list', 'TransferController@getTransferList')->name('transfer-list');
   // Route::get('requisitions/report/{id}', 'RequisitionController@report')->name('requisitions.report');

});

Route::get('admin/requisitions/report/{id}', 'RequisitionController@report')->name('requisitions.report');




// category and subcategory list dropdown
Route::get('/bd-district-list', [RequisitionController::class, 'getProjects']);
//Route::get('/bd-district-list', [RequisitionController::class, 'getCategory']);
Route::get('/get-equipments-by-subcategory', [RequisitionController::class, 'getSubCategory']);



// // start added by ADS

// Route::prefix('report')->group(function (){
//      Route::get('/division-landuse', 'ReportingController@DivisionLanduse');
//      Route::get('/district-landuse', 'ReportingController@DistrictLanduse');
//      Route::get('/upazilla-landuse', 'ReportingController@UpazillaLanduse');

//      Route::get('/division-landuse/json/{areacode?}', 'ReportingController@DivisionLanduseJson');
//      Route::get('/district-landuse/json/{areacode?}', 'ReportingController@DistrictLanduseJson');
//      Route::get('/upazilla-landuse/json/{areacode?}', 'ReportingController@UpazillaLanduseJson');

//      Route::get('/division-zoning', 'ReportingController@DivisionZoning');
//      Route::get('/district-zoning', 'ReportingController@DistrictZoning');
//      Route::get('/upazilla-zoning', 'ReportingController@UpazillaZoning');

//      Route::get('/division-zoning/json/{areacode?}', 'ReportingController@DivisionZoningJson');
//      Route::get('/district-zoning/json/{areacode?}', 'ReportingController@DistrictZoningJson');
//      Route::get('/upazilla-zoning/json/{areacode?}', 'ReportingController@UpazillaZoningJson');


// });
// // end added by ADS

 Route::group(['middleware' => ['auth','checkPermission']], function(){
//    Route::get('/test/abc', 'PermissionController@test');

});

Route::fallback(function () {
    return redirect('/dashboard')->with(['message' => 'Page does not exist !!!', 'alert-type' => 'error']);
});
