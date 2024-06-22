// Скрипт для получения пользователя, чтобы отобразить в строках редактирования его данные

$(document).ready(async function () {
    const response = await $.ajax({
        url: '/user/' + window.location.pathname.split('/')[3],
        method: 'GET',
        dataType: 'json'
    });
    const user = response.message;

    document.getElementById('name').setAttribute('value', user.name);
    document.getElementById('lastname').setAttribute('value', user.lastname);
    document.getElementById('email').setAttribute('value', user.email);
    document.getElementById('company').setAttribute('value', user.company);
    document.getElementById('position').setAttribute('value', user.position);
});
