<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Google Analytics
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__GOOGLE_ANALYTICS__', ossn_route()->com . 'google_analytics/');

function com_google_analytics_init()
{
	ossn_extend_view('ossn/site/head','google/pages/analytics');
	if (ossn_isAdminLoggedin()) {
		ossn_register_com_panel('google_analytics', 'settings');
		ossn_register_action('admin/google_analytics/settings', __GOOGLE_ANALYTICS__ . 'actions/save.php');
	}
}

ossn_register_callback('ossn', 'init', 'com_google_analytics_init');