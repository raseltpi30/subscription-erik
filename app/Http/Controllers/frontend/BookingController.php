<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentDetailsMail;
use Illuminate\Support\Carbon;
use Stripe\Product;
use Stripe\Price;
use Stripe\Customer;
use Stripe\Subscription;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $today = Carbon::today()->format('Y-m-d');

        // Check if there's an existing booking for today with the same email and coupon discount code
        $existingBookingWithCoupon = DB::table('bookings')
            ->where('email', $request->email)
            ->where('couponDiscountCode', $request->couponDiscountCode)
            ->first();

        // Check if there's any existing booking for today with the same email (regardless of coupon)
        $existingBookingWithEmail = DB::table('bookings')
            ->where('email', $request->email)
            ->where('day', $request->day)
            ->first();

        if ($existingBookingWithCoupon) {
            return response()->json(['message' => 'You already have this discount code. Please remove the coupon and submit.'], 400);
        } elseif ($existingBookingWithEmail) {
            return response()->json(['message' => 'You already have a booking for this date. Please select a different date to proceed.'], 400);
        } else {
            // Validate the request data
            $request->validate([
                'email' => 'required|email',
                'paymentMethodId' => 'required|string',
            ]);

            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Stripe::setApiKey('sk_test_51PylzqRq0gWoIKN4nEaYiVjis3ymX3apocMqP5s35ciPkBDv1uj1i83qR9S5uBqwz1KWiUVf1oQ1weDYiGxrsGs900E4qxL8h3'); // Set your Stripe secret key

            try {
                // Create a product dynamically
                $product = Product::create([
                    'name' => $request->firstName,
                ]);

                // Create a price for the product
                $price = Price::create([
                    'unit_amount' => $request->finalTotal * 100,
                    'currency' => 'aud',
                    'recurring' => ['interval' => 'week'],
                    'product' => $product->id,
                ]);

                // Create a customer with the provided email
                $customer = Customer::create([
                    'payment_method' => $request->paymentMethodId,
                    'email' => $request->email,
                    'name' => $request->firstName . ' ' . $request->lastName, // Add a space between first and last names
                ]);

                // Create a subscription with the created price
                $subscription = Subscription::create([
                    'customer' => $customer->id,
                    'items' => [[
                        'price' => $price->id,
                    ]],
                    'default_payment_method' => $request->paymentMethodId,
                ]);

                return response()->json(['success' => true, 'subscription' => $subscription]);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
}
