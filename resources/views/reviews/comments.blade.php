@extends('layouts.app')

@section('title', 'Отзывы')

@section('content')

    @include('reviews.comment')

    <div class="with-pagination">
        <h2>Отзывы</h2>

        <div class="filters">
            <div class="search">
                <img src="{{ asset('image/Magnifier.svg') }}" />
                <input type="text" placeholder="Найти..." />
            </div>
            <div class="field">
                <div class="sort">
                    Показывать:
                    <span onclick="updateSort()" id="sort" class="up">по дате <img src="{{ asset('image/arrow-wrapper-black.svg') }}"></span>
                </div>
                <div class="all-count">
                    Найден(о) N отзыв(а/ов)
                </div>
            </div>
        </div>

        <!--  циклом выдавать сюда отзывы  -->
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
                <div class="button" onclick="showAll()">Читать весь отзыв</div>
            </div>
        </div>
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
                <div class="button with-image" onclick="updateComment()">
                    <img src="{{ asset('image/Review.svg') }}">
                    Редактировать отзыв
                </div>
                <div class="button" onclick="showAll()">Читать весь отзыв</div>
            </div>
        </div>
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
                <div class="button" onclick="showAll()">Читать весь отзыв</div>
            </div>
        </div>

    </div>

    <div class="pagination">
        <pages>
            <img src="{{ asset('image/arrow-today.svg') }}">
            <page class="active">1</page>
            <page>2</page>
            <page>3</page>
            <page class="no-active">...</page>
            <page>9</page>
            <img src="{{ asset('image/arrow-today.svg') }}">
        </pages>
        <counts>
            Показывать по:
            <count>10</count>
            <count class="active">20</count>
            <count>50</count>
        </counts>
    </div>

@endsection
