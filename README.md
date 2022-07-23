# test-work-for-untitled_2

## !Swagger в докере работает некорректно, postman работает правильно!

## Перед работой

    - Скачайте проект в удобное для Вас место
    - Убедитесь что используемые порты не заняты
    - При установке в докер убедитесь, что он работает корректно
    - При запуске локально убедитесь, что Composer работает корректно

### Для теста использовался Postman и все тесты проводились вручную на OC windows 
## Для установки в докер
**Пропишите** \
 `docker-compose up -d     ` \
**Затем перейдите в контейнер командой** \
`docker exec -it project-app bash ` \
**И пропишите** \
`php artisan migrate --seed ` \
`php artisan key:generate  `\
**Приложение запушено и готово к работе** \

Ссылка с документацией \
http://localhost:8888/api/documentation#/

Ссылка для работы с api \
http://localhost:8888/api/v1/

## Для локального запуска

**Создайте базу данных для проектаи укажите её в файле.env**\
**В файле .env.example , можно посмотреть пример файла при локальном запуске** \
**Убедитесь что бд запущена**\
**После этого пропишите** \
`php artisan migrate --seed ` \
`php artisan serve ` \
**Приложение запушено и готово к работе** 

Ссылка с документацией \
http://127.0.0.1:8000/api/documentation#/

Ссылка для работы с api \
http://127.0.0.1:8000/api/v1/

## Методы
GET  `/notebook` возращает постранично все записи \
GET  `/notebook?page=2` указание страницы \
GET  `/notebook/1` возращает запись с указанным id \
POST `/notebook` добавляет запись в бд \
POST `/notebook/1` обновляет запись с указанным id в бд \
DELETE `/notebook/1` удаляет запись с указанным id в бд 

### Дополнительно 
Поля 'fio','email, 'phone' при POST запросе являются обязательными! \
В случае отсутствие какого либо из них возращается ошибка с описанием чего не хватает. \
При загрузке фото, фото сохраняется локально, а в бд прописывается путь до неё. 

