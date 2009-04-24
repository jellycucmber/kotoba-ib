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
 * Разбирает строку настроек $settings.
 * Вовзращает ассоциированный массив с 
 * настройками КЛЮЧ => ЗНАЧЕНИЕ.
 * 
 * Строка настроек состоит из пар КЛЮЧ:ЗНАЧЕНИЕ,
 * разделённых символом \n:
 * 
 * КЛЮЧ1:ЗНАЧЕНИЕ1\n
 * КЛЮЧ2:ЗНАЧЕНИЕ2\n
 * ...
 */
function get_settings($type, $settings)
{
    $h = array();
	$settings_array = explode("\n", $settings);

	for($i = 0; $i < count($settings_array); $i++)
	{
		$key = substr($settings_array[$i], 0, strpos($settings_array[$i], ':'));
		$value = substr($settings_array[$i], strpos($settings_array[$i], ':') + 1, strlen($settings_array[$i]));

		if($value != '')
			$h[$key] = $value;
	}

	return $h;
}

/*
 * Проверяет корректность значения $value
 * в зависимости от типа $type.
 * 
 * Например: значение типа "board" должно быть
 * строкой длины от 1 до 16 байт включительно,
 * которая состоит из символов a-zA-Z0-9_-.
 * 
 */
function CheckFormat($type, $value)
{
	switch($type)
    {
        case 'board':
			$length = strlen($value);

			if($length <= 16 && $length >= 1)
			{
				$value = RawUrlEncode($value);
				$length = strlen($value);

				if($length > 16 || (strpos($value, '%') !== false) || $length < 1)
					return false;
			}
			else
				return false;

			return $value;

        case 'thread':
        case 'post':
            $length = strlen($value);

			if($length <= 9 && $length >= 1)
			{
				$value = RawUrlEncode($value);
				$length = strlen($value);

				if($length > 9 || (strpos($value, '%') !== false) || $length < 1)
					return false;
			}
			else
				return false;

            return $value;
            
        case 'page':
            $length = strlen($value);

			if($length <= 2 && $length >= 1)
			{
				$value = RawUrlEncode($value);
				$length = strlen($value);

				if($length > 2 || (ctype_digit($value) == false) || $length < 1)
					return false;
			}
			else
				return false;
                
            return $value;

        case 'pass':
            $length = strlen($value);

			if($length <= 12 && $length >= 1)
			{
				$value = RawUrlEncode($value);
				$length = strlen($value);

				if($length > 12 || (strpos($value, '%') !== false) || $length < 1)
					return false;
			}
			else
				return false;
                
            return $value;

        default:
            return false;
    }
}

/*
 * Алиас для CheckFormat($type, $value);
 */
function check_format($type, $value)
{
    return CheckFormat($type, $value);
}
?>