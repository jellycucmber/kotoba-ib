<?php
/*************************************
 * Этот файл является частью Kotoba. *
 * Файл license.txt содержит условия *
 * распространения Kotoba.           *
 *************************************/
/*********************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************/

// Формат событий:
// (Тип события) Сообщение. (Дата и время наступления)

// Заметки:
//
// Префиксы ERR_, WARN_, INFO_ и т.д. в именах констант соотвествуют различным типам событий.
//
// Объявляя константы, зависящие от параметров, обязательно указывайте в комментариях, что значат эти параметры.
// Описывайте параметры в том порядке, в котором они встречаются в значении константы.

define('ERR_STATFILE', '(Ошибка) Не удалось открыть или создать файл статистики.');

// TODO Убрать из названий констант слова типа FALTURE, FAILED. Масло маленное.
// TODO Переписать тексты ошибок.

define('ERR_BOARD_NOT_SPECIFED', '(Ошибка) Не задано имя доски.');
define('ERR_BOARD_BAD_FORMAT', '(Ошибка) Имя доски имеет неверный формат.');

// 1. Имя доски.
define('ERR_BOARD_NOT_FOUND', '(Ошибка) Доски с именем %s не существует.');

// 1. Имя доски.
// 2. Причина неудачи проверки существования доски.
define('ERR_BOARD_EXIST_CHECK', '(Ошибка) Не удалось проверить существование доски с именем %s. Прична: %s.');
define('ERR_BOARDS_NOT_EXIST', '(Ошибка) Не создано ни одной доски.');

// 1. Причина неудачи получения списка досок.
define('ERR_BOARDS_LIST', '(Ошибка) Невозможно получить список досок. Причина: %s');

define('ERR_FILE_TOO_SMALL', '(Ошибка) Загружаемый файл имеет слишком маленький размер.');
define('ERR_TEXT_TOO_LONG', '(Ошибка) Текст сообщения слишком длинный.');
define('ERR_THEME_TOO_LONG', '(Ошибка) Тема слишком длинная.');
define('ERR_NAME_TOO_LONG', '(Ошибка) Имя пользователя слишком длинное.');
define('ERR_WRONG_FILETYPE', '(Ошибка) Недопустимый тип файла.');
define('ERR_FILE_NOT_SAVED', '(Ошибка) Файл не удалось сохранить.');
define('ERR_FILE_ALREADY_EXIST', '(Ошибка) Картинка уже была запощена.');

// 1. Имя доски.
// 2. Причина неудачи проверки существования картинки.
define('ERR_FILE_EXIST_FAILED', '(Ошибка) Не удалось проверить существование картинки на доске с именем %s. Прична: %s.');
define('ERR_FILE_LOW_RESOLUTION', '(Ошибка) Разрешение загружаемого изображения слишком маленькое.');
define('ERR_THUMB_CREATION', '(Ошибка) Не удалось создать уменьшенную копию изображения.');
define('ERR_PASS_BAD_FORMAT', '(Ошибка) Пароль для удаления имеет неверный формат.');

// 1. Причина неудачи начала транзакции.
define('ERR_TRAN_FAILED', '(Ошибка) Невозможно начать транзакцию. Причина: %s.');

// 1. Имя доски.
// 2. Причина неудачи подсчёта количества постов.
define('ERR_POST_COUNT_CALC', '(Ошибка) Невозможно подсчитать количество постов доски %s. Причина: %s.');

// 1. Причина неудачи поиска треда.
define('ERR_ARCH_THREAD_SEARCH', '(Ошибка) Невозможно найти тред для сброса в архив. Причина: %s.');

// 1. Причина неудачи пометки треда.
define('ERR_ARCH_THREAD_MARK', '(Ошибка) Невозможно пометить тред для архивирования. Причина: %s.');

// 1. Номер треда.
// 2. Число постов в треде.
// 3. Номер доски.
// 4. Количество постов доски после того как тред утонул.
define('INFO_THREAD_ARCHIVED', '(Информация) Утонул тред %s с числом постов %s с доски %s и теперь количество постов доски %s.');

