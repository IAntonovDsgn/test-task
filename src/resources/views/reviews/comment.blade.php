<div id="popup-comment" class="add-comment popup-comment no-display">
    <div class="comment-form">
        <div class="popup--title">
            Отзыв
            <div class="close pointer" onclick="closePopup()">
                <img src="{{ asset('image/close.svg') }}">
            </div>
        </div>
        <div class="comment--info">
            <div class="person">
                            <span class="person--icon">
                                <img src="{{ asset('image/Union.png') }}">
                            </span>
                <span class="nickname"></span>
            </div>
            <div class="comment--title" id="comment-title">
            </div>
            <div class="comment--data" id="comment-text">
            </div>
            <div class="recommend no-display" id="recommend-block">
                <img src="{{ asset('image/mdi_thumb-up-outline.svg') }}">
                <div>
                    <div class="nickname"></div>
                    <div class="status">рекомендует</div>
                </div>
            </div>
            <div class="recommend no-recommend" id="no-recommend-block">
                <img src="{{ asset('image/mdi_thumb-up-outline-red.svg') }}">
                <div>
                    <div class="nickname"></div>
                    <div class="status">не рекомендует</div>
                </div>
            </div>
        </div>
        <div class="comment--footer buttons">
            <div class="button" onclick="closePopup()">Назад</div>
        </div>
    </div>
</div>
