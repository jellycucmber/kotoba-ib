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
if(!class_exists('Logmsgs')) {
	class Logmsgs
	{
		static $messages;
		private static $stat_file = null;
		public static function open_logfile($path)
		{
			if(self::$stat_file == null)
			{
				if((self::$stat_file = @fopen($path, 'a')) === false)
					die('Ошибка. Не удалось открыть или создать файл статистики.');
			}
			return self::$stat_file;
		}
		public static function close_logfile()
		{
			fclose(self::$stat_file);
		}
	}
}
/********************************************
 * Активность администраторов и модераторов *
 ********************************************/
/* Параметры: название фукнционала, id пользователя, ip адрес. */
Logmsgs::$messages['ADMIN_FUNCTIONS'] = 'Задействован фукнционал для администраторов "%s". Пользователь %s IP %s';
?>