// 1. Причина неудачи вычисления номера нового оп поста.
define('ERR_NEW_OPPOSTNUM_CALC', '(Ошибка) Невозможно вычислить номер нового оп поста. Причина: %s.');

// 1. Причина неудачи вычисления номера нового поста.
define('ERR_NEW_POSTNUM_CALC', '(Ошибка) Невозможно вычислить номер нового поста. Причина: %s.');

// 1. Причина неудачи создания нового оп поста.
define('ERR_NEW_OPPOST_CREATE', '(Ошибка) Невозможно создать новый оп пост. Причина: %s.');
//
//// 1. Причина неудачи создания нового оп поста.
define('ERR_NEW_POST_CREATE', '(Ошибка) Невозможно создать новый пост. Причина: %s.');

// 1. Причина неудачи создания нового оп поста.
define('ERR_NEW_THREAD_CREATE', '(Ошибка) Невозможно создать новый тред. Причина: %s.');

// 1. Причина неудачи установки номера.
define('ERR_SET_MAXPOST', '(Ошибка) Невозможно установить наибольший номер поста доски. Причина: %s.');

// 1. Причина неудачи начала транзакции.
define('ERR_TRAN_COMMIT_FAILED', '(Ошибка) Невозможно завершить транзакцию. Причина: %s.');
define('ERR_PAGE_BAD_FORMAT', '(Ошибка) Номер страницы имеет неверный формат.');
define('ERR_PAGE_BAD_RANGE', '(Ошибка) Страница находится вне допустимого диапазона.');

// 1. Причина неудачи подсчета.
define('ERR_THREADS_CALC_FALTURE', '(Ошибка) Невозможно подсчитать количество тредов просматриваемой доски. Причина: %s.');

// 1. Причина неудачи получения номеров.
define('ERR_THREADS_NUM', '(Ошибка) Невозможно получить номера тредов. Причина: %s');

// 1. Номер треда.
// 2. Причина неудачи подсчета.
define('ERR_THREAD_POSTS_CALC', '(Ошибка) Невозможно подсчитать количество постов треда %s для предпросмотра. Причина: %s.');

// 1. Номер треда.
define('ERR_THREAD_NO_POSTS', '(Ошибка) В треде %s нет ни одного поста.');

// 1. Номер треда.
// 2. Имя доски.
define('ERR_THREAD_BOARD_POSTS', '(Ошибка) В треде %s на доске %s нет ни одного поста.');

// 1. Номер треда.
// 2. Имя доски.
// 3. Причина неудачи получения постов.
define('ERR_GET_THREAD_POSTS', '(Ошибка) Невозможно получить посты для предпросмотра треда %s доски %s. Причина: %s.');

define('ERR_THREAD_NOT_SPECIFED', '(Ошибка) Не задан номер треда.');
define('ERR_THREAD_BAD_FORMAT', '(Ошибка) Номер треда имеет неверный формат.');

// 1. Номер треда.
// 2. Имя доски.
define('ERR_THREAD_NOT_FOUND', '(Ошибка) Треда с номером %s на доске %s не найдено.');

// 1. Номер треда.
// 2. Имя доски.
// 3. Причина неудачи поиска треда.
define('ERR_THREAD_EXIST_CHECK', '(Ошибка) Не удалось проверить существование треда с номером %s на доске %s. Прична: %s.');

define('ERR_NO_FILE_AND_TEXT', '(Ошибка) Файл не был загружен и пустой текст сообщения.');
define('ERR_POST_NOT_SPECIFED', '(Ошибка) Не задан номер поста.');
define('ERR_POST_BAD_FORMAT', '(Ошибка) Номер поста имеет неверный формат.');

// 1. Номер поста.
// 2. Имя доски.
define('ERR_POST_NOT_FOUND', '(Ошибка) Поста с номером %s на доске %s не существует.');

// 1. Номер поста.
// 2. Имя доски.
// 3. Причина неудачи поиска поста.
define('ERR_POST_EXIST_CHECK', '(Ошибка) Не удалось проверить существование поста с номером %s на доске %s. Прична: %s.');

define('WARN_NO_REMPASS', '(Предупреждение) Пароль на удаление не задан.');

