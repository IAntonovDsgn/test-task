<form id="update-comment" class="add-comment @if(!($errors->has('title-update') || $errors->has('text-update') || $errors->has('recommend-update'))) no-display @endif" method="POST" action="{{route('reviews.update')}}">
    @csrf
    <input name="id-update" id="id-update" class="no-display" value="">
    <div class="comment-form">
        <div class="popup--title">
            Редактирование отзыва
            <div class="close pointer" onclick="closePopup()">
                <img src="{{ asset('image/close.svg') }}">
            </div>
        </div>
        <div class="comment--info">
            <div class="field">
                <label class="field--label" for="title">Заголовок отзыва одной фразой</label>
                <div class="field--data">
                    <input type="text" name="title-update" id="title-update">
                </div>
                @error('title-update')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field">
                <label class="field--label" for="text">Ваш отзыв</label>
                <textarea class="field--data" rows="20" name="text-update" id="text-update"></textarea>
                @error('text-update')
                <p class="error-message">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="field--radio" authorized>
                <label class="field--label">Вы бы порекомендовали это?</label>
                <div class="field--data">
                    <input type="radio" name="recommend-update" value='1' id="recommend-yes">
                    <label>Да</label>
                </div>
                <div class="field--data">
                    <input type="radio" name="recommend-update" value='0' id="recommend-no">
                    <label>Нет</label>
                </div>
            </div>
        </div>
        <div class="comment--footer buttons">
            <button class="button primary" type="submit">Сохранить отзыв</button>
            <div class="button" onclick="closePopup()">Назад</div>
        </div>
    </div>
</form>
