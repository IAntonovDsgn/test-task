<div id="header" class="header">
    <div class="header--info">
        <div class="logo" onclick="openPage('{{ route('index') }}')">
            logo text
        </div>
        <div class="right-block">
            <div class="button primary" onclick="openPopup()">
                <img class="add--icon" src="{{ asset('image/Plus.png') }}">
                <span class="add--text">Добавить отзыв</span>
            </div>
            @guest
                <div class="button" onclick="openPage('{{ route('user.auth') }}')" not-authorized>
                    Войти
                </div>
            @endguest

            @auth
                <div id="person-pointer" class="person pointer" authorized>
                    <span class="person--icon">
                        <img src="{{ asset('image/Union.png') }}">
                    </span>
                    <span class="person--nickname">{{ auth()->user()->name }}</span>
                </div>
                <div class="person-popup no-display" id="person-popup">
                    <img class="arrow" src="{{ asset('image/arrow-wrapper.svg') }}">
                    <div class="person-popup--items">
                        <div class="item pointer" onclick="openPage('{{ route('user.index') }}')">
                            <img src="{{ asset('image/mdi_account-outline.svg') }}">
                            Мой профиль
                        </div>
                        <div class="item pointer" onclick="openPage('{{ route('privacy-policy') }}')">
                            <img src="{{ asset('image/mdi_account-outline.svg') }}">
                            Политика конфиденциальности
                        </div>
                        <div class="hr"></div>
                        <div class="item pointer" onclick="openPage('{{ route('user.logout') }}')">
                            <img src="{{ asset('image/mdi_exit-to-app.svg') }}">
                            Выйти
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
