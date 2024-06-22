// Скрипт для получения телефонов пользователя, чтобы отобразить их в строках редактирования

$(document).ready(async function () {
    const response = await $.ajax({
        url: '/phones/' + window.location.pathname.split('/')[3],
        method: 'GET',
        dataType: 'json'
    });
    const phones = response.message;
    if (phones === 'Нет') {
        return;
    }
    for (let i = 0; i < phones.length; i++) {
        const dynamicId = 'phone' + (i + 1);
        document.getElementById(dynamicId).setAttribute('value', phones[i][0].number);
    }
});
