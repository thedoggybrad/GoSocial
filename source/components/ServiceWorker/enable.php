<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Service Worker
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

global $Ossn;
if (substr($Ossn->url, 0, 8) != 'https://') {
	error_log('ServiceWorker: Error missing https protocol');
	ossn_load_available_languages();
	ossn_trigger_message(ossn_print('com_serviceworker_unsupported_protocol'), 'error');
	redirect(REF);
}
	
if (!copy(ossn_route()->com . 'ServiceWorker/service-worker/favicon-sw.js', ossn_route()->www . 'favicon-sw.js')) { 
	error_log('ServiceWorker: Error installing service worker');
	ossn_load_available_languages();
	ossn_trigger_message(ossn_print('com_serviceworker_installing_service_worker_failure'), 'error');
	redirect(REF);
}

if (!file_exists(ossn_route()->www . 'favicons/site.webmanifest')) {
	ossn_load_available_languages();
	ossn_trigger_message(ossn_print('com_serviceworker_manifest_file_missing'), 'error');
	redirect(REF);
}
