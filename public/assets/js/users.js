// Получение 10 пользователей с сервера, а также телефоны каждого пользователя, создание ячеек для таблицы и последующая пагинация

$(document).ready(async function () {
    const usersResponse = await $.ajax({
        url: '/user/users/' + window.location.pathname.split('/')[3],
        method: 'GET',
        dataType: 'json'
    });
    const users = usersResponse.message
    const countUsers = users.total
    const limit = 10;
    const page = parseInt(window.location.pathname.split('/')[3], 10);
    const countPage = Math.ceil(countUsers / limit);
    const pagination = document.getElementById('pagination');
    const responseSize = Object.keys(users).length - 1;
    const tableBody = $('.table tbody');
    tableBody.empty();
    for (let i = 0; i < responseSize; i++) {
        const row = $('<tr>');
        row.append(`<td>${users[i].id}</td>`);
        row.append(`<td>${users[i].name}</td>`);
        row.append(`<td>${users[i].lastname}</td>`);
        row.append(`<td>${users[i].email}</td>`);
        row.append(`<td>${users[i].company}</td>`);
        row.append(`<td>${users[i].position}</td>`);

        const phonesResponse = await $.ajax({
            url: '/phones/' + users[i].id,
            method: 'GET',
            dataType: 'json'
        });

        const phones = phonesResponse.message;
        if (phones === 'Нет') {
            row.append(`<td>${phones}</td>`);
        } else {
            for (let i = 0; i < phones.length; i++) {
                row.append(`<td>${phones[i][0].number}</td>`);
            }
        }
        row.append(`<td> <div class="buttons-container">
        <a href="/admin/edit/${users[i].id}" type="button" class="btn btn-sm btn-success">Редактировать</a>
        </div> </td>`);
        row.append(`<td><form action="/admin/delete/${users[i].id}" method="post">
            <input type="submit" value="Удалить" class="btn btn-sm btn-danger">
        </form> </td>`);
        tableBody.append(row);
    }

    for (let j = 1; j <= countPage; j++) {
        const li = document.createElement('li');
        li.classList.add('page-item');
        if (j === page) {
            li.classList.add('page-item', 'active');
        }

        pagination.appendChild(li);

        const btn = document.createElement('a');
        btn.classList.add('page-link');
        btn.href = '/admin/index/' + j;
        btn.innerText = j;
        li.appendChild(btn)
    }

    const btnBack = document.createElement('li');
    btnBack.classList.add('page-link');
    const aBack = document.createElement('a');
    btnBack.appendChild(aBack);
    aBack.innerHTML = "Назад";
    aBack.href = '/admin/index/' + (page - 1);

    const btnStart = document.createElement('li');
    btnStart.classList.add('page-link');
    const aStart = document.createElement('a');
    btnStart.appendChild(aStart);
    const iconStart = document.createElement('i');
    iconStart.classList.add('fa-solid', 'fa-backward-fast');
    aStart.appendChild(iconStart);
    aStart.href = '/admin/index/' + 1;

    if (page > 1) {
        pagination.insertAdjacentHTML('afterbegin', btnBack.outerHTML);
        pagination.insertAdjacentHTML('afterbegin', btnStart.outerHTML);
    }

    const btnNext = document.createElement('li');
    btnNext.classList.add('page-link');
    const aNext = document.createElement('a');
    btnNext.appendChild(aNext);
    aNext.innerHTML = "Вперёд";
    aNext.href = '/admin/index/' + (page + 1);

    const btnEnd = document.createElement('li');
    btnEnd.classList.add('page-link');
    const aEnd = document.createElement('a');
    btnEnd.appendChild(aEnd);
    const iconEnd = document.createElement('i');
    iconEnd.classList.add('fa-solid', 'fa-forward-fast');
    aEnd.appendChild(iconEnd);
    aEnd.href = '/admin/index/' + countPage;

    if (page < countPage) {
        pagination.insertAdjacentHTML('beforeend', btnNext.outerHTML);
        pagination.insertAdjacentHTML('beforeend', btnEnd.outerHTML);
    }
});




