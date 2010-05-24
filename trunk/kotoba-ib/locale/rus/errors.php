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
// Сообщения об ошибках на русском языке.

/**********
 * Разное *
 **********/

CommonException::$messages['GROUPS_ADD'] = 'Идентификатор новой группы не был получен.';

CommonException::$messages['TEXT_UNICODE'] = 'В тексте обнаружены не юникод символы.';

CommonException::$messages['SESSION_START'] = 'Не удалось начать сессию.';
CommonException::$messages['SETLOCALE'] = 'Неудача при установке локали.';
CommonException::$messages['LOG_FILE'] = 'Не удалось открыть или создать файл лога.';
CommonException::$messages['IMAGEMAGICK_FORMAT'] = 'Imagemagick не поддерживает этот формат файла.';
CommonException::$messages['GD_WRONG_FILETYPE'] = 'GD не поддерживает этот тип файла.';
CommonException::$messages['NO_IMG_LIB'] = 'Библиотеки работы с изображением отсутствуют или отключены (см. config.default).';
CommonException::$messages['CONVERT_PNG'] = 'Не удалось преобразовать изображение в формат png.';
CommonException::$messages['LINK_FAILED'] = 'Не удалось создать жесткую ссылку.';
CommonException::$messages['COPY_FAILED'] = 'Не удалось скопировать файл.';
CommonException::$messages['THREAD_ARCHIVED'] = 'Нить заархивирована.';
CommonException::$messages['ACL_RULE_EXCESS'] = 'Получена избыточная информация. Доска, нить и сообщение определяются однозначно своими идентификаторами. Читайте в res/notes.txt раздел, посвященный правилам.';
CommonException::$messages['ACL_RULE_CONFLICT'] = 'Конфликт разрешений для правила. Читайте в res/notes.txt раздел, посвященный правилам.';
CommonException::$messages['CAPTCHA'] = 'Код подтвержения не верен.';

/******************
 * Ошибки поиска. *
 ******************/

SearchException::$messages['NO_WORDS'] = 'Введите слова для поиска.';
SearchException::$messages['LONG_WORD'] = 'Одно из слов имеет длинну более 60 символов.';

/*****************************
 * Ошибки отсутствия данных. *
 *****************************/

NodataException::$messages['ACL_NOT_EXIST'] = 'В списке контроля доступа нет ни одного правила.';

NodataException::$messages['BOARD_NOT_FOUND'] = 'Доска не найдена.';

NodataException::$messages['GROUPS_NOT_EXIST'] = 'Не создана ни одна группа пользователей.';

NodataException::$messages['LANGUAGES_NOT_EXIST'] = 'Не задан ни один язык.';
// Параметры: идентификатор языка.
NodataException::$messages['LANGUAGE_NOT_EXIST'] = 'Языка с идентификатором %s не существует.';
NodataException::$messages['LANGUAGE_NAME_NOT_SPECIFED'] = 'Не задано имя языка.';

NodataException::$messages['POST_NOT_FOUND'] = 'Сообщение не найдено.';

NodataException::$messages['STYLESHEETS_NOT_EXIST'] = 'Не задан ни один стиль.';
// Параметры: идентификатор стиля оформления.
NodataException::$messages['STYLESHEET_NOT_EXIST'] = 'Стиля оформления с идентификатором %s не существует.';
NodataException::$messages['STYLESHEET_NAME_NOT_SPECIFED'] = 'Не задано имя стиля оформления.';

NodataException::$messages['THREAD_NOT_FOUND'] = 'Нить не найдена.';

NodataException::$messages['KEYWORD_NOT_SPECIFED'] = 'Ключевое слово не задано.';
NodataException::$messages['USER_WITHOUT_GROUP'] = 'Пользователь с заданным хешем ключевого слова не входит ни в одну группу.';

NodataException::$messages['THREADS_PER_PAGE_NOT_SPECIFED'] = 'Количество нитей на странице просмотра доски не задано.';
NodataException::$messages['POSTS_PER_THREAD_NOT_SPECIFED'] = 'Количество сообщений в нити на странице просмотра доски не задано.';
NodataException::$messages['LINES_PER_POST_NOT_SPECIFED'] = 'Количество строк в сообщении на странице просмотра доски не задано.';
NodataException::$messages['USER_ID_NOT_SPECIFED'] = 'Не задан идентификатор пользователя.';
NodataException::$messages['USERS_NOT_EXIST'] = 'Не создан ни один пользователь.';
NodataException::$messages['THREADS_EDIT'] = 'Нет нитей для редактирования настроек';
NodataException::$messages['EMPTY_MESSAGE'] = 'Файл не был загружен и пустой текст сообщения.';

