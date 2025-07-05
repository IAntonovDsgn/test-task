@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    <div class="popup">
        <div class="popup--info">
            <h2>Восстановление пароля</h2>
            <div>Введите свою почту и мы отправим Вам ссылку на восстановление пароля</div>
        </div>

        <form action="{{ route('password.reset.store') }}" id="auth-data" class="popup--fields" method="post"
              novalidate>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="fields">
                <div class="field">
                    <label class="field--label">E-mail</label>
                    <div class="field--data">
                        <input class="@error('email') invalid @enderror"
                               name="email"
                               type="email"
                               value="{{ old('email') }}">
                    </div>
                    @error('email')
                    <p class="error-message">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="field">
                    <label class="field--label">Новый пароль</label>
                    <div class="field--data with-image">
                        <input class="password @error('password') invalid @enderror"
                               type="password"
                               name="password" value="">
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
                        <input class="password @error('password_confirmation') invalid @enderror"
                               type="password" name="password_confirmation"
                               value="">
                        <span class="private" onclick="showPassword(this)"></span>
                    </div>
                    @error('password_confirmation')
                    <p class="error-message">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="field">
                    <button type="submit" class="button primary">
                        Сохранить
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
