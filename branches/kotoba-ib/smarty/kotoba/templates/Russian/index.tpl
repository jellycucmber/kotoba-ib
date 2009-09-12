{* Smarty *}
{*************************************
 * Этот файл является частью Kotoba. *
 * Файл license.txt содержит условия *
 * распространения Kotoba.           *
 *************************************
 *********************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************}
{*
Описание переменных:
    $DIR_PATH - путь от корня документов к директории, где хранится index.php (см. config.default).
	$STYLESHEET - стиль оформления.
    $boards - список досок.
*}
{include file='header.tpl' page_title='Главная страница' DIR_PATH=$DIR_PATH STYLESHEET=$STYLESHEET}
<p>Версия {$version}. Время модификации {$date}</p>
{if isset($boards_exist)}
Список досок: {include file='board_list.tpl' board_list=$boards DIR_PATH=$DIR_PATH}
{else}
<span class="error">Ошибка. Не создано ни одной доски.</span>
{/if}

<p><a href="{$DIR_PATH}/edit_settings.php">Мои настройки</a><br></p>
{if isset($adm_panel)}
<p>Панель администратора:<br>
{include file='adm_panel.tpl' DIR_PATH=$DIR_PATH}</p>
{/if}
{if isset($mod_panel)}
<p>Панель модератора:<br>
{include file='mod_panel.tpl' DIR_PATH=$DIR_PATH}</p>
{/if}
{include file='footer.tpl'}