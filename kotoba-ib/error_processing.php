<?php
/* error_processing: module for show errors from other Kotoba resources
 */

@require_once('common.php');

/*
 * kotoba_error: show error message and exit
 * returns nothing
 * arguments:
 * $error_message is custom error message
 */
function kotoba_error($error_message) {
	$smarty = new SmartyKotobaSetup();
	if(isset($error_message) || strlen($error_message) > 0) { //error message not empty
		$smarty->assign('error_message', $error_message);
	}
	else {
		$smarty->assign('error_message', 'General Protection Fault');
	}

	die($smarty->fetch('error.tpl'));
}
?>