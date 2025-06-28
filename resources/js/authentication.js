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

//Валидация и отправка формы входа:
$('#auth-data').on('submit', function (event) {
    $('.error-message').remove();
    event.preventDefault();

    let email = event.target.email;
    let password = event.target.password;

    $(email).removeClass('invalid');
    $(password).removeClass('invalid');

    if (email.value.length < 1) {
        return showError(email, 'Введите e-mail');
    }

    if (password.value.length < 1) {
        return showError(password, 'Введите пароль');
    }

    $.ajax({
        url: $(event.target).attr('action'),
        type: 'get',
        data: {
            email: event.target.email.value,
            password: event.target.password.value
        },
        headers: {
            'X-CSRF-TOKEN': event.target._token.value
        },
        success: function (response) {
            if (response.email) {
                showError(email, response.email);
            } else if (response.password) {
                showError(password, response.password);
            } else {
                location.reload();
            }
        }
    });
})

//Валидация формы регистрации:
$('#registration-data').on('submit', function (event) {
    $('.error-message').remove();

    const isNameValid = validateName(event);
    const isEmailValid = validateEmail(event);
    const isPasswordValid = validatePassword(event);
    const isApproval = validateApproval(event);

    if (!(isNameValid && isEmailValid && isPasswordValid && isApproval)) {
        event.preventDefault();
    }
});

function validateName(event) {
    try {
        let name = event.target.name;
        $(name).removeClass('invalid');

        if (name.value.length < 2) {
            return showError(name, 'Имя слишком короткое (мин. 2 символа)');
        } else if (name.value.length > 30) {
            return showError(name, 'Имя слишком длинное (макс. 30 символов)');
        }

        return true;

    } catch (error) {
        alert("Ошибка валидации поля 'Логин / Имя пользователя'. \n" + error);
        return false;
    }
}

function validateEmail(event) {
    try {
        let email = event.target.email;
        $(email).removeClass('invalid');

        if (email.value.length < 1) {
            return showError(email, 'Заполните поле E-mail');
        } else if (email.value.length > 50) {
            return showError(email, 'E-mail слишком длинный (макс. 50 символов)');
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            return showError(email, 'E-mail должен соответствовать маске example@example.domen');
        }

        $.ajax({
            url: $(event.target).attr('action') + '/check-email',
            type: 'POST',
            data: {email: event.target.email.value},
            headers: {
                'X-CSRF-TOKEN': event.target._token.value
            },
            success: function (response) {
                if (response.unavailable) {
                    showError(email, response.unavailable);
                } else {
                    return true;
                }
            }
        });



    } catch (error) {
        alert("Ошибка валидации поля 'E-mail'. \n" + error);
        return false;
    }
}

function validatePassword(event) {
    try {
        let password = event.target.password;
        $(password).removeClass('invalid');
        $(event.target.password_confirmation).removeClass('invalid');

        if (password.value.length < 8) {
            return showError(password, 'Пароль слишком короткий (мин. 8 символа)');
        } else if (password.value.length > 255) {
            return showError(password, 'Пароль слишком длинный (макс. 255 символов)');
        } else if (!/^[\x21-\x7E]+$/.test(password.value)) {
            return showError(password, 'Пароль может содержать только латинские буквы, цифры и спецсимволы');
        } else if (!(password.value === event.target.password_confirmation.value)) {
            return showError(event.target.password_confirmation, 'Пароли не совпадают');
        }

        return true;

    } catch (error) {
        alert("Ошибка валидации поля 'Пароль'. \n" + error);
        return false;
    }
}

function validateApproval(event) {
    try {
        let approval = event.target.approval;
        $(approval).removeClass('invalid');

        if (!approval.checked) {
            return showError(approval.nextElementSibling, 'Подтвердите согласие');
        }

        return true;

    } catch (error) {
        alert("Ошибка валидации чекбокса 'Я даю согласие на обработку моих персональных данных'. \n" + error);
        return false;
    }
}
