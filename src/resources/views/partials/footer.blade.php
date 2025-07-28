<div id="footer" class="footer">
    <div class="left-block" onclick="openPage('{{ route('index') }}')">
        <img src="{{ asset('image/H_7%20semibold.png') }}">
    </div>
    <div class="center">
        <div class="pointer" onclick="openPage('{{ route('index') }}')">Главная</div>
        <div class="pointer" onclick="openPage('{{ route('reviews.index') }}')">Отзывы</div>
        @Auth<div class="pointer" authorized onclick="openPage('{{ route('user.index') }}')">Мой профиль</div>@endauth
        <div class="pointer" onclick="openPage('{{ route('privacy-policy') }}')">Политика обработки персональных данных</div>
    </div>
    <div class="right-block">Logo Text © 2010 — 2025</div>
</div>
