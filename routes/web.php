<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['\App\Http\Middleware\AdminMiddleware']],function (){
    Route::get('addWorker', 'AdminController@addWorker')->name('addWorker');
    Route::post('addWorker', 'AdminController@saveWorker');
    Route::get('employees', 'AdminController@allEmployees')->name('employees');
});


Route::group(['middleware' => ['\App\Http\Middleware\AdminEmployeeMiddleware']], function() {
    Route::get('/admin', 'AdminController@index')->name('adminHome');
    Route::get('/items', 'AdminController@items')->name('items');
    Route::get('/newItem', 'AdminController@newItem')->name('newItem');
    Route::post('newItem', 'AdminController@saveItem');
    Route::get('addMembershipType', 'AdminController@addMembershipType')->name('addMembershipType');
    Route::post('addMembershipType', 'AdminController@saveMembershipType');
    Route::get('addMember', 'AdminController@addMember')->name('addMember');
    Route::post('addMember', 'AdminController@saveMember');
    Route::get('members', 'AdminController@allMembers')->name('members');
    Route::get('updateMember/{id}', 'AdminController@showUpdateMemberForm')->name('updateMember');
    Route::post('updateMember/{id}', 'AdminController@updateMember');
    Route::get('deleteMember/{id}', 'AdminController@deleteMember')->name('deleteMember');
    Route::get('addMembership/{id}', 'AdminController@addMembership')->name('addMembership');
    Route::post('addMembership/{id}', 'AdminController@saveMembership');
    Route::get('items', 'AdminController@allItems')->name('items');
    Route::get('editItem/{id}', 'AdminController@showUpdateItemForm')->name('editItem');
    Route::post('editItem/{id}', 'AdminController@updateItem');
    Route::get('delete/{id}', 'AdminController@deleteItem')->name('deleteItem');
    Route::get('attendance', 'AdminController@showAttendance')->name('attendance');
    Route::post('attendance', 'AdminController@addAttendance');
    Route::get('activeMemberships', 'AdminController@activeMemberships')->name('activeMemberships');
    Route::get('membershipTypes', 'AdminController@membershipTypes')->name('membershipTypes');
    Route::get('editMembershipType/{id}', 'AdminController@editMembershipType')->name('editMembershipType');
    Route::post('editMembershipType/{id}', 'AdminController@saveEditMembershipType');
    Route::get('editEmployee/{id}', 'AdminController@editEmployee')->name('editEmployee');
    Route::post('editEmployee/{id}', 'AdminController@saveEditEmployee');
    Route::get('deleteEmployee/{id}', 'AdminController@deleteEmployee')->name('deleteEmployee');
    Route::get('addCategory', 'AdminController@addCategory')->name('addCategory');
    Route::post('addCategory', 'AdminController@saveCategory');
    Route::get('categories','AdminController@allCategories')->name('categories');
    Route::get('addSubcategory/{id}','AdminController@addSubcategory')->name('addSubcategory');
    Route::post('addSubcategory/{id}', 'AdminController@saveSubcategory');

});
Route::group(['middleware' => ['\App\Http\Middleware\CustomerMiddleware']],function (){
    Route::post('orderItem','CustomerController@orderItemP')->name('orderItemP');
    Route::get('orderItem/{id}','CustomerController@orderItemG')->name('orderItemG');
    Route::get('order','CustomerController@currentOrder')->name('currentOrder');
    Route::get('pay/{id}', 'PaymentController@payWithpaypal')->name('pay');
    Route::get('status', 'PaymentController@getPaymentStatus');
    Route::get('paymentStatus','PaymentController@paymentStatus')->name('paymentStatus');
    Route::get('chooseAddress','CustomerController@displayAddresses')->name('chooseAddress');
    Route::post('checkout','CustomerController@checkout')->name('checkout');
    Route::get('profile','CustomerController@profileDetails')->name('profile');
    Route::post('profile','CustomerController@updateProfile');
    Route::post('profile','CustomerController@changePassword')->name('changePassword');
    Route::get('completedOrders','CustomerController@completedOrders')->name('completedOrders');
});
Route::get('shop','CustomerController@showItemsInShop')->name('shop');
Route::get('itemDetails/{id}','CustomerController@itemDetails')->name('itemDetails');
