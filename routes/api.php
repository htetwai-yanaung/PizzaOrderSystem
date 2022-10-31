<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// GET
Route::get('product/list', [RouteController::class, 'productList']);
Route::get('category/list', [RouteController::class, 'categoryList']);
Route::get('user/list', [RouteController::class, 'userList']);

// Create
Route::post('category/create', [RouteController::class, 'categoryCreate']);
Route::post('create/contact', [RouteController::class, 'createContact']);

// DELETE CATEGORY
// Route::post('category/delete', [RouteController::class, 'deleteCategory']);
Route::get('category/delete/{id}', [RouteController::class, 'deleteCategory']);

// Read
Route::get('category/list/{id}', [RouteController::class, 'categoryDetails']);

// Update
Route::post('category/update', [RouteController::class, 'categoryUpdate']);


/**
 *
 * product list
 * localhost:8000/api/product/list (GET)
 *
 * category list
 * localhost:8000/api/category/list (GET)
 *
 * create category
 * localhost:8000/api/category/create (POST)
 * body{
 *      name : ''
 * }
 *
 * delete category
 * localhost:8000/api/category/delete/{id} (GET)
 *
 * category detail
 * localhost:8000/api/category/list/{id} (GET)
 *
 * update category
 * localhost:8000/api/category/update (POST)
 * key => category_name, category_id
 */
