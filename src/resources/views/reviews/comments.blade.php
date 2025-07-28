@extends('layouts.app')

@section('title', 'Отзывы')

@section('content')

    @include('reviews.comment')
    <form class="filters" id="filters-form" action="{{ route('reviews.index') }}" method="GET">

        <div class="with-pagination">
            <h2>Отзывы</h2>

            <div class="search">
                <img src="{{ asset('image/Magnifier.svg') }}">
                <input name="search" type="text" placeholder="Найти..." value="{{ $search ?? '' }}">
                <input type="submit" hidden>
            </div>
            <div class="field">
                <div class="sort">
                    Показывать:
                    <span onclick="updateSort()" id="sort" class="{{ $sort ?? 'down' }}">
                        по дате
                        <img src="{{ asset('image/arrow-wrapper-black.svg') }}">
                    </span>
                    <input id="sort-input" name="sort-input" value="{{ $sort ?? 'down' }}">
                </div>
                <div class="all-count">
                    Найден(о) {{ $reviews->total() }} отзыв(а/ов)
                </div>
            </div>


            <!--  циклом выдавать сюда отзывы  -->
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
                        @if(auth()->user() && auth()->user()->id == $review->user_id)
                            <div class="button" onclick="updateComment(this)" data-request="{{ route('reviews.show',  $review->id) }}">
                                Редактировать отзыв
                            </div>
                        @endif
                        <div class="button" onclick="showAll(this)" data-request="{{ route('reviews.show',  $review->id) }}">
                            Читать весь отзыв
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="pagination">
            {{ $reviews->links('pagination::custom') }}
            <div class="counts">
                <input id="per-page" name="per-page" value="{{$perPage ?? 10}}">
                Показывать по:
                <p class="count {{ $perPage == 10 ? 'active' : '' }}" onclick="countPerPage(this)">10</p>
                <p class="count {{ $perPage == 20 ? 'active' : '' }}" onclick="countPerPage(this)">20</p>
                <p class="count {{ $perPage == 50 ? 'active' : '' }}" onclick="countPerPage(this)">50</p>
            </div>
        </div>

    </form>
@endsection
