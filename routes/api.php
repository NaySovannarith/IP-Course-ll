<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'getCategories']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CategoryController::class)->prefix('categories')->group(function() {
    Route::get('/', 'getCategories'); // GET /categories
    Route::post('/', 'createCategory'); // POST /categories
    Route::get('{categoryId}', 'getCategory');
    Route::patch('{categoryId}', 'updateCategory');
    Route::delete('{categoryId}', 'deleteCategory'); // DELETE /categories/{categoryId}

});

Route::controller(ProductController::class)->prefix('products')->group(function() {
    Route::get('/', 'getProducts'); // GET /products
    Route::post('/', 'createProduct'); // POST /products
    Route::get('{productId}', 'getProduct'); // GET /products/{productId}
    Route::patch('{productId}', 'updateProduct'); // PATCH /products/{productId}
    Route::delete('{productId}', 'deleteProduct'); // DELETE /products/{productId}
});