<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Country Selector
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$component = new OssnComponents;
$modes = array(
		'off',
		'on'
);
$auto_locator  = input('auto_locator');
if (in_array($auto_locator, $modes)) {
	$cache  = ossn_site_settings('cache');
	if ($cache == false) {
		$done = true;
	} else {
		$done = 2;
	}								
	if ($component->setSettings('CountrySelector', array('auto_locator' => $auto_locator))) {
		if ($done === true){
			ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
			redirect(REF);
		} elseif($done == 2){
			//redirect and flush cache
			ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));	
			$action = ossn_add_tokens_to_url("action/admin/cache/flush");
			redirect($action);	
		} else {
			ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
			redirect(REF);		
		}
	}
}
ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
redirect(REF);
