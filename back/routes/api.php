<?php

use App\Http\Controllers\Inventory\Customers\ContactController;
use App\Http\Controllers\Inventory\Customers\VendorController;
use App\Http\Controllers\Inventory\Items\ItemController;
use App\Http\Controllers\Inventory\Items\TaxController;
use App\Http\Controllers\Inventory\Orders\PurchaseOrderController;
use App\Http\Controllers\Inventory\Orders\SalesOrderController;
use Illuminate\Support\Facades\Route;


//orders
Route::post('/sales_orders', [SalesOrderController::class,'store']);
Route::post('/purchase_orders', [PurchaseOrderController::class,'store']);

//customers
Route::post('/customers',[ContactController::class,'store']);
Route::get('/customers',[ContactController::class,'index']);
Route::get('/vendors' ,[VendorController::class,'index']);

//items
Route::post('/taxes' ,[TaxController::class,'store']);
Route::get('/taxes' ,[TaxController::class,'index']);
Route::get('/items', [ItemController::class,'index']);
