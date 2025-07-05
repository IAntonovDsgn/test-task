$('#auth').on('click', function () {
    $('#registration').removeClass('active');
    $('#registration-data').addClass('no-display');
    $('#auth').addClass('active');
    $('#auth-data').removeClass('no-display');
});

$('#registration').on('click', function () {
    $('#auth').removeClass('active');
    $('#auth-data').addClass('no-display');
    $('#registration').addClass('active');
    $('#registration-data').removeClass('no-display');
});

function showError(obj, message) {
    $(obj).addClass('invalid');
    $(obj).after('<p class="error-message">' + message + '</p>');
    return false;
}

//валидация и отправка формы изменения фотографии пользователя:
$('#update-photo-btn').click(function () {
    $('#photo-input').click();
});

$('#photo-input').change(function () {
    console.log(this.files[0].size);
    if (this.files[0].size < 2097152) {
        $('#user-update-photo').submit()
    } else {
        showError($('#update-photo-btn'), 'Максимальный размер файла 2МБ')
    }
});

//Отправка формы изменения данных пользователя без пустых полей:
$('#user-update-data').on('submit', function () {
    const elements = this.elements;

    for (let i = 0; i < elements.length; i++) {
        const element = elements[i];

        if (element.value.length === 0) {
            element.removeAttribute('name');
        }
    }
});

//Подготовка и отправка формы смены пароля:
$('#user-update-password').on('submit', function (event) {
    event.preventDefault();
    event.target.oldPassword.value = $('#old-password')[0].value;
    this.submit();
});
