@extends('layouts.app')

@section('title', 'Мой профиль')

@section('content')
    @auth
        <h2>Мой профиль</h2>

        <div class="profile">
            <div class="my-profile">
                <div class="photo">
                </div>
                <div class="info">
                    <div class="info--nickname">{{ auth()->user()->name }}</div>
                    <div>ID: {{ auth()->user()->id }}</div>
                    <div class="info--update-photo pointer">Заменить фото</div>
                </div>
            </div>
            <div class="update-data">
                <div class="fields">
                    <div class="field">
                        <label class="field--label">Логин / Имя пользователя</label>
                        <div class="field--data">
                            <input type="text" value="{{ auth()->user()->name }}">
                        </div>
                    </div>
                    <div class="field">
                        <label class="field--label">Пароль</label>
                        <div class="field--data with-image">
                            <input class="password" type="password" name="password" value="">
                            <span class="private" onclick="showPassword(this)"></span>
                        </div>
                    </div>
                </div>
                <div class="fields">
                    <div class="field">
                        <label class="field--label">E-mail</label>
                        <div class="field--data">
                            <input type="text" value="{{ auth()->user()->email }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <div class="button primary">Сохранить</div>
                <div class="button">Сменить пароль</div>
            </div>
        </div>

        <h2>Мои отзывы</h2>

        <div class="comment">
            <div class="person">
                                <span class="person--icon">
                                    <img src="{{ asset('image/Union.png') }}">
                                </span>
                <span class="person--nickname">Nickname</span>
            </div>
            <div class="date">
                07.10.2022
            </div>
            <div class="comment--title">
                Прототип нового сервиса — это как треск разлетающихся скреп!
            </div>
            <div class="comment--data">
                Вот вам яркий пример современных тенденций — постоянное информационно-пропагандистское обеспечение нашей деятельности не оставляет шанса для новых принципов формирования материально-технической и кадровой базы. Мы вынуждены отталкиваться от того, что сплочённость команды профессионалов говорит о возможностях существующих финансовых и административных условий. И нет сомнений, что базовые сценарии поведения пользователей функционально разнесены на независимые элементы.
            </div>
            <div class="buttons">
                <div class="button">Читать весь отзыв</div>
            </div>
        </div>
    @endauth
@endsection
