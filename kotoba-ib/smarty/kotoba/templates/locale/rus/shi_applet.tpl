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
Код апплета shi.

Описание переменных:
    $DIR_PATH - путь от корня документов к директории, где хранится index.php (см. config.default).
    $STYLESHEET - стиль оформления (см. config.default).
    $image_width - ширина холста.
    $image_height - высота холста.
    $thumbnail_width - ширина уменьшенной копии рисунка.
    $thumbnail_height - высота уменьшенной копии рисунка.
    $tools - тип набора инструментов (pro, normal).
    $ip - IP-адрес художника.
    $time - время начала рисования.
*}
<html>
<head>
    <title>Shi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="{$DIR_PATH}/css/global.css">
    <link rel="stylesheet" type="text/css" href="{$DIR_PATH}/css/{$STYLESHEET}">
</head>
<body>
<script type="text/javascript" src="{$DIR_PATH}/shi/sp.js"></script>
<applet code="c.ShiPainter.class" name="paintbbs" archive="{$DIR_PATH}/shi/spainter_all.jar,{$DIR_PATH}/shi/res/normal.zip" width="100%" height="100%">
    <param name="image_width" value="{$image_width}" />
    <param name="image_height" value="{$image_height}" />
    <param name="thumbnail_type" value="animation">
    <param name="thumbnail_type2" value="png">
    <param name="thumbnail_width" value="{$thumbnail_width}">
    <param name="thumbnail_height" value="{$thumbnail_height}">
    <param name="dir_resource" value="{$DIR_PATH}/shi/res/" />
    <param name="tt.zip" value="tt.zip" />
    <param name="res.zip" value="res_{$tools}.zip" />
    <param name="tools" value="{$tools}" />
    <param name="layer_count" value="3" />
    <param name="url_save" value="{$DIR_PATH}/lib/shi_save.php" />
    <param name="url_exit" value="{$DIR_PATH}/lib/shi_exit.php?ip={$ip}&time={$time}&painter=shi_{$tools}" />
    <param name="send_header" value="{$ip}" />
</applet>
{include file='footer.tpl'}