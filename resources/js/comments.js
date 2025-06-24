window.updateComment = function() {
    console.log('здесь нужно получить полную информацию с бэка и впихнуть в попап. Удачи');
    openPopup();
}
window.showAll = function() {
    $('#popup-comment').removeClass('no-display');
}
window.updateSort = function() {
    let sort = $('#sort').attr('class');
    if (sort.indexOf('up') >= 0) {
        $('#sort').addClass('down');
        $('#sort').removeClass('up');
    } else {
        $('#sort').addClass('up');
        $('#sort').removeClass('down');
    }
}
