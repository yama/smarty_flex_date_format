<?php

/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty flex_date_format modifier plugin
 * Type:     modifier
 * Name:     flex_date_format
 * Purpose:  format datestamps via strftime() or date()
 * Input:
 *          - string: input date string
 *          - format: strftime format for output
 *          - default_date: default date if $string is empty
 *
 * @link   https://github.com/yama/smarty_flex_date_format
 * @author Yamamoto
 *
 * @param string $string       input date string
 * @param string $format       strftime() format | date() format
 *
 * @return string | null
 */
function smarty_modifier_flex_date_format($string, $format = 'Y-m-d H:i:s')
{
	if(empty($string) || strpos($string,'0000-00-00')===0) {
		return null;
	}
	if (preg_match('@^[0-9]+$@', $string)) {
		$timestamp = $string;
	} else {
		$timestamp = strtotime($string);
		if (!$timestamp) {
			return null;
		}
	}

	if (strpos($format, '%') === false) {
		return date($format, $timestamp);
	}

	if(defined('PHP_WINDOWS_VERSION_MAJOR') && strpos($format, '%-')!==false) {
		$format = str_replace('%-', '%#', $format);
	}
	if (strpos($format, '%曜') !== false) {
		$days = explode(',', '日,月,日,水,木,金,土');
		$format = str_replace(
			'%曜',
			$days[date('w', $timestamp)],
			$format
		);
	}
	return strftime($format, $timestamp);
}

