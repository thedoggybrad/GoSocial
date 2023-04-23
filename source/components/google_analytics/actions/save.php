<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Google Analytics
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$component = new OssnComponents;

$ga_code = input('ga_code');

$settings = array(
	'ga_code' => $ga_code
);

if ($component->setSettings('google_analytics', $settings)) {
	ossn_trigger_message(ossn_print('ossn:admin:settings:saved'));
	redirect(REF);
} else {
	ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
	redirect(REF);
}
