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

/*
 * Объявляя переменные, зависящие от параметров, обязательно указывайте в комментариях, что значат параметры.
 * Описывайте параметры в том порядке, в котором они встречаются в значении константы.
 */

if(!class_exists('Errmsgs')) {
	class Errmsgs { static $messages; }
}

/*******************************************
 * Регистрация, Авторизация, Идентификация *
 *******************************************/

Errmsgs::$messages['USER_NOT_EXIST'] = 'Пользователя с таким ключевым словом не существует или он не входит ни в одну группу.';
Errmsgs::$messages['NOT_ADMIN'] = 'Вы не являетесь администратром.';

/*********************
 * Отсутствие данных *
 *********************/

Errmsgs::$messages['BOARDS_NOT_EXIST'] = 'Не создано ни одной доски.';
Errmsgs::$messages['STYLESHEETS_NOT_EXIST'] = 'Не задан ни один стиль оформления.';
Errmsgs::$messages['LANGUAGES_NOT_EXIST'] = 'Не задан ни один язык.';
/* Параметры: имя доски. */
Errmsgs::$messages['BOARD_NOT_FOUND'] = 'Доски с именем %s не существует.';
/* Параметры: имя группы. */
Errmsgs::$messages['GROUP_NOT_FOUND'] = 'Группы с именем %s не существует.';

/******************
 * Ошибки формата *
 ******************/

Errmsgs::$messages['KEYWORD'] = 'Длина ключего слова должна быть от 16 до 32 символов, допустимые значения: A-Za-z0-9_-.';
/* Параметры: минимальное число нитей, максимальное число нитей. */
Errmsgs::$messages['THREADSPERPAGE'] = 'Число нитей на странице предпросмотра доски должно быть в пределах %s-%s.';
/* Параметры: минимальное число сообщений, максимальное число сообщений. */
Errmsgs::$messages['POSTSPERTHREAD'] = 'Число сообщений в нити на странице предпросмотра доски должно быть в пределах %s-%s.';
/* Параметры: минимальное число строк, максимальное число строк. */
Errmsgs::$messages['LINESPERPOST'] = 'Число строк в сообщении на странице предпросмотра доски должно быть в пределах %s-%s.';
Errmsgs::$messages['STYLESHEET'] = 'Прекрасно, что вы умеете писать скрипты, но выберите стиль оформления из списка.';
Errmsgs::$messages['LANGUAGE'] = 'Прекрасно, что вы умеете писать скрипты, но выберите язык из списка.';
Errmsgs::$messages['GROUP_NAME'] = 'Имя группы должно быть длиной от 1 до 50 символов, состоять только из латинских букв, цифр, знака подчеркивания и тире.';
Errmsgs::$messages['USER_ID'] = 'Идентификатор пользователя должен быть целым числом.';
Errmsgs::$messages['GROUP_ID'] = 'Идентификатор группы должен быть целым числом.';
Errmsgs::$messages['BOARD_NAME'] = 'Имя доски имеет неверный формат.';
Errmsgs::$messages['THREAD_NUM'] = 'Номер треда имеет неверный формат.';
Errmsgs::$messages['POST_NUM'] = 'Номер поста имеет неверный формат.';
Errmsgs::$messages['LANGUAGE_NAME'] = 'Имя языка имеет неверный формат. Оно должно быть длино от 1 до 50 символов, состоять только из латинских букв, цифр, знака подчеркивания и тире.';
Errmsgs::$messages['STYLESHEET_NAME'] = 'Имя стиля оформления имеет неверный формат. Оно должно быть длино от 1 до 50 символов, состоять только из латинских букв, цифр, знака подчеркивания и тире.';
Errmsgs::$messages['CATEGORY_NAME'] = 'Имя категории досок имеет неверный формат. Оно должно быть длино от 1 до 50 символов, состоять только из латинских букв, цифр, знака подчеркивания и тире.';

/*****************************************
 * Ошибки обмена данными с базой данных. *
 *****************************************/

Errmsgs::$messages['SAVE_USER_SETTINGS'] = 'Не удалось сохранить настройки пользователя.';

/**********
 * Разное *
 **********/

Errmsgs::$messages['UNKNOWN'] = 'Неизвестная ошибка.';
Errmsgs::$messages['SETLOCALE'] = 'Неудача при установке локали.';
Errmsgs::$messages['SESSION_START'] = 'Не удалось начать сессию.';
?>