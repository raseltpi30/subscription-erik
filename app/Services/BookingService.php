<?php

namespace App\Services;

use App\Models\Booking;
use App\Mail\BookingCreated; // Import the Mailable
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail; // Import the Mail facade

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\StripeClient;

class BookingService
{
    public function createWeeklyAndMonthlyBookings()
    {
        $today = Carbon::now()->startOfDay();
        Log::info('Creating weekly and monthly bookings for date: ' . $today);

        // Handle weekly bookings
        $this->createWeeklyBookings($today);

        // Handle monthly bookings
        $this->createMonthlyBookings($today);
    }

    private function createWeeklyBookings($today)
    {
        Log::info('Creating weekly bookings.');

        $bookings = Booking::where('frequency', 'Weekly')
            ->where('status', 'processing')
            ->get();

        foreach ($bookings as $booking) {
            Log::info('Processing booking: ', $booking->toArray());

            if (Carbon::parse($booking->day) < $today) {
                $newDate = Carbon::parse($booking->day)->addWeek()->format('Y-m-d');

                if (!Booking::where('day', $newDate)->exists()) {
                    $newBooking = Booking::create([
                        'firstName' => $booking->firstName,
                        'lastName' => $booking->lastName,
                        'email' => $booking->email,
                        'phone' => $booking->phone,
                        'street' => $booking->street,
                        'apt' => $booking->apt,
                        'city' => $booking->city,
                        'postal_code' => $booking->postal_code,
                        'service' => $booking->service,
                        'bathroom' => $booking->bathroom,
                        'typeOfService' => $booking->typeOfService,
                        'storey' => $booking->storey,
                        'frequency' => 'Weekly',
                        'day' => $newDate,
                        'time' => $booking->time,
                        'extras' => $booking->extras,
                        'discountPercentage' => $booking->discountPercentage,
                        'discountAmount' => $booking->discountAmount,
                        'couponDiscountAmount' => $booking->couponDiscountAmount,
                        'stripe_checkout_session_id' => $booking->stripe_checkout_session_id,
                        'totalExtras' => $booking->totalExtras,
                        'finalTotal' => $booking->finalTotal,
                        'status' => 'processing',
                    ]);

                    Log::info('New weekly booking created for date: ' . $newDate);
                    $booking->update(['status' => 'completed']);

                    // for stripe payment
                    Stripe::setApiKey('sk_test_51PylzqRq0gWoIKN4nEaYiVjis3ymX3apocMqP5s35ciPkBDv1uj1i83qR9S5uBqwz1KWiUVf1oQ1weDYiGxrsGs900E4qxL8h3');

                    // // Create a Stripe charge
                    $charge = Charge::create([
                        'amount' => $booking->finalTotal * 100, // Convert to cents
                        'currency' => 'aud',
                        'source' => $booking->stripe_checkout_session_id,
                        'description' => 'Payment for service',
                        'metadata' => [
                            'First Name' => $booking->firstName,
                            'Last Name' => $booking->lastName,
                            'Email' => $booking->email,
                            'phone' => $booking->phone,
                            'Street' => $booking->street,
                            'Apt' => $booking->apt,
                            'City' => $booking->city,
                            'Postal Code' => $booking->postal_code,
                            'Service' => $booking->service,
                            'Bathroom' => $booking->bathroom,
                            'Type Of Service' => $booking->typeOfService,
                            'Storey' => $booking->storey,
                            'Frequency' => 'Weekly',
                            'Day' => $booking->day,
                            'Time' => $booking->time,
                            'Discount Percentage' => $booking->discountPercentage . '%' ?? null,
                            'Discount Amount' => '$' . $booking->discountAmount ?? null,
                            'Total Extras' => '$' . $booking->totalExtras ?? null,
                            'FinalTotal' => '$' . $booking->finalTotal
                        ]
                    ]);

                    // Send the booking confirmation email
                    Mail::to($newBooking->email)->send(new BookingCreated($newBooking));
                } else {
                    Log::info('Booking already exists for date: ' . $newDate);
                }
            }
        }
    }

    private function createMonthlyBookings($today)
    {
        Log::info('Creating monthly bookings.');

        $bookings = Booking::where('frequency', 'Monthly')
            ->where('status', 'processing')
            ->get();

        foreach ($bookings as $booking) {
            Log::info('Processing booking: ', $booking->toArray());

            if (Carbon::parse($booking->day) < $today) {
                $newDate = Carbon::parse($booking->day)->addMonth()->format('Y-m-d');

                if (!Booking::where('day', $newDate)->exists()) {
                    $newBooking = Booking::create([
                        'firstName' => $booking->firstName,
                        'lastName' => $booking->lastName,
                        'email' => $booking->email,
                        'phone' => $booking->phone,
                        'street' => $booking->street,
                        'apt' => $booking->apt,
                        'city' => $booking->city,
                        'postal_code' => $booking->postal_code,
                        'service' => $booking->service,
                        'bathroom' => $booking->bathroom,
                        'typeOfService' => $booking->typeOfService,
                        'storey' => $booking->storey,
                        'frequency' => 'Monthly',
                        'day' => $newDate,
                        'time' => $booking->time,
                        'extras' => $booking->extras,
                        'discountPercentage' => $booking->discountPercentage,
                        'discountAmount' => $booking->discountAmount,
                        'couponDiscountAmount' => $booking->couponDiscountAmount,
                        'totalExtras' => $booking->totalExtras,
                        'finalTotal' => $booking->finalTotal,
                        'status' => 'processing',
                    ]);

                    Log::info('New monthly booking created for date: ' . $newDate);
                    $booking->update(['status' => 'completed']);

                    // Send the booking confirmation email
                    Mail::to($newBooking->email)->send(new BookingCreated($newBooking));
                } else {
                    Log::info('Booking already exists for date: ' . $newDate);
                }
            }
        }
    }
}
