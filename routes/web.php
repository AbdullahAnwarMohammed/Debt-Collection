<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
// Auth::routes(['register'=>false]);

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::resource('invoices',InvoicesController::class);
Route::resource('sections',SectionsController::class);
Route::resource('products',ProductsController::class);

Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);

Route::get('section/{id}',[InvoicesDetailsController::class,'getproducts']);
Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class,'edit']);


Route::get('Attachments/{id}/{filename}',[InvoicesController::class,'open_file'])->name('openFile');
Route::get('download/{id}/{filename}',[InvoicesController::class,'download'])->name('download');
Route::post('delete',[InvoicesController::class,'delete'])->name('delete');

Route::get('/export_invoices', [InvoicesController::class, 'export']);

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles',RoleController::class);
    
    Route::resource('users',UserController::class);
    
});

Route::get('invoices_report',[InvoiceReportController::class,'index']);
Route::post('invoices_search',[InvoiceReportController::class,'search']);

Route::get('customerReport',[CustomerReportController::class,'index']);
Route::post('customerReportPost',[CustomerReportController::class,'search']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/edit_invoice/{id}', [InvoicesController::class,'edit']);
Route::get('/Status_show/{id}',  [InvoicesController::class,'show'])->name('Status_show');
Route::post('/Status_Update/{id}',  [InvoicesController::class,'Status_Update'])->name('Status_Update');
Route::get('/Print_invoice/{id}',  [InvoicesController::class,'Print_invoice'])->name('Print_invoice');

Route::get('/ReadAll',[InvoicesController::class,'all']);

Route::get('/{page}', [AdminController::class,'index'])->middleware('auth');


//{{ url('Attachments') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}