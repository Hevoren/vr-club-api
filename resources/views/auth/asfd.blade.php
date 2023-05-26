<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
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
    <!--  if то-то -->
    <div class='confirm-form'>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h2>Восстановление пароля</h2>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus class='inp form-group @error('email') is-invalid @enderror' placeholder='Введите Email'>
            <button class='myBtn'>Отправить</button>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </form>

    </div>
    <!--  else то-то -->
    <div class='login-form'>
        <h2>Смена пароля</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input class='inp form-group @error('email') is-invalid @enderror' id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <input id="password" type="password" class='inp form-group @error('password') is-invalid @enderror' placeholder='Пароль' name="password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <input id="password-confirm" class='inp form-group' type='password' name='confirmPassword' placeholder='Подтвердите пароль'>
            <button class='myBtn'>Изменить</button>
        </form>
    </div>
</div>
</body>
</html>
