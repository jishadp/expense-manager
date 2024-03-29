<?php

use App\Http\Controllers\DashboardController;
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

Route::get('/','DashboardController@home')->name('dashboard');

Route::name('liabilities.')->group(function () {
    Route::get('liabilities','LiabilityController@list')->name('list');
    Route::get('delete-liability/{id}','LiabilityController@delete')->name('delete');
    Route::post('save-loan','LiabilityController@save')->name('save');

    Route::get('liabilities/{liabilityId}/payments','PaymentController@list')->name('payments.list');
    Route::get('delete-payment/{id}','PaymentController@delete')->name('payments.delete');
    Route::post('save-payment','PaymentController@save')->name('payments.save');

    Route::get('liabilities/{liabilityId}/interests','InterestController@list')->name('interests.list');
    Route::get('delete-interest/{id}','InterestController@delete')->name('interest.delete');
    Route::post('save-interest','InterestController@save')->name('interest.save');

});



Route::get('incomes','IncomeController@list')->name('incomes.list');
Route::get('delete-income/{id}','IncomeController@delete')->name('income.delete');
Route::post('save-income','IncomeController@save')->name('income.save');

Route::get('expenses','ExpenseController@list')->name('expenses.list');
Route::get('delete-expense/{id}','ExpenseController@delete')->name('expense.delete');
Route::get('change-expense-status/{id}','ExpenseController@changeExpenseStatus')->name('expense.change.status');
Route::post('save-expense','ExpenseController@save')->name('expense.save');
Route::get('move-expense/{id}','ExpenseController@move')->name('expense.move');

Route::get('pnl','PNLController@view')->name('pnl.view');

