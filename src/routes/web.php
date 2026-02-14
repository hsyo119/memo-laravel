<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ログイン画面（トップページ）
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.index');

// 登録画面
Route::get('/user', [RegisterController::class, 'showRegistrationForm'])->name('user.register');

// 登録処理（自作）
Route::post('/user/register', [RegisterController::class, 'register'])->name('user.exec.register');


// メモ画面
Route::group(['middleware' => ['auth']], function() {
    Route::get('/memo', [MemoController::class, 'index'])->name('memo.index');
    Route::get('/memo/add', [MemoController::class, 'add'])->name('memo.add');
    Route::get('/memo/select', [MemoController::class, 'select'])->name('memo.select');
    Route::post('/memo/update', [MemoController::class, 'update'])->name('memo.update');
    Route::post('/memo/delete', [MemoController::class, 'delete'])->name('memo.delete');
});

// 認証関連（標準のログイン・登録・パスワードリセット）
Auth::routes();