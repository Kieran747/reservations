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

    return view('home');

});

Route::get('bookings/create', function () {

    return view('bookings.create');

});

Route::get('bookings/list', function () {

    return view('bookings.list');

})->name('list');

Route::get('/bookings', function () {


    return view('bookings');

});

Route::get('/delete-post/{id}', [
    'uses' => 'BookingController@getDeleteBooking',
    'as' => 'booking.delete',
    'middleware' => 'auth'
]);

Route::get('/add', function () {
    return view('add');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::post('/booking', 'BookingController@store');
Route::post('/checked_in/{link}', 'BookingController@update');
Route::post('checkout/{id}', 'BookingController@checkout');
Route::post('update/{id}', 'BookingController@update');


Route::post('/amenities', 'amenitiesController@store');

Route::get('/bookings/checkout/{id}', function ($id) {

    $booking = DB::table('bookings')->find($id);
    $amenities = DB::table('amenities')->where('link', '=', $id)->first();

    return view('bookings.checkout', compact('booking','amenities'));
});

Route::get('/bookings/list', function () {

    $bookings = DB::table('bookings')->get()->where('checked_in', '=', '0');

    return view('bookings.list', compact('bookings'));
});

Route::get('/bookings/checked-in', function () {

    $bookings = DB::table('bookings')->where('checked_in', '=', '1')
        ->where('checked_out', '=', '0')->get();

    return view('bookings.checked-in', compact('bookings'));
});



Route::get('/bookings/today/checkins', function () {

    $bookingsToday = DB::table('bookings')->where('check_in', Date('Y-m-d'))
        ->where('checked_in','=','0')->get();

    return view('bookings.today.checkins', compact('bookingsToday'));
});

Route::get('/bookings/today/checkouts', function () {

    $bookingsToday = DB::table('bookings')->where('check_out', Date('Y-m-d'))->where('checked_out', '=', '0')->get();

    return view('bookings.today.checkouts', compact('bookingsToday'));
});

Route::get('/bookings/checkin/{id}', function ($id) {

    $booking = DB::table('bookings')->find($id);

    return view('bookings.checkin', compact('booking'));
});

Route::get('/bookings/{id}', function ($id) {

    $booking = DB::table('bookings')->find($id);

    return view('bookings', compact('booking'));
});

Route::get('/bookings/edit/{id}', function ($id) {

    $booking = DB::table('bookings')->find($id);

    return view('bookings.edit', compact('booking'));
});


