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
 * @param string $default_date default date if $string is empty
 *
 * @return string | null
 * @uses   smarty_make_timestamp()
 */
function smarty_modifier_flex_date_format($string, $format = null, $default_date = '')
{
	if(empty($string) || strpos($string,'0000-00-00')===0) {
		return null;
	}
	if (!empty($string) && preg_match('@^[0-9]+$@', $string)) {
		$timestamp = $string;
	} else {
		$timestamp = strtotime($string);
	}

	if (strpos($format, '%') === false) {
		return date($format, $timestamp);
	}

	if (strpos($format, '%曜') !== false) {
		$days = explode(',', '日,月,日,水,木,金,土');
		$day = date('w', $timestamp);
		return strftime(
			str_replace('%曜', $days[$day], $format),
			$timestamp
		);
	}
	return strftime($format, $timestamp);
}

