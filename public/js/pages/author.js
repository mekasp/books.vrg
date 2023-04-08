$(document).ready(function($){
    // Создание таблицы
    var t = $('#bookTable').DataTable({
        pagingType: 'full_numbers',
        lengthMenu: [ [15, -1], [15, "All"] ]
    });

    // Открытие модалки создания нового автора и очищение ошибок валидации
    $('#btn-add').click(function () {
        $('#surnameCreateError').css('display', 'none').val('');
        $('#nameCreateError').css('display', 'none').val('');
        $('#middleNameCreateError').css('display', 'none').val('');

        $('#btn-saveCreate').val("add");
        $('#createForm').trigger("reset");
        $('#createModal').modal('show');
    });

    // Отправка ajax запроса на запись нового автора в DB и добавление новой записи на странице
    $("#btn-saveCreate").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        $('#surnameCreateError').css('display', 'none').val('');
        $('#nameCreateError').css('display', 'none').val('');
        $('#middleNameCreateError').css('display', 'none').val('');

        var form_data = new FormData();
        form_data.append('surname', $('#surname').val());
        form_data.append('name', $('#name').val());
        form_data.append('middleName', $('#middleName').val());

        $.ajax({
                type: 'POST',
                url: '/author',
                data: form_data,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var obj = jQuery.parseJSON(data)

                    var middle_name = '';
                    if (obj.middle_name != null) {
                        middle_name = obj.middle_name;
                    }

                    var author = '<tr id="author' + obj.id + '">' +
                        '<td>' + obj.id + '</td>' +
                        '<td>' + obj.surname + '</td>' +
                        '<td>' + obj.name + '</td>' +
                        '<td>' + middle_name + '</td>' +
                        '<td><button class="open-update-modal" id="btn-update" value="' + obj.id + '">Edit</button></td>' +
                        '<td><button class="deleteAuthor" id="btn-delete" value="' + obj.id + '">Delete</button></td></tr>';

                    t.row.add($(author)).draw();

                    $('#createForm').trigger("reset");
                    $('#createModal').modal('hide')
                },
                error: function (response) {
                    var obj = jQuery.parseJSON(response.responseText)

                    for (const key in obj.errors) {
                        if (obj.errors[key].length > 0) {
                            $('#' + key + 'CreateError').css('display', '').val(obj.errors[key][0]);
                        }
                    }
                }
        });
    });

    // Открытие модалки редактирования существующего автора и очищение ошибок валидации
    $('body').on('click', '.open-update-modal', function () {
        var id = $(this).val();

        $.get('/author/' + id, function (data) {
            $('#author_id').val(data.id);
            $('#surnameUpdate').val(data.surname);
            $('#nameUpdate').val(data.name);
            $('#middleNameUpdate').val(data.middle_name);
        })

        $('#surnameUpdateError').css('display', 'none').val('');
        $('#nameUpdateError').css('display', 'none').val('');
        $('#middleNameUpdateError').css('display', 'none').val('');

        $('#btn-saveUpdate').val("add");
        $('#updateForm').trigger("reset");
        $('#updateModal').modal('show');
    });

    // Отправка ajax запроса на обновление существующего автора и обновление данных автора на старнице
    $("#btn-saveUpdate").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        $('#surnameUpdateError').css('display', 'none').val('');
        $('#nameUpdateError').css('display', 'none').val('');
        $('#middleNameUpdateError').css('display', 'none').val('');

        var form_data = new FormData();
        form_data.append('id', $('#author_id').val());
        form_data.append('surname', $('#surnameUpdate').val());
        form_data.append('name', $('#nameUpdate').val());
        form_data.append('middleName', $('#middleNameUpdate').val());

        $.ajax({
            type: 'POST',
            url: '/author/update',
            data: form_data,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var obj = $.parseJSON(data)

                var middle_name = '';
                if (obj.middle_name != null) {
                    middle_name = obj.middle_name;
                }

                var author = '<tr id="author' + obj.id + '">' +
                    '<td>' + obj.id + '</td>' +
                    '<td>' + obj.surname + '</td>' +
                    '<td>' + obj.name + '</td>' +
                    '<td>' + middle_name + '</td>' +
                    '<td><button class="open-update-modal" id="btn-update" value="' + obj.id + '">Edit</button></td>' +
                    '<td><button class="deleteAuthor" id="btn-delete"  value="' + obj.id + '">Delete</button></td></tr>';

                $("#author-list #author" + obj.id).replaceWith(author)

                $('#updateForm').trigger("reset");
                $('#updateModal').modal('hide')
            },
            error: function (response) {
                var obj = $.parseJSON(response.responseText)

                for (const key in obj.errors) {
                    if (obj.errors[key].length > 0) {
                        $('#' + key + 'UpdateError').css('display', '').val(obj.errors[key][0]);
                    }
                }
            }
        });
    });

    // Отправка ajax запроса на удаление автора из DB и удаление записи со страницы
    $('body').on('click', '.deleteAuthor', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        var id = $(this).val();

        $.ajax({
            type: "POST",
            url: '/author/' + id + '/delete',
            success: function (data) {
                t.row($("#author" + id)).remove().draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
