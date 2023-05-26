@extends('layouts.app')

@section('content')
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

            <input id="password-confirm" type='password' class='inp form-group' placeholder='Подтвердите пароль' name="password_confirmation" required autocomplete="new-password">
            <button class='myBtn'>Изменить</button>
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </form>
    </div>
@endsection
