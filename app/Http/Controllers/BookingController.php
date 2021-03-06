<?php

namespace App\Http\Controllers;
use App\Booking;

class BookingController extends Controller


{


    public function index()
    {
        return view('bookings');
    }

    public function store()
    {
        $booking = new \App\Booking;

        $booking->name = request('name');
        $booking->type = request('type');
        $booking->check_in = request('check_in');
        $booking->check_out = request('check_out');
        $booking->number_of_people = request('number_of_people');
        $booking->email = request('email');
        $booking->phone_number = request('phone_number');
        $booking->checked_in = request('checked_in');
        $booking->checked_out = request('checked_out');
        $booking->bill = 0;

        $booking->save();

        return redirect('/home');
    }
    public function getDeleteBooking($id)
    {

        $booking = Booking::where('id', $id)->first();
        $booking->delete();
        return redirect('/bookings/list')->with(['message' => 'deleted!']);
    }

    public function update($id)
    {
        $booking = Booking::where('id', $id)->first();
        $booking->name = request('name');
        $booking->type = request('type');
        $booking->check_in = request('check_in');
        $booking->check_out = request('check_out');
        $booking->number_of_people = request('number_of_people');
        $booking->email = request('email');
        $booking->phone_number = request('phone_number');
        $booking->checked_in = request('checked_in');
        $booking->checked_out = request('checked_out');
        $booking->bill = request('bill');


        $booking->bill = request('bill');

        $booking->save();

        return redirect('/bookings/list');
    }
    public function checkout($id)
    {
        $booking = Booking::where('id', $id)->first();

        $booking->checked_out = 1;
        $booking->bill = request('bill');

        $booking->save();

        return redirect('/home');
    }

}
