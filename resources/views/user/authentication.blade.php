@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    <div class="popup">
        <div class="popup--tabs" id="popup-tabs">
            <div id="auth" class="tab pointer active">Вход</div>
            <div id="registration" class="tab pointer">Регистрация</div>
        </div>
        <form id="auth-data" class="popup--fields" method="post" action="{{route('user.login')}}" novalidate>
            @csrf
            <div class="field">
                <label class="field--label" for="email">E-mail</label>
                <div class="field--data">
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="field">
                <label class="field--label" for="password">Пароль</label>
                <div class="field--data with-image">
                    <input class="password" type="password" name="password" value="">
                    <span class="private" onclick="showPassword(this)"></span>
                </div>
            </div>
            <div class="field text-right">
                <a href="{{ route('user.password-recovery') }}">Забыли пароль?</a>
            </div>
            <div class="field">
                <button class="button primary">
                    Войти
                </button>
            </div>
        </form>

        <form id="registration-data" class="popup--fields no-display" action="{{route('user.store')}}" method="post" novalidate>
            @csrf
            <div class="field">
                <label class="field--label" for="name">Логин / Имя пользователя</label>
                <div class="field--data">
                    <input name="name" type="text" value="{{ old('name') }}">
                </div>
            </div>
            <div class="field">
                <label class="field--label" for="email">E-mail</label>
                <div class="field--data">
                    <input name="email" type="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="field">
                <label class="field--label" for="password">Пароль</label>
                <div class="field--data with-image">
                    <input name="password" class="password" type="password" value="">
                    <span class="private" onclick="showPassword(this)"></span>
                </div>
            </div>
            <div class="field">
                <label class="field--label" for="password_confirmation">Повторите пароль</label>
                <div class="field--data with-image">
                    <input name="password_confirmation" class="password" type="password" value="">
                    <span class="private" onclick="showPassword(this)"></span>
                </div>
            </div>
            <div class="field">
                <input type="checkbox" name="approval" />
                <label for="approval" class="field--label-checkbox">Я даю согласие на <a href="{{ route('privacy-policy') }}">обработку моих персональных данных</a></label>
            </div>
            <div class="field">
                <button class="button primary">
                    Зарегистрироваться
                </button>
            </div>
        </form>

    </div>

@endsection
