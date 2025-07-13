<form id="add-comment" class="add-comment no-display" method="POST">
    @csrf
    <div class="comment-form">
        <div class="popup--title">
            Новый отзыв
            <div class="close pointer" onclick="closePopup()">
                <img src="{{ asset('image/close.svg') }}">
            </div>
        </div>
        <div class="comment--info">
            <div class="field">
                <label class="field--label" for="title">Заголовок отзыва одной фразой</label>
                <div class="field--data">
                    <input type="text" name="title">
                </div>
            </div>
            <div class="field">
                <label class="field--label" for="text">Ваш отзыв</label>
                <textarea class="field--data" rows="20" name="text"></textarea>
            </div>
            @auth()
            <input name="user_id" value="{{auth()->user()->id}}" class="no-display">
            @endauth
            @auth()
                <div class="field--radio" authorized>
                    <label class="field--label">Вы бы порекомендовали это?</label>
                    <div class="field--data">
                        <input type="radio" name="recommend"/>
                        <label>Да</label>
                    </div>
                    <div class="field--data">
                        <input type="radio" name="recommend"/>
                        <label>Нет</label>
                    </div>
                </div>
            @endauth
            <div class="field" not-authorized>
                Для того, чтобы оставить рекомендацию к отзыву, <a href="{{ route('user.auth') }}">войдите или
                    зарегистрируйтесь</a>
            </div>
        </div>
        <div class="comment--footer buttons">
            <button class="button primary" type="submit">Отправить отзыв</button>
            <div class="button" onclick="closePopup()">Назад</div>
        </div>
    </div>
</form>
