const $filterForm = $('#filters-form');

const fetchData = (element, callback) => {
    $.get($(element).data('request'))
        .done(callback)
        .fail(() => console.error('Request failed'));
};

window.updateComment = function (element) {
    fetchData(element, data => {
        const {
            id,
            title,
            text,
            is_recommended
        } = data;

        $('#title-update').val(title);
        $('#text-update').val(text);
        $('#id-update').val(id);

        $('#recommend-yes').prop('checked', is_recommended === 1);
        $('#recommend-no').prop('checked', is_recommended === 0);

        $('#update-comment').removeClass('no-display');
    });
};

window.showAll = function (element) {
    const $recommend = $('#recommend-block');
    const $noRecommend = $('#no-recommend-block');

    $recommend.addClass('no-display');
    $noRecommend.addClass('no-display');

    fetchData(element, data => {
        const {
            user_id,
            user = {},
            is_recommended,
            title,
            text
        } = data;

        $('.nickname').text(user_id ? user.name : 'Гость');

        $recommend.toggleClass('no-display', is_recommended !== 1);
        $noRecommend.toggleClass('no-display', is_recommended !== 0);

        $('#comment-text').text(text);
        $('#comment-title').text(title);

        $('#popup-comment').removeClass('no-display');
    });
};

window.updateSort = function () {
    let sort = $('#sort').attr('class');
    $('#sort-input').val(sort.indexOf('up') >= 0 ? 'down' : 'up');
    $filterForm.submit();
}

window.countPerPage = function (element) {
    $('#per-page').val($(element)[0].innerText);
    $filterForm.submit();
}
