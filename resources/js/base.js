/** закрывать при клике вне */
window.openPersonPopup = function() {
    let popupClasses = $("#person-popup").attr('class');
    if (popupClasses.indexOf('no-display') >= 0) {
        $("#person-popup").removeClass('no-display');
    } else {
        $("#person-popup").addClass('no-display');
    }
}

jQuery(function ($) {
    $(document).mouseup(function (e) {
        var div = $("#person-popup");
        if (!div.is(e.target) && div.has(e.target).length === 0) {
            $("#person-popup").addClass('no-display');
        }
    });
});

window.openPage =  function (page) {
    window.location = page;
}

window.openPopup = function() {
    $('#add-comment').removeClass('no-display');
}

window.closePopup = function() {
    $('#add-comment').addClass('no-display');
    $('#popup-comment').addClass('no-display');
}

window.isAuthorized = function() {
    let authorized = true;
    if (authorized) {
        $('[authorized]').removeClass('no-display');
        $('[not-authorized]').addClass('no-display');
    } else {
        $('[authorized]').addClass('no-display');
        $('[not-authorized]').removeClass('no-display');
    }
}

window.showPassword = function(element) {
    let show = $(element).attr('class');
    if (show.indexOf('private-off') >= 0) {
        $(element).removeClass('private-off');
    } else {
        $(element).addClass('private-off');
    }
}

window.onload = function () {
    sessionStorage.setItem('activePage', window.location);

    const activePage = sessionStorage.getItem('activePage');
    if (activePage) {
        $('.menu--item').removeClass('active');
        $(`.menu--item[data-page="${activePage}"]`).addClass('active');
    }

    setTimeout(function () {
        isAuthorized()
    }, 10);
};