/**************************
 * Ошибки формата данных. *
 **************************/

FormatException::$messages['BOARD_ID'] = 'Идентификатор доски имеет не верный формат.';
FormatException::$messages['BOARD_NAME'] = 'Имя доски имеет не верный формат.';
FormatException::$messages['BOARD_TITLE'] = 'Заголовок доски имеет не верный формат.';
FormatException::$messages['BOARD_BUMP_LIMIT'] = 'Специфичный для доски бамплимит имеет не верный формат.';
FormatException::$messages['BOARD_SAME_UPLOAD'] = 'Политика загрузки одинаковых файлов имеет не верный формат.';

FormatException::$messages['BANS_RANGE_BEG'] = 'Начало диапазона IP-адресов имеет не верный формат.';
FormatException::$messages['BANS_RANGE_END'] = 'Конец диапазона IP-адресов имеет не верный формат.';
FormatException::$messages['BANS_REASON'] = 'Причина блокировки имеет не верный формат.';
FormatException::$messages['BANS_UNTILL'] = 'Время истечения блокировки имеет не верный формат.';

FormatException::$messages['CATEGORY_ID'] = 'Идентификатор категории имеет не верный формат.';
FormatException::$messages['CATEGORY_NAME'] = 'Имя категории имеет не верный формат.';

FormatException::$messages['GROUP_ID'] = 'Идентификатор группы имеет не верный формат.';
FormatException::$messages['GROUP_NAME'] = 'Имя группы имеет не верный формат.';

FormatException::$messages['LANGUAGE_ID'] = 'Идентификатор языка имеет не верный формат.';
FormatException::$messages['LANGUAGE_CODE'] = 'ISO_639-2 код языка имеет не верный формат.';

FormatException::$messages['POPDOWN_HANDLER_ID'] = 'Идентификатор обработчика автоматического удаления нитей имеет не верный формат.';

FormatException::$messages['POST_ID'] = 'Идентификатор сообщения имеет не верный формат.';
FormatException::$messages['POST_NUMBER'] = 'Номер сообщения имеет не верный формат.';
FormatException::$messages['POST_PASSWORD'] = 'Пароль для удаления сообщения имеет не верный формат.';

FormatException::$messages['STYLESHEET_ID'] = 'Идентификатор стиля имеет не верный формат.';
FormatException::$messages['STYLESHEET_NAME'] = 'Имя файла стиля имеет не верный формат.';

FormatException::$messages['THREAD_BUMP_LIMIT'] = 'Специфичный для нити бамплимит имеет не верный формат.';
FormatException::$messages['THREAD_ID'] = 'Идентификатор нити имеет не верный формат.';
FormatException::$messages['THREAD_NUMBER'] = 'Номер оригинального сообщения имеет не верный формат.';

FormatException::$messages['UPLOAD_HANDLER_ID'] = 'Идентификатор обработчика загружаемых файлов имеет не верный формат.';
FormatException::$messages['UPLOAD_HANDLER_NAME'] = 'Имя фукнции обработчика загружаемых файлов имеет не верный формат.';

FormatException::$messages['UPLOAD_TYPE_EXTENSION'] = 'Расширение загружаемого файла имеет не верный формат.';
FormatException::$messages['UPLOAD_TYPE_ID'] = 'Идентификатор типа загружаемых файлов имеет не верный формат.';
FormatException::$messages['UPLOAD_TYPE_STORE_EXTENSION'] = 'Сохраняемое расширение загружаемого файла имеет не верный формат.';

