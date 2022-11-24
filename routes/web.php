<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\BuyersController;
use App\Http\Controllers\IncomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});
*/
//Route::get('/', [AuthController::class, 'index'])->name('welcome');
Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
//Route::get('/register-admin', [AuthController::class, 'register_admin'])->name('register-admin');
Route::post('/post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
//Route::get('registration', [AuthController::class, 'registration'])->name('register');
//Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); 
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
/*
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);
  */

//Route::get('/home', [HomeController::class, 'index'])->name('home');
//Supplier
Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers');
Route::post('/suppliers-c', [SuppliersController::class, 'create'])->name('suppliers-c');
Route::get('/suppliers-list', [SuppliersController::class, 'show'])->name('suppliers-list');
Route::get('/suppliers-e/{id?}', [SuppliersController::class, 'edit'])->name('suppliers-e');
Route::post('/suppliers-u', [SuppliersController::class, 'update'])->name('suppliers-u');
Route::post('/suppliers-d', [SuppliersController::class, 'destroy'])->name('suppliers-d');
//Expense
Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');
Route::post('/expense-c', [ExpenseController::class, 'create'])->name('expense-c');
Route::get('/expense-list', [ExpenseController::class, 'show'])->name('expense-list');
Route::get('/expense-e/{id?}', [ExpenseController::class, 'edit'])->name('expense-e');
Route::post('/expense-u', [ExpenseController::class, 'update'])->name('expense-u');
Route::post('/expense-d', [ExpenseController::class, 'destroy'])->name('expense-d');
//Buyers
Route::get('/buyers', [BuyersController::class, 'index'])->name('buyers');
Route::post('/buyers-c', [BuyersController::class, 'create'])->name('buyers-c');
Route::get('/buyers-list', [BuyersController::class, 'show'])->name('buyers-list');
Route::get('/buyers-e/{id?}', [BuyersController::class, 'edit'])->name('buyers-e');
Route::post('/buyers-u', [BuyersController::class, 'update'])->name('buyers-u');
Route::post('/buyers-d', [BuyersController::class, 'destroy'])->name('buyers-d');
//Income
Route::get('/income', [IncomeController::class, 'index'])->name('income');
Route::post('/income-c', [IncomeController::class, 'create'])->name('income-c');
Route::get('/income-list', [IncomeController::class, 'show'])->name('income-list');
Route::get('/income-e/{id?}', [IncomeController::class, 'edit'])->name('income-e');
Route::post('/income-u', [IncomeController::class, 'update'])->name('income-u');
Route::post('/income-d', [IncomeController::class, 'destroy'])->name('income-d');



// Clear application cache:
Route::get('/clear-cache', function() {
  Artisan::call('cache:clear');
  return 'Application cache has been cleared';
});

//Clear route cache:
Route::get('/route-cache', function() {
Artisan::call('route:cache');
  return 'Routes cache has been cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
 Artisan::call('config:cache');
 return 'Config cache has been cleared';
}); 

// Clear view cache:
Route::get('/view-clear', function() {
  Artisan::call('view:clear');
  return 'View cache has been cleared';
});