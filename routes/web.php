<?php

use App\Brewerie;
use App\Http\Controllers\BreweriesController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//FrontController
Route::get('/', 'FrontController@index')->name('index');
Route::get('/search', 'FrontController@search')->name('search');
Route::get('/breweries', 'FrontController@breweries')->name('breweries');
Route::get('/about', 'FrontController@aboutUs')->name('about');
Route::get('/team', 'FrontController@team')->name('team');

//ContactController
Route::post('/contacts/submit', 'ContactController@submit')->name('contacts.submit');
Route::get('/contacts/thankyou', 'ContactController@thankyou')->name('contacts.thankyou');

// BreweriesController
Route::post('/breweries/notify', 'BreweryController@notify')->name('breweries.notify');
Route::get('/breweries/thankyou', 'BreweryController@thankyou')->name('breweries.thankyou');
Route::post('/breweries/{id}/approved', 'BreweryController@approved')->name('breweries.approved');
Route::post('/breweries/{id}/comments', 'BreweryController@addComment')->name('breweries.comments.add');

Route::post('/breweries/{id}/beers/sync', 'BreweryController@beersSync')->name('breweries.beers.sync');

Route::get('/breweries/{id}/show', 'BreweryController@show')->name('breweries.show');
Route::put('/breweries/{id}/update', 'BreweryController@update')->name('breweries.update');
Route::delete('/breweries/{id}/delete', 'BreweryController@delete')->name('breweries.delete');

