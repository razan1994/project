<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>

    </title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md row align-items-center justify-content-center">
                <div class="col-md-5">
                    <a href="https://smartzone-jo.com/en" target="_blank">
                        <img class="image-preview " style="width: 100%;"
                            src="{{ asset('images_default/smart-zone-jo.jpeg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="m-b-md-12">
                <h1 style="color: #797979;">
                    Smartzone JO
                </h1>
                <hr>
                <h1 style="color: #797979;">Ticket Number :
                    <strong>
                        (
                        @isset($end_error_ticket)
                            {{ $end_error_ticket->id }}
                        @endisset
                        )
                    </strong>
                </h1>
                <hr>
                <h2 class="text-danger">Please contact the technical support department to solve this problem</h2>
                <h2 style="color: #b84f04;">
                    <b>Mobile :</b> <a style="color: #883d08;" href="tel:+962788823233">+962 7 8882 3233</a>
                    ||
                    <b>E-mail :</b> <a style="color: #883d08;" href="mailto:it@smartzone-jo.com">it@smartzone-jo.com</a>
                </h2>
                <h2>
                    <a href="{{ route('dashboard', 1) }}" class="text-primary">Back To Home Page</a>
                </h2>
            </div>
        </div>
    </div>
</body>

</html>