// 1. Номер поста.
// 2. Имя доски.
// 3. Причина неудачи удаления поста.
define('ERR_POST_REMOVE', '(Ошибка) Не удалось удалить пост с номером %s с доски %s. Прична: %s.');

// 1. Номер треда.
// 2. Имя доски.
// 3. Причина неудачи удаления постов треда.
define('ERR_THREAD_POSTS_REMOVE', '(Ошибка) Не удалось удалить посты треда %s с доски %s. Прична: %s.');

// 1. Номер треда.
// 2. Имя доски.
// 3. Причина неудачи удаления треда.
define('ERR_THREAD_REMOVE', '(Ошибка) Не удалось удалить тред %s с доски %s. Прична: %s.');

define('ERR_WRONG_PASSWORD', '(Ошибка) Неверный пароль.');

// 1. Имя доски.
// 2. Причина неудачи поиска номеров.
define('ERR_GET_POSTS_THREADS', '(Ошибка) Не удалось получить номера постов и тредов доски %s. Прична: %s.');

// 1. Причина неудачи получения номеров.
define('ERR_BOARDS_POSTS_THREADS', '(Ошибка) Не удалось получить номера постов и тредов на досках. Прична: %s.');

// 1. Путь и имя файла.
define('ERR_FILE_HASH', '(Ошибка) Не удалось вычислить хеш файла %s.');

// 1. Причина неудачи получения данных.
define('ERR_USER_DATA', '(Ошибка) Невозможно получить данные пользователя. Прична: %s.');

// 1. Идентификатор сессии.
define('ERR_USER_SEARCH', '(Ошибка) Пользователя с сессией %s не найден.');

define('ERR_DB_CONNECT', '(Ошибка) Неудалось установить соединение с сервром БД :%s');

// 1. Причина неудачи выбора бд.
define('ERR_DB_SELECT', '(Ошибка) Неудалось выбрать базу данных. Причина: %s.');

// 1. Причина неудачи обновления SID.
define('ERR_UPDATE_USER_SID', '(Ошибка) Неудалось обновить идентификатор сессии пользователя. Причина: %s.');

define('ERR_UPLOAD_INI_SIZE', '(Ошибка) Загруженный файл превышает размер, заданный директивой upload_max_filesize в php.ini.');
define('ERR_UPLOAD_FORM_SIZE', '(Ошибка) Загруженный файл превышает размер, заданный директивой MAX_FILE_SIZE, определённой в HTML форме.');
define('ERR_UPLOAD_PARTIAL', '(Ошибка) Файл был загружен лишь частично.');
define('ERR_UPLOAD_NO_FILE', '(Ошибка) Файл не был загружен.');
define('ERR_UPLOAD_NO_TMP_DIR', '(Ошибка) Временная папка не найдена.');
define('ERR_UPLOAD_CANT_WRITE', '(Ошибка) Не удалось записать файл на диск.');
define('ERR_UPLOAD_EXTENSION', '(Ошибка) Загрузка файла прервана расширением.');

define('ERR_ALREADY_LOGGED_MESSAGE', "Вы уже вошли %s");
define('ERR_USEREXISTS', "Такой пользователь уже существует");
define('ERR_BADKEYWORD', "(Ошибка) Длинна ключего слова должна быть от 16 до 32 символов, допустимые значения: A-Za-z0-9_-");
define('ERR_BAD_REGISTERINFO', "(Ошибка) Значения настроек не верны.");

define('ERR_REGISTER_DATABASE', "Error. Searching in database falied by reason: %s");
define('ERR_REGISTER_UNREGISTER', "Error. Unregistration failed by reason: %s");

define('REG_UNREGISTERED', "Your registration data erased");
define('REG_SUCCESSFUL', "Registered");

define('LOGIN_ALREADY', "Вы уже вошли");
define('LOGIN_UPDATED', "Данные успешно обновлены");
define('LOGIN_SUCCESSFULY', "Вы успешно вошли.");
define('ERR_LOGIN_NOTREGISTERED', "Ошибка. Вы не зарегистрированы.");

// vim: set encoding=utf-8:
?>
