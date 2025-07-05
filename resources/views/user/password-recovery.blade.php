@extends('layouts.app')

@section('title', 'Главная')

@section('content')

    <div class="popup">
        <div class="popup--info">
            <h2>Восстановление пароля</h2>
            <div>Введите свою почту и мы отправим Вам ссылку на восстановление пароля</div>
            @if(session('success'))
            <p class="success-message">
                {{ session('success') }}
            </p>
            @endif
        </div>

        <form action="{{ route('password.email') }}" id="auth-data" class="popup--fields" method="post" novalidate>
            @csrf
            <div class="field">
                <label class="field--label">E-mail</label>
                <div class="field--data">
                    <input class="@error('email') invalid @enderror" name="email" type="email" value="{{ old('email') }}">
                </div>
                @error('email')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field buttons">
                <div class="button" onclick="openPage('{{ route('user.auth') }}')">
                    Назад
                </div>
                <button type="submit" class="button primary">
                    Далее
                </button>
            </div>
        </form>
    </div>

@endsection
