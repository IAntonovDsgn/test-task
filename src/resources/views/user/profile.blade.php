@extends('layouts.app')

@section('title', 'Мой профиль')

@section('content')
    @auth
        <h2>Мой профиль</h2>
        <div class="profile">
            <form id="user-update-photo" action="{{ route('user.update-photo') }}" enctype="multipart/form-data"
                  method="POST">
                @csrf
                <div class="my-profile">
                    <img
                        id="current-avatar"
                        src="@if(auth()->user()->photo){{ Storage::url(auth()->user()->photo) }}@else{{ asset('/image/default-avatar.svg') }}@endif"
                        alt="Avatar"
                        class="photo"
                    >
                    <input
                        type="file"
                        id="photo-input"
                        name="photo"
                        accept="image/*"
                        style="display: none;"
                        data-max-size="2048"
                    >
                    <div class="info">
                        <div class="info--nickname">{{ auth()->user()->name }}</div>
                        <div>ID: {{ auth()->user()->id }}</div>
                        <button type="button" id="update-photo-btn" class="info--update-photo pointer">
                            Заменить фото
                        </button>
                        @error('photo')
                        <p class="error-message">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
            </form>

            <form id="user-update-data" method="POST" action="{{ route('user.update') }}" novalidate>
                @csrf
                <div class="update-data">
                    <div class="fields">
                        <div class="field">
                            <label class="field--label @error('name') invalid @enderror">
                                Логин / Имя пользователя
                            </label>
                            <div class="field--data">
                                <input type="text" name="name" value="{{ auth()->user()->name }}">
                            </div>
                            @error('name')
                            <p class="error-message">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="field--label">Пароль</label>
                            <div class="field--data with-image">
                                <input
                                    class="password @error('password') invalid @enderror  @error('oldPassword') invalid @enderror"
                                    type="password"
                                    id="old-password"
                                    name="password">
                                <span class="private" onclick="showPassword(this)"></span>
                            </div>
                            @error('password')
                            <p class="error-message">
                                {{ $message }}
                            </p>
                            @enderror
                            @error('oldPassword')
                            <p class="error-message">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                    <div class="fields">
                        <div class="field">
                            <label class="field--label">E-mail</label>
                            <div class="field--data">
                                <input type="email"
                                       name="email"
                                       value="{{ auth()->user()->email }}"
                                       class="@error('email') invalid @enderror">
                            </div>
                            @error('email')
                            <p class="error-message">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                </div>
                @error('error')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
                <div class="buttons">
                    <button class="button primary">Сохранить</button>
                    <div class="button" id="update-password-button">Сменить пароль</div>
                    @if(session('success'))
                        <p class="success-message">
                            {{ session('success') }}
                        </p>
                    @endif
                </div>
            </form>

            <form id="user-update-password" method="post" action="{{ route('user.update-password') }}" novalidate>
                @csrf
                <input type="hidden" name="oldPassword" value="">
                <div id="update-password-fields"
                     class="@if($errors->has('newPassword') || $errors->has('newPassword_confirmation') || $errors->has('oldPassword')) @else no-display @endif">
                    <div class="update-data">
                        <div class="fields">
                            <div class="field">
                                <label class="field--label" for="newPassword">Новый пароль</label>
                                <div class="field--data with-image">
                                    <input class="password @error('newPassword') invalid @enderror"
                                           type="password"
                                           name="newPassword"
                                           value="">
                                    <span class="private" onclick="showPassword(this)"></span>
                                </div>
                                @error('newPassword')
                                <p class="error-message">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                        <div class="fields">
                            <div class="field">
                                <label class="field--label" for="newPassword_confirmation">Повторите пароль</label>
                                <div class="field--data with-image">
                                    <input class="password @error('newPassword_confirmation') invalid @enderror"
                                           type="password"
                                           name="newPassword_confirmation"
                                           value="">
                                    <span class="private" onclick="showPassword(this)"></span>
                                </div>
                                @error('newPassword_confirmation')
                                <p class="error-message">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="buttons">
                        <button class="button primary">Сменить пароль</button>
                    </div>
                </div>
            </form>
        </div>

        <h2>Мои отзывы</h2>
        @include('reviews.comment')
        @foreach($reviews as $review)
            <div class="comment">
                <div class="person">
                            <span class="person--icon">
                                <img src="{{ asset('image/Union.png') }}">
                            </span>
                    <span class="person--nickname">{{ $review->user->name ?? 'Гость' }}</span>
                </div>
                <div class="date">
                    {{ $review->created_at->format('d.m.Y') }}
                </div>
                <div class="comment--title">
                    {{ $review->title }}
                </div>
                <div class="comment--data">
                    {{ $review->text }}
                </div>
                <div class="buttons">
                    <div class="button" onclick="updateComment(this)"
                         data-request="{{ route('reviews.show',  $review->id) }}">
                        Редактировать отзыв
                    </div>
                    <div class="button" onclick="showAll(this)"
                         data-request="{{ route('reviews.show',  $review->id ) }}">
                        Читать весь отзыв
                    </div>
                </div>
            </div>
        @endforeach
    @endauth
@endsection
