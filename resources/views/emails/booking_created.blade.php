<!DOCTYPE html>
<html>

<head>
    <title>
        <!DOCTYPE html>
        <html>

        <head>
            <title>Upcoming Booking Reminder</title>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap');

                body {
                    font-family: 'Manrope', Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f7f7f7;
                    color: #000000;
                    /* Set all text to black */
                }

                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    padding: 20px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    border-radius: 0;
                    /* Ensuring square edges */
                }

                .header {
                    background-color: rgb(242, 240, 233);
                    /* Same Brown color as the button */
                    color: #000000;
                    /* Black text */
                    padding: 20px 0;
                    text-align: center;
                }

                .header h1 {
                    margin: 0;
                    font-size: 24px;
                    /* Adjusted font size to match */
                    font-weight: 700;
                    /* Make it bold */
                }

                .header p {
                    margin: 0;
                    font-size: 18px;
                    /* Adjust font size to match */
                    font-weight: 500;
                    /* Slightly less bold */
                }

                .content {
                    padding: 20px;
                }

                .footer {
                    text-align: center;
                    padding: 10px 0;
                    font-size: 12px;
                    color: #666666;
                }

                .additional-services {
                    list-style-type: disc;
                    /* Bullet points */
                    padding-left: 20px;
                    /* Indent for bullet points */
                }
            </style>

        </head>

<body>
    <div class="container">
        <div class="header">
            <h1>Crystal Clean Sydney</h1>
            <p>Upcoming Booking Reminder</p>
        </div>
        <div class="content">
            <p>Hi {{ $booking->firstName ?? '' }}&nbsp;{{ $booking->lastName ?? '' }}</p>
            <br>
            <p>Thank you for choosing Crystal Clean Sydney! We have remind your order and it is now being processed.
                Here are the details of your order:</p>
            <br>
            <p><strong>Order Summary:</strong></p>
            <ul>
                <li><strong>Service Type:</strong> {{ $booking->typeOfService ?? '' }}</li>
                <li><strong>Number of Rooms:</strong> {{ $booking->service ?? '' }}</li>
                <li><strong>Bathrooms:</strong> {{ $booking->bathroom ?? '' }}</li>
                <li><strong>Storey:</strong> {{ $booking->storey ?? '' }}</li>
                <li><strong>Additional Services:</strong></li>
                <ul class="additional-services">
                    {{-- <li>*|MERGE14|*</li> <!-- This will format the additional services in a column --> --}}
                </ul>
                <li><strong>Service Date:</strong> {{ $booking->day ?? '' }}</li>
                <li><strong>Service Time:</strong> {{ $booking->time ?? '' }}</li>
            </ul>

            <p><strong>Your Contact Details:</strong></p>
            <ul>
                <li><strong>Name:</strong> {{ $booking->firstName ?? '' }}&nbsp;{{ $booking->lastName ?? '' }}
                </li>
                <li><strong>Email:</strong>{{ $booking->email ?? '' }}</li>
                <!-- Updated to the correct merge tag -->
                <li><strong>Phone:</strong> {{ $booking->phone ?? '' }}</li>
                <li><strong>Service Address:</strong> {{ $booking->street ?? '' }}, {{ $booking->apt ?? '' }}&nbsp;{{ $booking->city ?? '' }}, {{ $booking->postal_code ?? '' }}</li>
            </ul>

            <p><strong>What's Next?</strong></p>
            <br>
            <p>This is a friendly reminder for your upcoming booking on {{ $booking->day }}. If you have any questions
                or need to make changes to your appointment, please contact us at info.crystalcleansyd@gmail.com or call
                us at 0426 280 899. Our team will be happy to assist you!</p>
            <br>

            <p>Thank you for choosing Crystal Clean Sydney!</p>
            <p><br>Best regards,</p>
            <p>The Crystal Clean Sydney Team</p>
        </div>
    </div>
</body>

</html>

{{-- <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
        </head>
        <body>
            <p>{{$booking}}</p>
        </body>
        </html> --}}
</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap');

    body {
        font-family: 'Manrope', Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
        color: #000000;
        /* Set all text to black */
    }

    .container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 0;
        /* Ensuring square edges */
    }

    .header {
        background-color: rgb(242, 240, 233);
        /* Same Brown color as the button */
        color: #000000;
        /* Black text */
        padding: 20px 0;
        text-align: center;
    }

    .header h1 {
        margin: 0;
        font-size: 24px;
        /* Adjusted font size to match */
        font-weight: 700;
        /* Make it bold */
    }

    .header p {
        margin: 0;
        font-size: 18px;
        /* Adjust font size to match */
        font-weight: 500;
        /* Slightly less bold */
    }

    .content {
        padding: 20px;
    }

    .footer {
        text-align: center;
        padding: 10px 0;
        font-size: 12px;
        color: #666666;
    }

    .additional-services {
        list-style-type: disc;
        /* Bullet points */
        padding-left: 20px;
        /* Indent for bullet points */
    }
</style>

</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Crystal Clean Sydney</h1>
            <p>Order Confirmation</p>
        </div>
        <div class="content">
            <p>Hi {{ $booking['firstName'] ?? '' }}&nbsp;{{ $booking['lastName'] ?? '' }}</p>
            <br>
            <p>Thank you for choosing Crystal Clean Sydney! We have received your order and it is now being processed.
                Here are the details of your order:</p>
            <br>
            <p><strong>Order Summary:</strong></p>
            <ul>
                <li><strong>Service Type:</strong> {{ $booking['typeOfService'] ?? '' }}</li>
                <li><strong>Number of Rooms:</strong> {{ $booking['service'] ?? '' }}</li>
                <li><strong>Bathrooms:</strong> {{ $booking['bathroom'] ?? '' }}</li>
                <li><strong>Storey:</strong> {{ $booking['storey'] ?? '' }}</li>
                <li><strong>Additional Services:</strong></li>
                <ul class="additional-services">
                    {{-- <li>*|MERGE14|*</li> <!-- This will format the additional services in a column --> --}}
                </ul>
                <li><strong>Service Date:</strong> {{ $booking['day'] ?? '' }}</li>
                <li><strong>Service Time:</strong> {{ $booking['time'] ?? '' }}</li>
            </ul>

            <p><strong>Your Contact Details:</strong></p>
            <ul>
                <li><strong>Name:</strong> {{ $booking['firstName'] ?? '' }}{{ $booking['lastName'] ?? '' }}
                </li>
                <li><strong>Email:</strong>{{ $booking['email'] ?? '' }}</li>
                <!-- Updated to the correct merge tag -->
                <li><strong>Phone:</strong> {{ $booking['phone'] ?? '' }}</li>
                <li><strong>Service Address:</strong> {{ $booking['street'] ?? '' }},
                    {{ $booking['apt'] ?? '' }}, {{ $booking['city'] ?? '' }},
                    {{ $booking['postalCode'] ?? '' }}</li>
            </ul>

            <p><strong>What's Next?</strong></p>
            <br>
            <p>Our team will contact you shortly to confirm your appointment details. If you have any questions or need
                to make changes to your order, please contact us at info.crystalcleansyd@gmail.com or call us at 0426
                280 899.</p>
            <br>

            <p>Thank you for choosing Crystal Clean Sydney!</p>
            <p><br>Best regards,</p>
            <p>The Crystal Clean Sydney Team</p>
        </div>
    </div>
</body>

</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>{{$booking}}</p>
</body>
</html> --}}
