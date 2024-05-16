<?php

use App\Http\Controllers\Inventory\Contacts\ContactController;
use App\Http\Controllers\Inventory\Items\ItemController;
use App\Http\Controllers\Inventory\Items\TaxController;
use App\Http\Controllers\Inventory\Orders\PurchaseOrderController;
use App\Http\Controllers\Inventory\Orders\SalesOrderController;
use Illuminate\Support\Facades\Route;


//orders
Route::post('/sales_orders', [SalesOrderController::class,'store']);
Route::post('/purchase_orders', [PurchaseOrderController::class,'store']);

//contacts
Route::post('/contacts',[ContactController::class,'store']);
Route::get('/contacts',[ContactController::class,'index']);

//items
Route::post('/taxes' ,[TaxController::class,'store']);
Route::get('/taxes' ,[TaxController::class,'index']);
Route::get('/items', [ItemController::class,'index']);
