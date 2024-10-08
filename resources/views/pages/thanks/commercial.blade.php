@extends('layouts.app')
@section('title')
    Thanks Thanks You
@endsection
<style>
    .thank-you-header {
        font-size: 38px !important;
        /* Ensure font size is applied */
    }
</style>

@section('main_content')
    <div id="yui_3_17_2_1_1721300520335_422">
        <div class="thank-you-container" style="color: black !important;">
            <h1 class="thank-you-header" style="color: black !important;">Thank you for your quote request!
            </h1>
            <div class="thank-you-line" style="color: black !important;"></div>
            <div class="thank-you-content" style="color: black !important;">
                <p style="color: black !important;">We appreciate your interest in our services. Our
                    team will review your request and get back to you shortly with a detailed quote. We aim to respond
                    promptly to address your needs and discuss any additional details. Thank you for choosing us!</p>
            </div>
        </div>
    </div>
@endsection
