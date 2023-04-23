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

define('CAPTCHA', ossn_route()->com . 'Captcha/');

/**
 * Captcha initialize
 * 
 * @return void
 */
function captcha_init() {
		ossn_register_page('captcha', 'captcha_page_handler');
		ossn_extend_view('forms/signup/before/submit', 'captcha/view');
		ossn_extend_view('forms/resetlogin/before/submit', 'captcha/view');
		ossn_extend_view('forms/Contact/contactform/before/submit', 'captcha/view');
		ossn_register_callback('action', 'load', 'captcha_check');
}
/**
 * Captcha the actions which you wanted to validate
 *
 * @return array
 */
function captcha_actions_validate() {
		return ossn_call_hook('captcha', 'actions', false, array(
				'user/register',
				'resetlogin',
				'Contact/contactmail'
		));
}
/**
 * Validate the captcha actions
 *
 * @param string $callback  The callback type
 * @param string $type      The callback type
 * @param array  $params    The option values
 * 
 * @return string
 */
function captcha_check($callback, $type, $params) {
		$captcha = input('captcha_text');
		$token   = input('captcha');
		if(isset($params['action']) && in_array($params['action'], captcha_actions_validate()) && !captcha_verify($captcha, $token)) {
				if($params['action'] == 'user/register') {
						header('Content-Type: application/json');
						echo json_encode(array(
								'dataerr' =>  ossn_print('captcha:error'),
						));
						exit;
				} else {
						ossn_trigger_message(ossn_print('captcha:error'), 'error');
						redirect(REF);
				}
		}
}
/**
 * Captcha image generate
 *
 * @return mixed
 */
function captcha_page_handler($args) {
		$token = $args[0];
		if(empty($token)) {
				ossn_error_page();
		}
		header("Content-type: image/jpeg");
		$captcha = captcha_generate($token);
		$n       = rand(1, 5);
		$image   = imagecreatefromjpeg(CAPTCHA . "images/bg$n.jpg");
		$colour  = imagecolorallocate($image, 0, 0, 0);
		imagettftext($image, 30, 0, 10, 30, $colour, CAPTCHA . "fonts/1.ttf", $captcha);
		imagejpeg($image);
		imagedestroy($image);
}
/**
 * Generate the captcha token
 *
 * @return string
 */
function captcha_generate_token() {
		return md5(ossn_generate_action_token('c') . rand());
}
/**
 * Generate a captcha based on the given seed value and length.
 *
 * @param string $seed_token
 * @return string
 */
function captcha_generate($seed_token) {
		return strtolower(substr(md5(ossn_generate_action_token('c') . $seed_token), 0, 5));
}

/**
 * Verify a captcha based on the input value entered by the user and the seed token passed.
 *
 * @param string $input_value
 * @param string $seed_token
 * @return bool
 */
function captcha_verify($input_value, $seed_token) {
		if(strcasecmp($input_value, captcha_generate($seed_token)) == 0) {
				return true;
		}
		
		return false;
}
ossn_register_callback('ossn', 'init', 'captcha_init');