@extends('layouts.app')

@section('content')
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
@endsection
