/** закрывать при клике вне */

$(document).on('click', function (event) {
    const target = $(event.target);
    if (target.closest($('#person-pointer')).length) {
        $("#person-popup").toggleClass('no-display');
    } else if (!target.closest($('#person-popup')).length) {
        $("#person-popup").addClass('no-display');
    }
});

$('#update-password-button').on('click', function () {
    $('#update-password-fields').toggleClass('no-display');
});

window.openPage = function (page) {
    window.location = page;
}

window.openPopup = function () {
    $('#add-comment').removeClass('no-display');
}

window.closePopup = function () {
    $('#add-comment').addClass('no-display');
    $('#popup-comment').addClass('no-display');
    $('#update-comment').addClass('no-display');
}

window.isAuthorized = function () {
    if (document.body.dataset.auth) {
        $('[authorized]').removeClass('no-display');
        $('[not-authorized]').addClass('no-display');
    } else {
        $('[authorized]').addClass('no-display');
        $('[not-authorized]').removeClass('no-display');
    }
}

window.showPassword = function (element) {
    let show = $(element).attr('class');
    if (show.indexOf('private-off') >= 0) {
        $(element).removeClass('private-off');
        $(element).siblings('.password').attr('type', 'password');
    } else {
        $(element).addClass('private-off');
        $(element).siblings('.password').attr('type', 'text');
    }
}

window.onload = function () {

    setTimeout(function () {
        isAuthorized()
    });

    $('.menu--item').removeClass('active');
    $(`.menu--item[data-page="${window.location.origin + window.location.pathname}"]`).addClass('active');
};

