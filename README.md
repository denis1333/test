При разработке использовался фреймворк laravel.

Данные подключения к бд находятся в файле .env.
Для создания бд и наполнения её можно использовать команды laravel или просто загрузить дамп находящийся в папке film.

Команды:
1. php artisan serve - включить локальный сервер. Доступен по localhost:8000
2. php artisan migrate - создать таблицы в бд
3. php artisan db:seed - создать записи в бд
4. php artisan migrate:refresh --seed - пересоздать таблицы и создать записи