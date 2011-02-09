<?php
/* *******************************
 * This file is part of Kotoba.  *
 * See license.txt for more info.*
 *********************************/

// Moderators main script.

require '../config.php';
require_once Config::ABS_PATH . '/lib/errors.php';
require_once Config::ABS_PATH . '/lib/logging.php';
require_once Config::ABS_PATH . '/lib/db.php';
require_once Config::ABS_PATH . '/lib/misc.php';

try {
    // Initialization.
    kotoba_session_start();
    if (Config::LANGUAGE != $_SESSION['language']) {
        require Config::ABS_PATH . "/locale/{$_SESSION['language']}/errors.php";
        require Config::ABS_PATH . "/locale/{$_SESSION['language']}/logging.php";
    }
    locale_setup();
    $smarty = new SmartyKotobaSetup();

    // Check if client banned.
    if ( ($ip = ip2long($_SERVER['REMOTE_ADDR'])) === false) {
        throw new CommonException(CommonException::$messages['REMOTE_ADDR']);
    }
    if ( ($ban = bans_check($ip)) !== false) {
        $smarty->assign('ip', $_SERVER['REMOTE_ADDR']);
        $smarty->assign('reason', $ban['reason']);
        session_destroy();
        DataExchange::releaseResources();
        die($smarty->fetch('banned.tpl'));
    }

    $is_admin = false;
    if (is_admin()) {
        $is_admin = true;
    } elseif (!is_mod()) {
        throw new PermissionException(PermissionException::$messages['NOT_ADMIN'] . ' ' . PermissionException::$messages['NOT_MOD']);
    }
    call_user_func(Logging::$f['MODERATE_USE']);

    $boards = ($is_admin == true) ? boards_get_all() : boards_get_moderatable($_SESSION['user']);
    $output = '';
    $smarty->assign('show_control', is_admin() || is_mod());
    $smarty->assign('is_admin', $is_admin);
    $smarty->assign('boards', $boards);
    $smarty->assign('ATTACHMENT_TYPE_FILE', Config::ATTACHMENT_TYPE_FILE);
    $smarty->assign('ATTACHMENT_TYPE_LINK', Config::ATTACHMENT_TYPE_LINK);
    $smarty->assign('ATTACHMENT_TYPE_VIDEO', Config::ATTACHMENT_TYPE_VIDEO);
    $smarty->assign('ATTACHMENT_TYPE_IMAGE', Config::ATTACHMENT_TYPE_IMAGE);
    $output .= $smarty->fetch('moderate_header.tpl');
    date_default_timezone_set(Config::DEFAULT_TIMEZONE);

    // Request posts. Apply defined filter to posts and show.
    if (isset($_POST['filter'])
            && isset($_POST['filter_board'])
            && isset($_POST['filter_date_time'])
            && isset($_POST['filter_number'])
            && isset($_POST['filter_ip'])
            && $_POST['filter_board'] != ''
            && ($_POST['filter_date_time'] != '' || $_POST['filter_number'] != '' ||  $_POST['filter_ip'] != '')) {

        // Board filter.
        if ($_POST['filter_board'] == 'all') {
            if ($is_admin) {
                $filter_boards = $boards;
            } else {
                throw new PermissionException(PermissionException::$messages['NOT_ADMIN']);
            }
        } else {
            $filter_boards = array();
            foreach ($boards as $board) {
                if ($_POST['filter_board'] == $board['id']) {
                    array_push($filter_boards, $board);
                    break;  // Only one yet.
                }
            }
        }

        // Date-Time filter.
        if ($_POST['filter_date_time'] != '') {
            $filter_date_time = date_format(date_create($_POST['filter_date_time']), 'U');

            // Filters posts whose datetime equal or greater than defined value.
            $fileter = function($post, $filter_date_time, $attachments_only) {
                date_default_timezone_set(Config::DEFAULT_TIMEZONE);
                if (date_format(date_create($post['date_time']), 'U') >= $filter_date_time) {
                    if (!$attachments_only || $attachments_only && $post['attachments_count'] > 0) {
                        return true;
                    }
                }
                return false;
            };
            $posts = posts_get_filtred_by_boards($filter_boards, $fileter, $filter_date_time, isset($_POST['attachments_only']));
        } elseif($_POST['filter_number'] != '') {
            $filter_number = posts_check_number($_POST['filter_number']);

            // Filters posts whose number equal or greater than defined value.
            $fileter = function($filter_number, $attachments_only, $post) {
                if ($post['number'] >= $filter_number) {
                    if (!$attachments_only || $attachments_only && $post['attachments_count'] > 0) {
                        return true;
                    }
                }
                return false;
            };
            $posts = posts_get_filtred_by_boards($filter_boards, $fileter, $filter_number, isset($_POST['attachments_only']));
        } elseif($_POST['filter_ip'] != '') {

            // Filters posts whose ip equal defined value.
            $fileter = function($filter_ip, $post) {
                if ($post['ip'] == $filter_ip) {
                    return true;
                }
                return false;
            };
            $posts = posts_get_filtred_by_boards($filter_boards, $fileter, ip2long($_POST['filter_ip']));
        }

        // Generate list of filtered posts.
        $posts_attachments = posts_attachments_get_by_posts($posts);
        $attachments = attachments_get_by_posts($posts);
        foreach ($posts as $post) {

            // Debug
            //var_dump($post['attachments_count']);

            // By default post have no attachments. This is fake field.
            $post['with_attachments'] = false;

            $post_attachments = array();
            foreach ($posts_attachments as $pa) {
                if ($pa['post'] == $post['id']) {
                    foreach ($attachments as $a) {
                        if ($a['attachment_type'] == $pa['attachment_type']) {
                            switch ($a['attachment_type']) {
                                case Config::ATTACHMENT_TYPE_FILE:
                                    if ($a['id'] == $pa['file']) {
                                        $a['file_link'] = Config::DIR_PATH . "/{$filter_boards[0]['name']}/other/{$a['name']}";
                                        $a['thumbnail_link'] = Config::DIR_PATH . "/img/{$a['thumbnail']}";
                                        $post['with_attachments'] = true;
                                        array_push($post_attachments, $a);
                                    }
                                    break;
                                case Config::ATTACHMENT_TYPE_IMAGE:
                                    if ($a['id'] == $pa['image']) {
                                        $a['image_link'] = Config::DIR_PATH . "/{$filter_boards[0]['name']}/img/{$a['name']}";
                                        $a['thumbnail_link'] = Config::DIR_PATH . "/{$filter_boards[0]['name']}/thumb/{$a['thumbnail']}";
                                        $post['with_attachments'] = true;
                                        array_push($post_attachments, $a);
                                    }
                                    break;
                                case Config::ATTACHMENT_TYPE_LINK:
                                    if ($a['id'] == $pa['link']) {
                                        $post['with_attachments'] = true;
                                        array_push($post_attachments, $a);
                                    }
                                    break;
                                case Config::ATTACHMENT_TYPE_VIDEO:
                                    if ($a['id'] == $pa['video']) {
                                        $smarty->assign('code', $a['code']);
                                        $a['video_link'] = $smarty->fetch('youtube.tpl');
                                        $post['with_attachments'] = true;
                                        array_push($post_attachments, $a);
                                    }
                                    break;
                                default:
                                    throw new CommonException('Not supported.');
                                    break;
                            }
                        }
                    }
                }
            }
            $post['ip'] = long2ip($post['ip']);
            $smarty->assign('post', $post);
            $smarty->assign('attachments', $post_attachments);
            $smarty->assign('board', $filter_boards[0]);
            $output .= $smarty->fetch('moderate_post.tpl');
        }
    }

    // Action on marked posts.
    if(isset($_POST['action'])
            && isset($_POST['ban_type'])
            && isset($_POST['del_type'])
            && ($_POST['ban_type'] != 'none' || $_POST['del_type'] != 'none')) {

        $posts = posts_get_by_boards($boards);
        foreach ($posts as $post) {

            // If post was marked do action.
            if (isset($_POST["mark_{$post['id']}"])) {

                // Ban poster?
                switch ($_POST['ban_type']) {
                    case 'simple':

                        // Ban for 1 hour by default.
                        bans_add($post['ip'], $post['ip'], '', date('Y-m-d H:i:s', time() + (60 * 60)));
                        break;
                    case 'hard':
                        hard_ban_add($post['ip'], $post['ip']);
                        break;
                }

                // Remove post(s) or attachment?
                switch ($_POST['del_type']) {
                    case 'post':
                        posts_delete($post['id']);
                        break;
                    case 'file':
                        posts_attachments_delete_by_post($post['id']);
                        break;
                    case 'last':

                        // Delete all posts posted from this IP-address in last hour.
                        posts_delete_last($post['id'], date(Config::DATETIME_FORMAT, time() - (60 * 60)));
                        break;
                }
            }
        }
    }

    $output .= $smarty->fetch('moderate_footer.tpl');
    echo $output;

    // Cleanup.
    DataExchange::releaseResources();
    Logging::close_log();

    exit(0);
} catch(Exception $e) {
    $smarty->assign('msg', $e->__toString());
    DataExchange::releaseResources();
    die($smarty->fetch('error.tpl'));
}
?>
