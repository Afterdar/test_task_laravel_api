Тестовое задание:
Необходимо разработать web-сервис для личных заметок.
Основные функции:
Регистрация - можно реализовать любым способом, включая самый простой по логину/паролю, который придумывает пользователь
В БД должно быть предусмотрено безопасное хранение пароля
Авторизация - можно использовать любой метод авторизации (куки, jwt)
Выход из системы (разлогиниться)
Создание заметок - по restfull протоколу POST
Редактирование заметок - по restfull протоколу PUT или PATCH
Удаление заметок - по restfull протоколу DELETE
Просмотр заметок с пагинацией - по restfull протоколу  GET

Бизнес-правила:
Пользователь может видеть только свои заметки
CRUD операции заметок допускаются только для личных заметок
(эта заметка принадлежит пользователю;
зная id чужой заметки бэк все равно запрещает выполнение операций - возвращает 404)

Аунтификация реализована через пакет Sanctum (Bearer token, Cookie X-XSRF-TOKEN)
