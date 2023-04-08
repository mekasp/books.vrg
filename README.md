# books.vrg

## О проекте
<span>books.vrg - это CRUD приложение,запросы (Create, Update, Delete) которого, выполняются без перезагрузки страницы.</span>
<br>
<span>В проекте реализованы миграции и сидер,сервер-сайд валидация и динамическое изменение данных на странице поссредством испозьзования XMLHttpRequest.</span>
<span>Файл .jpg папке storage/app/public/books используется сидером. В default папке .png файл используется,если у книги нет обложки</span>

##Стэк тенологий
<span></span>
<span>- Homestead Laravel 10.5.1</span>
<br>
<span>- PHP 8.1</span>
<br>
<span>- MySql (InnoDB)</span>
<br>
<span>- jQuery 3.5.1 (CDN)</span>
<br>
<span>- Bootstrap 5.2.3 (CDN)</span>
<br>
<span>- Datatables 1.13.4 (CDN)</span>

## Запуск проекта
<span>Для запуска проекта достаточно ввести данные для подключения к DB в .env файл, установить composer и создать сим-линк.</span>
<br>
<span>Для этого нужно в терминале ввести команду: "php artisan storage:link"</span>

#### P.S.
<span>Это мой первый опыт работы с jQuery и DOM(ом) в частности</span>
