<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('articles')->group(function () {
    Route::get('/', App\Http\Controllers\Articles\ListArticleHandler::class)->name('article.list');
    Route::middleware(['auth'])->group(function () {
        Route::get('/create', App\Http\Controllers\Articles\CreateArticleHandler::class)->name('article.create');
        Route::get('/{article}/edit', App\Http\Controllers\Articles\EditArticleHandler::class)->name('article.edit');
        Route::put('/{article}', App\Http\Controllers\Articles\UpdateArticleHandler::class)->name('article.update');
        Route::delete('/{article}', App\Http\Controllers\Articles\DeleteArticleHandler::class)->name('article.delete');
        Route::post('/', App\Http\Controllers\Articles\StoreArticleHandler::class)->name('article.store');
    });
    Route::get('/{article}', App\Http\Controllers\Articles\ShowArticleHandler::class)->name('article.detail');
});

Route::prefix('categories')->group(function () {
    Route::get('/', App\Http\Controllers\Categories\ListCategoryHandler::class)->name('category.list');
    Route::middleware(['auth'])->group(function () {
        Route::get('/create', App\Http\Controllers\Categories\CreateCategoryHandler::class)->name('category.create');
        Route::post('/', App\Http\Controllers\Categories\StoreCategoryHandler::class)->name('category.store');
        Route::get('/{category}/edit', App\Http\Controllers\Categories\EditCategoryHandler::class)->name('category.edit');
        Route::put('/{category}', App\Http\Controllers\Categories\UpdateCategoryHandler::class)->name('category.update');
        Route::delete('/{category}', App\Http\Controllers\Categories\DeleteCategoryHandler::class)->name('category.delete');
    });
});

Route::prefix('tags')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', App\Http\Controllers\Tags\ListTagHandler::class)->name('tag.list');
        Route::get('/create', App\Http\Controllers\Tags\CreateTagHandler::class)->name('tag.create');
        Route::post('/', App\Http\Controllers\Tags\StoreTagHandler::class)->name('tag.store');
        Route::get('/{tag}/edit', App\Http\Controllers\Tags\EditTagHandler::class)->name('tag.edit');
        Route::put('/{tag}', App\Http\Controllers\Tags\UpdateTagHandler::class)->name('tag.update');
        Route::delete('/{tag}', App\Http\Controllers\Tags\DeleteTagHandler::class)->name('tag.delete');
    });
});

Route::get('/about-me', App\Http\Controllers\AboutMe\ShowAboutMeHandler::class)->name('about-me');

Auth::routes();
