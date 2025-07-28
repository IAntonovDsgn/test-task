@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="popup">
        <div class="popup--tabs" id="popup-tabs">
            <div id="auth"
                 class="tab pointer @if(($errors->has('login-email') || $errors->has('login-password') || $errors->isEmpty())) active @endif">
                Вход
            </div>
            <div id="registration"
                 class="tab pointer @if(!($errors->has('login-email') || $errors->has('login-password') || $errors->isEmpty())) active @endif">
                Регистрация
            </div>
        </div>
        <form id="auth-data"
              class="popup--fields @if(!($errors->has('login-email') || $errors->has('login-password') || $errors->isEmpty())) no-display @endif"
              method="POST"
              action="{{route('user.login')}}"
              novalidate>
            @if(session('success'))
                <p class="success-message">
                    {{ session('success') }}
                </p>
            @endif
            @csrf
            <div class="field">
                <label class="field--label" for="email">E-mail</label>
                <div class="field--data">
                    <input class="@error('login-email') invalid @enderror" type="email" name="login-email"
                           value="{{ old('login-email') }}">
                </div>
                @error('login-email')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field">
                <label class="field--label" for="password">Пароль</label>
                <div class="field--data with-image">
                    <input class="password  @error('login-password') invalid @enderror" type="password"
                           name="login-password" value="">
                    <span class="private" onclick="showPassword(this)"></span>
                </div>
                @error('login-password')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field text-right">
                <a href="{{ route('password.request') }}">Забыли пароль?</a>
            </div>
            <div class="field">
                <button class="button primary">
                    Войти
                </button>
            </div>
        </form>

        <form id="registration-data"
              class="popup--fields @if($errors->has('login-email') || $errors->has('login-password') || $errors->isEmpty()) no-display @endif"
              action="{{route('user.store')}}"
              method="POST"
              novalidate>
            @csrf
            @error('error')
            <p class="error-message">
                {{ $message }}
            </p>
            @enderror
            <div class="field">
                <label class="field--label" for="name">Логин / Имя пользователя</label>
                <div class="field--data">
                    <input class="@error('name') invalid @enderror" name="name" type="text" value="{{ old('name') }}">
                </div>
                @error('name')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field">
                <label class="field--label" for="email">E-mail</label>
                <div class="field--data">
                    <input class="@error('email') invalid @enderror" name="email" type="email"
                           value="{{ old('email') }}">
                </div>
                @error('email')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field">
                <label class="field--label" for="password">Пароль</label>
                <div class="field--data with-image">
                    <input
                        name="password"
                        class="password @error('password') invalid @enderror"
                        type="password"
                        value="">
                    <span class="private" onclick="showPassword(this)"></span>
                </div>
                @error('password')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field">
                <label class="field--label" for="password_confirmation">Повторите пароль</label>
                <div class="field--data with-image">
                    <input name="password_confirmation"
                           class="password @error('password_confirmation') invalid @enderror" type="password" value="">
                    <span class="private" onclick="showPassword(this)"></span>
                </div>
                @error('password_confirmation')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field">
                <input type="checkbox" name="approval"/>
                <label for="approval" class="field--label-checkbox">Я даю согласие на
                    <a href="{{ route('privacy-policy') }}">обработку моих персональных данных</a></label>
                @error('approval')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field">
                <button class="button primary">
                    Зарегистрироваться
                </button>
            </div>
        </form>

    </div>

@endsection
