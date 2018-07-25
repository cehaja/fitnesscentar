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
Route::group(['middleware' => '\App\Http\Middleware\AdminMiddleware'], function() {
    Route::get('/admin', 'AdminController@index')->name('adminHome');
    Route::get('/items', 'AdminController@items')->name('items');
    Route::get('/newItem', 'AdminController@newItem')->name('newItem');
    Route::post('newItem', 'AdminController@saveItem');
    Route::get('addWorker', 'AdminController@addWorker')->name('addWorker');
    Route::post('addWorker', 'AdminController@saveWorker');
    Route::get('addMembershipType', 'AdminController@addMembershipType')->name('addMembershipType');
    Route::post('addMembershipType', 'AdminController@saveMembershipType');
    Route::get('addMember', 'AdminController@addMember')->name('addMember');
    Route::post('addMember', 'AdminController@saveMember');
    Route::get('members', 'AdminController@allMembers')->name('allMembers');
    Route::get('updateMember/{id}', 'AdminController@showUpdateMemberForm')->name('updateMember');
    Route::post('updateMember/{id}', 'AdminController@updateMember');
    Route::get('deleteMember/{id}', 'AdminController@deleteMember')->name('deleteMember');
    Route::get('addMembership/{id}', 'AdminController@addMembership')->name('addMembership');
    Route::post('addMembership/{id}', 'AdminController@saveMembership');
    Route::get('items', 'AdminController@allItems')->name('allItems');
    Route::get('editItem/{id}', 'AdminController@showUpdateItemForm')->name('editItem');
    Route::post('editItem/{id}', 'AdminController@updateItem');
    Route::get('delete/{id}', 'AdminController@deleteItem')->name('deleteItem');
    Route::get('attendance', 'AdminController@showAttendance')->name('attendance');
    Route::post('attendance', 'AdminController@addAttendance');
});
Route::get('shop','CustomerController@showItemsInShop')->name('shop');
Route::get('orderItem/{id}','CustomerController@orderItem')->name('orderItem');
