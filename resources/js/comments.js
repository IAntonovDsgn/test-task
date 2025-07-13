window.updateComment = function (request) {
    console.log('здесь нужно получить полную информацию с бэка и впихнуть в попап. Удачи');

    openPopup();
}

window.showAll = function (element) {
    const $element = $(element);
    const request = $element.attr('data-request');

    $.ajax({
        url: request,
        method: 'get',
        success: function (data) {
            if (data.user_id) {
                $('.nickname').text(data.user.name);
                if (data.is_recommended) {
                    $('#recommend-block').removeClass('no-display');
                    $('#no-recommend-block').addClass('no-display');
                } else {
                    $('#recommend-block').addClass('no-display');
                    $('#no-recommend-block').removeClass('no-display');
                }
            } else {
                $('.nickname').text('Гость');
                $('#recommend-block').addClass('no-display');
                $('#no-recommend-block').addClass('no-display');
            }
            $('#comment-title').text(data.title);
            $('#comment-text').text(data.text);

            $('#popup-comment').removeClass('no-display');
        }
    });
}

window.updateSort = function () {
    let sort = $('#sort').attr('class');
    if (sort.indexOf('up') >= 0) {
        $('#sort-input').val('down');
    } else {
        $('#sort-input').val('up');
    }
    $('#filters-form').submit();
}

window.cauntPerPage = function (element) {
    $('#per-page').val('');
    $('#per-page').val($(element)[0].innerText);
    $('#filters-form').submit();
}
