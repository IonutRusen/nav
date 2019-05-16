<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/clear', function() {

    //  Artisan::call('migrate');
    Artisan::call('migrate');
    // return what you want

    return 'success';
});


Route::get('/ToateOfertele/',[
    'uses' => 'Ads\ToateOfertele@index',
    'as' => 'ToateOfertele'
]);

Route::middleware(['web','auth'])->group(function () {
    Route::get('adaugaAnunt/{folder}','Ads\AnuntController@index');
    Route::get('editeazaAnunt/{id}','Ads\AnuntController@editAdd');
    Route::get('deleteAd/{id}','Ads\AnuntController@deleteAd');



    Route::post('/saveAd/',[
        'uses' => 'Ads\AnuntController@SaveEditAd',
        'as' => 'saveAd'
    ]);



    Route::post('/getTonajType/',[
        'uses' => 'Ads\AnuntController@tonajType',
        'as' => 'saveAd'
    ]);

    Route::post('/search/',[
        'uses' => 'Search\SearchController@search',
        'as' => 'search'
    ]);

  Route::get('/search/',[
        'uses' => 'Search\SearchController@search',
        'as' => 'search'
    ]);






    Route::post('/saveImage/{id}/','Ads\AnuntController@store');
    Route::post('/deleteImage/{id}','Ads\AnuntController@delete');
    Route::post('/getContactDetails/','Ads\AnuntController@getContactDetails');

});