FormatException::$messages['KEYWORD'] = 'Длина ключего слова должна быть от 16 до 32 символов, допустимые значения: латинские буквы, цифры, нижнее подчеркивание и дефис.';
// Параметры: минимальное число нитей, максимальное число нитей.
FormatException::$messages['THREADS_PER_PAGE'] = 'Число нитей на странице просмотра доски должно быть в пределах %s-%s.';
// Параметры: минимальное число сообщений, максимальное число сообщений.
FormatException::$messages['POSTS_PER_THREAD'] = 'Число сообщений в нити на странице просмотра доски должно быть в пределах %s-%s.';
// Параметры: минимальное число строк, максимальное число строк.
FormatException::$messages['LINES_PER_POST'] = 'Число строк в сообщении на странице просмотра доски должно быть в пределах %s-%s.';
FormatException::$messages['USER_ID'] = 'Идентификатор пользователя имеет не верный формат.';
FormatException::$messages['POPDOWN_HANDLER_NAME'] = 'Имя обработчика удаления нитей имеет не верный формат.';
FormatException::$messages['UPLOAD_TYPE_THUMBNAIL_IMAGE'] = 'Имя картинки для файла, не являющегося изображением имеет не верный формат.';
FormatException::$messages['PAGE'] = 'Номер страницы имеет не верный формат.';
FormatException::$messages['GOTO'] = 'Перенаправление при постинге имеет не верный формат.';

/**********************************************************************
 * Ошибки при регистрации, авторизации, идентификации и прав доступа. *
 **********************************************************************/

PermissionException::$messages['BOARD_NOT_ALLOWED'] = 'Нет прав для запрашиваемого действия с доской.';
PermissionException::$messages['THREAD_NOT_ALLOWED'] = 'Нет прав для запрашиваемого действия с нитью.';

PermissionException::$messages['USER_NOT_EXIST'] = 'Пользователя с заданным хешем ключевого слова не существует.';
PermissionException::$messages['NOT_ADMIN'] = 'Вы не являетесь администратором.';
PermissionException::$messages['NOT_MOD'] = 'Вы не являетесь модератором.';
PermissionException::$messages['GUEST'] = 'Гости не могут скрывать нити.';

/***************************************
 * Ошибки обмена данными с хранилищем. *
 ***************************************/

DataExchangeException::$messages['SAVE_USER_SETTINGS'] = 'Не удалось сохранить настройки пользователя.';

/**************************
 * Ошибки загрузки файла. *
 **************************/

UploadException::$messages['UPLOAD_ERR_INI_SIZE'] = 'Загруженный файл превышает размер, заданный директивой upload_max_filesize в php.ini.';
UploadException::$messages['UPLOAD_ERR_FORM_SIZE'] = 'Загруженный файл превышает размер, заданный директивой MAX_FILE_SIZE, определённой в HTML форме.';
UploadException::$messages['UPLOAD_ERR_PARTIAL'] = 'Файл был загружен лишь частично.';
UploadException::$messages['UPLOAD_ERR_NO_FILE'] = 'Файл не был загружен.';
UploadException::$messages['UPLOAD_ERR_NO_TMP_DIR'] = 'Временная папка не найдена.';
UploadException::$messages['UPLOAD_ERR_CANT_WRITE'] = 'Не удалось записать файл на диск.';
UploadException::$messages['UPLOAD_ERR_EXTENSION'] = 'Загрузка файла прервана расширением.';
UploadException::$messages['UPLOAD_SAVE'] = 'Файл не удалось сохранить.';
UploadException::$messages['UPLOAD_HASH'] = 'Не удалось вычислить хеш файла.';
UploadException::$messages['UPLOAD_FILETYPE_NOT_SUPPORTED'] = 'Тип файла не поодерживается.';
UploadException::$messages['UNKNOWN'] = 'Неизвестное вложение.';

/**************************
 * Нарушение ограничений. *
 **************************/

LimitException::$messages['MAX_NAME_LENGTH'] = 'Имя отправителя слишком длинное.';
LimitException::$messages['MAX_SUBJECT_LENGTH'] = 'Тема сообщения слишком длинная.';
LimitException::$messages['MAX_TEXT_LENGTH'] = 'Текст сообщения слишком длинный.';

LimitException::$messages['MIN_IMG_SIZE'] = 'Размер изображения слишком мал.';
LimitException::$messages['MIN_IMG_DIMENTIONS'] = 'Размеры изображения слишком малы.';
LimitException::$messages['MAX_SMALL_IMG_SIZE'] = 'Слишком большой размер в байтах для такого маленького изображения.';
LimitException::$messages['MAX_PAGE'] = 'Номер страницы слишком большой. Такой страницы не существует.';
LimitException::$messages['MAX_ANNOTATION'] = 'Аннотация слишком длинная.';
LimitException::$messages['MAX_FILE_LINK'] = 'Слишком длинная сслыка на файл, имя загружаемого файла или код видео.';
?>