<div id="menu" class="menu">
    <div class="menu--item pointer" onclick="openPage('{{ route('index') }}')" data-page="{{ route('index').'/' }}">Главная</div>
    <div class="menu--item pointer" onclick="openPage('{{ route('reviews.index') }}')" data-page="{{ route('reviews.index') }}">Отзывы</div>
    @auth<div class="menu--item pointer" onclick="openPage('{{ route('user.index') }}')" data-page="{{ route('user.index') }}" authorized>Мой профиль</div>@endauth
</div>
