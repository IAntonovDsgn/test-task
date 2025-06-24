@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    <div class="popup">
        <div class="popup--tabs" id="popup-tabs">
            <div id="auth" class="tab pointer active">Вход</div>
            <div id="registration" class="tab pointer">Регистрация</div>
        </div>
        <div id="auth-data" class="popup--fields">
            <div class="field">
                <label class="field--label">E-mail</label>
                <div class="field--data">
                    <input type="text" value="">
                </div>
            </div>
            <div class="field">
                <label class="field--label">Пароль</label>
                <div class="field--data with-image">
                    <input type="text" value="">
                    <span class="private" onclick="showPassword(this)"></span>
                </div>
            </div>
            <div class="field text-right">
                <a href="./password-recovery.html">Забыли пароль?</a>
            </div>
            <div class="field">
                <div class="button primary">
                    Войти
                </div>
            </div>
        </div>
        <div id="registration-data" class="popup--fields no-display">
            <div class="field">
                <label class="field--label">Логин / Имя пользователя</label>
                <div class="field--data">
                    <input type="text" value="">
                </div>
            </div>
            <div class="field">
                <label class="field--label">E-mail</label>
                <div class="field--data">
                    <input type="text" value="">
                </div>
            </div>
            <div class="field">
                <label class="field--label">Пароль</label>
                <div class="field--data with-image">
                    <input type="text" value="">
                    <span class="private" onclick="showPassword(this)"></span>
                </div>
            </div>
            <div class="field">
                <label class="field--label">Повторите пароль</label>
                <div class="field--data with-image">
                    <input type="text" value="">
                    <span class="private" onclick="showPassword(this)"></span>
                </div>
            </div>
            <div class="field">
                <input type="checkbox" />
                <span>Я даю согласие на <a href="./privacy-policy.html">обработку моих персональных данных</a></span>
            </div>
            <div class="field">
                <div class="button primary">
                    Зарегистрироваться
                </div>
            </div>
        </div>
    </div>

@endsection
