<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Service Worker
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__SERVICE_WORKER__', ossn_route()->com . 'ServiceWorker/');

if (!file_exists(ossn_route()->www . 'favicon-sw.js')) {
	$com = new OssnComponents;
	$com->DISABLE('ServiceWorker');
	ossn_trigger_message(ossn_print('com_serviceworker_enabling_service_worker_failure'), 'error');
	redirect(REF);
}

function com_serviceworker_init()
{
	ossn_extend_view('ossn/site/head', 'com_serviceworker_enable_service_worker');
	ossn_extend_view('ossn/admin/head', 'com_serviceworker_enable_service_worker');
	if (ossn_isLoggedin()) {
		ossn_add_hook('required', 'components', 'com_serviceworker_asure_requirements');
	}
}

function com_serviceworker_asure_requirements($hook, $type, $return, $params)
{
	$return[] = 'Favicons';
	return $return;
}

function com_serviceworker_enable_service_worker()
{
	$sw_file = ossn_route()->www . 'favicon-sw.js';
	$sw_url  = ossn_site_url() . 'favicon-sw.js';
	if (file_exists($sw_file)) {
		$script = "\n<script>if('serviceWorker' in navigator) { navigator.serviceWorker.register(\"" . $sw_url . "\").then(function() { /* console.log('Service Worker Registered'); */ });}</script>\n";
		return $script;
	}
}

ossn_register_callback('ossn', 'init', 'com_serviceworker_init');
