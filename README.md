## Сайт Скорочення посилань

Працює на laravel 7.

Потрібно встановити пакети композер та npm

## Що уміє дана збірка
- Скорочувати посилання
- Адмін панель
- Авторизація та реєстрація користувачів
- Має простеньке API для роботи зі скорочиннями
- Ролі користувача

## API
Для роботи з API потрібно мати роль адміна, та створити ключ в панелі адміністратора.

Бвзовим url для api є: your-domain/api/

## Методи API 

- api/short/all - отримує всі скорочення користувача
>тип GET, має бути вказано токен 

- /api/short/add
> Додає  нове скорочення

>запит має матизаголовок "Content-type: application/json", та виконуватись методом POST
Параметри запиту
- token - Ваш токен
- url - урл для скорочення


## Відповідь
    {"data":{"id":20,"url":"https:\\/\\/laravel.com\\/docs\\/7.x\\/validation#manually-creating-validators","short_id":"LLhA4pYG","user_id":1,"linked":0,"created_at":"2020-09-07T12:45:07.000000Z","updated_at":"2020-09-07T12:45:07.000000Z"}}

## Помилки
- 401 - некоректні дані для скорочення.

## Правки
- 0.26 - Пофіксино дадавання скорочень, тепер при додаванні однакового url для користувача буде повертатись уже існуюче скорочення для цього url (для еконономії місця піл БД). 

