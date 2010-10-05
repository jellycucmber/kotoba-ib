<?php
/* ***********************************
 * Этот файл является частью Kotoba. *
 * Файл license.txt содержит условия *
 * распространения Kotoba.           *
 *************************************/
/* *******************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************/

// Скрипт апплета shi.

require_once '../config.php';
require_once Config::ABS_PATH . '/lib/errors.php';
require Config::ABS_PATH . '/locale/' . Config::LANGUAGE . '/errors.php';
require_once Config::ABS_PATH . '/lib/db.php';
require_once Config::ABS_PATH . '/lib/misc.php';

try {
    // Initialization.
    kotoba_session_start();
    locale_setup();
    $smarty = new SmartyKotobaSetup($_SESSION['language'], $_SESSION['stylesheet']);

    // Check if remote host was banned.
    if (($ip = ip2long($_SERVER['REMOTE_ADDR'])) === false) {
        throw new CommonException(CommonException::$messages['REMOTE_ADDR']);
    }
    if (($ban = bans_check($ip)) !== false) {
        $smarty->assign('ip', $_SERVER['REMOTE_ADDR']);
        $smarty->assign('reason', $ban['reason']);
        session_destroy();
        DataExchange::releaseResources();
        die($smarty->fetch('banned.tpl'));
    }

    // Check parameters.
    if (!isset($_POST['x']) || !ctype_digit($_POST['x']) || strlen($_POST['x']) > 3) {
        throw new Exception('x');
    }
    if (!isset($_POST['y']) || !ctype_digit($_POST['y']) || strlen($_POST['y']) > 3) {
        throw new Exception('y');
    }
    if ($_POST['painter'] == 'shi_pro') {
        $tools = 'pro';
    } elseif ($_POST['painter'] == 'shi_normal') {
        $tools = 'normal';
    }
    date_default_timezone_set('Europe/Moscow');

    // Cleanup.
    DataExchange::releaseResources();

    $smarty->assign('image_width', $_POST['x']);
    $smarty->assign('image_height', $_POST['y']);
    $smarty->assign('thumbnail_width', Config::THUMBNAIL_WIDTH);
    $smarty->assign('thumbnail_height', Config::THUMBNAIL_HEIGHT);
    $smarty->assign('tools', $tools);
    $smarty->assign('ip', $_SERVER['REMOTE_ADDR']);
    $smarty->assign('time', time());
    $smarty->display('shi_applet.tpl');

    exit(0);
} catch (Exception $e) {
    $smarty->assign('msg', $e->__toString());
    DataExchange::releaseResources();
    die($smarty->fetch('error.tpl'));
}
/*
    echo "<html>
    <head>
        <style type=\"text/css\">
            body { background: #9999BB; font-family: sans-serif; }
            input,textarea { background-color:#CFCFFF; font-size: small; }
            table.nospace { border-collapse:collapse; }
            table.nospace tr td { margin:0px; }
            .menu { background-color:#CFCFFF; border: 1px solid #666666; padding: 2px; margin-bottom: 2px; }
        </style>
    </head>
    <body>
    <!-- Thanks iichan.ru/o/ -->
    <script type=\"text/javascript\" src=\"/~sorc/shi/sp.js\"></script>
    <applet code=\"c.ShiPainter.class\" name=\"paintbbs\" archive=\"/~sorc/shi/spainter_all.jar,/~sorc/shi/res/normal.zip\" width=\"100%\" height=\"100%\">
        <param name=\"image_width\" value=\"{$_POST['x']}\" />
        <param name=\"image_height\" value=\"{$_POST['y']}\" />
        <param name=\"thumbnail_type\" value=\"animation\">
        <param name=\"thumbnail_type2\" value=\"png\">
        <param name=\"thumbnail_width\" value=\"200\">
        <param name=\"thumbnail_height\" value=\"200\">
        <param name=\"dir_resource\" value=\"/~sorc/shi/res/\" />
        <param name=\"tt.zip\" value=\"tt.zip\" />
        <param name=\"res.zip\" value=\"res_$tools.zip\" />
        <param name=\"tools\" value=\"$tools\" />
        <param name=\"layer_count\" value=\"3\" />
        <param name=\"url_save\" value=\"/~sorc/lib/shi_save.php\" />
        <param name=\"url_exit\" value=\"/~sorc/test_s/EmptyPHP_3.php?ip={$_SERVER['REMOTE_ADDR']}&time={$time}&painter=shi_$tools\" />
        <param name=\"send_header\" value=\"{$_SERVER['REMOTE_ADDR']}\" />
    </applet>
    </body>
    </html>";*/
?>