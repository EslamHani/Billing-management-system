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
Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->namespace('BackEnd')->group(function() {

	//*** Users Routes ***//
	Route::resource('users', 'UserController')->except('show');
	Route::delete('deleteall/users', 'UserController@deleteAll')->name('users.deleteall');


	//*** Roles Routes ***//
	Route::resource('roles', 'RoleController');
	Route::delete('deleteall/roles', 'RoleController@deleteAll')->name('roles.deleteall');

	//*** Trademarks Routes ***//
	Route::resource('trademarks', 'TrademarkController')->except('show');
	Route::delete('deleteall/trademarks', 'TrademarkController@deleteAll')->name('trademarks.deleteall');

	//**** Department Routes ****//
	Route::resource('departments', 'DepartmentController')->except('show');
	Route::delete('deleteall/departments', 'DepartmentController@deleteAll')->name('departments.deleteall');

	//**** Product Routes ****//
	Route::resource('products', 'ProductController');
	Route::delete('deleteall/products', 'ProductController@deleteAll')->name('products.deleteall');

	//**** color Routes ****//
	Route::resource('colors', 'ColorController')->except('show');
	Route::delete('deleteall/colors', 'ColorController@deleteAll')->name('colors.deleteall');

	//**** Order Routes ****//
	Route::resource('orders', 'OrderController')->except('show');
	Route::delete('deleteall/orders', 'OrderController@deleteAll')->name('orders.deleteall');
	Route::post('get-shipping-by-governorate','OrderController@getShipping');

	//**** Governorate Routes ****//
	Route::resource('governorates', 'GovernorateController')->except('show');
	Route::delete('deleteall/governorates', 'GovernorateController@deleteAll')->name('governorates.deleteall');

	
	//**** Governorate Routes ****//
	Route::resource('invoices', 'InvoiceController')->except('show', 'create', 'store');
	Route::delete('deleteall/invoices', 'InvoiceController@deleteAll')->name('invoices.deleteall');
	Route::get('archive/invoices', 'InvoiceController@trash')->name('invoices.trash'); // Get All archive records
	Route::get('paid/invoices', 'InvoiceController@paidInvoices')->name('invoices.paid');
	Route::get('unpaid/invoices', 'InvoiceController@unpaidInvoices')->name('invoices.unpaid');
	Route::get('restore/invoices/{id}', 'InvoiceController@restore')->name('invoices.restore');
	Route::get('print/invoices/{id}', 'InvoiceController@printInvoive')->name('invoices.print');
	Route::delete('archiveinvoices/{id}', 'InvoiceController@archive')->name('invoices.archive');
	Route::delete('archiveall/invoices', 'InvoiceController@archiveAll')->name('invoices.archiveall');
	Route::get('/export-excel/invoice', 'InvoiceController@exportIntoExcel')->name('invoices.excel');

});	

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');
