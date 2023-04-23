<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

define('TimeZone', ossn_route()->com . 'TimeZone/');
function time_zone_init(){
		ossn_add_hook('user', 'default:fields', 'time_zone_only_loggedin');
		if(ossn_isLoggedin()){
			$user = ossn_loggedin_user();
			if(isset($user->timezone)){
					date_default_timezone_set($user->timezone);	
			}
			else {
					ossn_extend_view('ossn/site/head', 'js/timezone/account_settings');
			}
		}
		ossn_register_action('client/timezone', TimeZone . 'actions/client/timezone.php');
		ossn_extend_view('js/opensource.socialnetwork', 'js/timezone/create_account');
}
//https://stackoverflow.com/a/21211073
function __timezone_identifiers_list(){
    static $timezones = null;

    if ($timezones === null) {
        $timezones = [];
        $offsets = [];
        $now = new DateTime('now', new DateTimeZone('UTC'));

        foreach (DateTimeZone::listIdentifiers() as $timezone) {
            $now->setTimezone(new DateTimeZone($timezone));
            $offsets[] = $offset = $now->getOffset();
            $timezones[$timezone] = '(' . timezone_format_gmt_offset($offset) . ') ' . timezone_format_name($timezone);
        }

        array_multisort($offsets, $timezones);
    }

    return $timezones;
}
function timezone_format_gmt_offset($offset) {
    $hours = intval($offset / 3600);
    $minutes = abs(intval($offset % 3600 / 60));
    return 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');
}

function timezone_format_name($name) {
    $name = str_replace('/', ', ', $name);
    $name = str_replace('_', ' ', $name);
    $name = str_replace('St ', 'St. ', $name);
    return $name;
}
/**
 * Time Zone File
 *
 * @params string $hook Name of hook is user
 * @params string $type Type of hook is signup fields
 * @params array  $fields A list of signup fields
 *
 * @return array
 */
function time_zone_only_loggedin($hook, $type, $fields){
		$component = new OssnComponents();
		if($component->isActive('CustomFields')) {
			$label = true;
			$placeholder = ossn_print('timezone:select');
		} else {
			$label = ossn_print('timezone:select');
			$placeholder = '';
		}
		$zonel = __timezone_identifiers_list();
		$zones = $zonel;
		$extrafield = 	array(
			'class' => 'timezone-dropdown',
			'name' => 'timezone',
			'label' => $label,
			'placeholder' => $placeholder,
			'display_on_about_page' => false,
			'options' => $zones,
		);
		$fields['required']['dropdown'][] = $extrafield;
		return $fields;
}
ossn_register_callback('ossn', 'init', 'time_zone_init');
