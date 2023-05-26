<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <style>
        body {
            height: 100vh;
            background-color: #151825;
        }

        h2 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .restore-form {
            max-width: 300px;
            margin: 0 auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: black;
        }

        .myBtn {
            padding: 0.3em 1.7em;
            font-size: 1.5em;
            transition: background-color 0.3s ease;

            display: flex;
            align-items: center;
            justify-content: center;

            background-color: #26B7E2;
            color: #fff;

            border: 4px solid #FFFFFF;
            border-radius: 25px;
        }

        .myBtn:hover {
            background-color: #a20000;
            color: #fff;
        }

        .myBtn:active {
            box-sizing: border-box;

            background: #26B7E2;
            box-shadow: inset 0 4px 4px rgba(0, 0, 0, 0.2);
            border-radius: 25px;

        }


        .inp {

            width: 100%;
            height: 52px;

            background: #E4F7FF;
            border-radius: 25px;

            text-indent: 15px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

    </style>
</head>
<body>
<div class='restore-form'>
    @yield('content')
</div>
</body>
</html>
