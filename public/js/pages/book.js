$(document).ready(function($){
    // Создание таблицы
    var t = $('#bookTable').DataTable({
        pagingType: 'full_numbers',
        lengthMenu: [ [15, -1], [15, "All"] ]
    });

    // Открытие модалки создания новой книги и очищение ошибок валидации
    $('#btn-add').click(function () {
        $('#titleCreateError').css('display', 'none').val('');
        $('#descriptionCreateError').css('display', 'none').val('');
        $('#authorCreateError').css('display', 'none').val('');
        $('#imageCreateError').css('display', 'none').val('');

        $('#btn-saveCreate').val("add");
        $('#createForm').trigger("reset");
        $('#createModal').modal('show');
    });

    // Отправка ajax запроса на запись новой книги в DB и добавление новой записи на странице
    $("#btn-saveCreate").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        $('#titleCreateError').css('display', 'none').val('');
        $('#descriptionCreateError').css('display', 'none').val('');
        $('#authorCreateError').css('display', 'none').val('');
        $('#imageCreateError').css('display', 'none').val('');

        var file = $('#image').prop('files')[0]
        var author = $('#author').val()

        var form_data = new FormData();
        if (file !== undefined) {
            form_data.append('image', file);
        }
        form_data.append('title', $('#title').val());
        form_data.append('description', $('#description').val());
        if (author != null) {
            form_data.append('author', author);
        }

        $.ajax({
                type: 'POST',
                url: '/book',
                data: form_data,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var obj = jQuery.parseJSON(data)

                    var authors = [];
                    obj[0].authors.forEach(function (author) {
                        authors.push(author.surname + ' ' + author.name)
                    })

                    var image = '';
                    if (obj[0].image == null) {
                        image = '<td><img style="height: 100px; width: 100px;" src="storage/default/No-Image-Placeholder.svg.png"></td>'
                    } else {
                        image = '<td><img style="height: 100px; width: 100px;" src="storage/books/' + obj[0].image + '"></td>';
                    }

                    var date = obj[0].created_at
                    var slicedDate = date.slice(0, 10)
                    var slicedTime = date.slice(11, 19)
                    var dateTime = slicedDate + ' ' + slicedTime

                    var book = '<tr id="book' + obj[0].id + '">' +
                        '<td>' + obj[0].id + '</td>' +
                        image +
                        '<td>' + obj[0].title + '</td>' +
                        '<td>' + obj[0].description + '</td>' +
                        '<td>' + authors.join(',') + '</td>' +
                        '<td>' + dateTime + '</td>' +
                        '<td><button class="open-update-modal" id="btn-update" value="' + obj[0].id + '">Edit</button></td>' +
                        '<td><button class="deleteBook" id="btn-delete" value="' + obj[0].id + '">Delete</button></td></tr>';

                    t.row.add($(book)).draw();

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

    // Открытие модалки редактирования существующей книги и очищение ошибок валидации
    $('body').on('click', '.open-update-modal', function () {
        var id = $(this).val();
        $.get('/book/' + id, function (data) {
            $('#book_id').val(data[0].id);
            $('#titleUpdate').val(data[0].title);
            $('#descriptionUpdate').val(data[0].description);

            for (let i = 0; i < data[0].authors.length; i++) {
                var author = '<option class="option_ ' + data[0].authors[i].id + '" value="' + data[0].authors[i].id + '" selected>' +
                             data[0].authors[i].surname + ' ' + data[0].authors[i].name + '</option>';

                $(".option_" + data[0].authors[i].id).replaceWith(author);
            }
        })

        $('#titleUpdateError').css('display', 'none').val('');
        $('#descriptionUpdateError').css('display', 'none').val('');
        $('#authorUpdateError').css('display', 'none').val('');
        $('#imageUpdateError').css('display', 'none').val('');

        $('#btn-saveUpdate').val("add");
        $('#updateForm').trigger("reset");
        $('#updateModal').modal('show');
    });

    // Отправка ajax запроса на обновление существующей книги и обновление данных книги на старнице
    $("#btn-saveUpdate").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        $('#titleUpdateError').css('display', 'none').val('');
        $('#descriptionUpdateError').css('display', 'none').val('');
        $('#authorUpdateError').css('display', 'none').val('');
        $('#imageUpdateError').css('display', 'none').val('');

        var file = $('#imageUpdate').prop('files')[0]
        var author = $('#authorUpdate').val()

        var form_data = new FormData();
        form_data.append('id', $('#book_id').val());
        form_data.append('title', $('#titleUpdate').val());
        form_data.append('description', $('#descriptionUpdate').val());
        if (author != null) {
            form_data.append('author', author);
        }
        if (file !== undefined) {
            form_data.append('image', file);
        }

        $.ajax({
            type: 'POST',
            url: '/book/update',
            data: form_data,
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var obj = $.parseJSON(data)

                var authors = [];
                obj[0].authors.forEach(function (author) {
                    authors.push(author.surname)
                })

                var image = '<td><img style="height: 100px; width: 100px;" src="storage/books/' + obj[0].image + '"></td>';
                if (obj[0].image == null) {
                    image = '<td><img style="height: 100px; width: 100px;" src="storage/default/No-Image-Placeholder.svg.png"></td>'
                }

                var desc = obj[0].description;
                if (desc == null) {
                    desc = '';
                }

                var date = obj[0].created_at
                var slicedDate = date.slice(0, 10)
                var slicedTime = date.slice(11, 19)
                var dateTime = slicedDate + ' ' + slicedTime

                var book = '<tr id="book' + obj[0].id + '">' +
                            '<td>' + obj[0].id + '</td>' +
                            image +
                            '<td>' + obj[0].title + '</td>' +
                            '<td>' + desc + '</td>' +
                            '<td>' + authors.join(',') + '</td>' +
                            '<td>' + dateTime + '</td>' +
                            '<td><button class="open-update-modal" id="btn-update" value="' + obj[0].id + '">Edit</button></td>' +
                            '<td><button class="deleteBook" id="btn-delete" value="' + obj[0].id + '">Delete</button></td></tr>';

                var id = obj[0].id;

                $("#books-list #book" + id).replaceWith(book)

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

    // Отправка ajax запроса на удаление книги из DB и удаление записи со страницы
    $('body').on('click', '.deleteBook', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();

        var id = $(this).val();

        $.ajax({
            type: "POST",
            url: '/book/' + id + '/delete',
            success: function (data) {
                t.row($("#book" + id)).remove().draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
