<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Favicons
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$msg = '';
// save API key
$api_key = input('favicons_api_key');
if (!strlen($api_key)) {
	$api_key = false;
}
$setting = new OssnSite;
if (!$api_key) {
	$setting->deleteSetting('favicons_api_key');
} else {
	$setting->setSetting('favicons_api_key', $api_key);
	$msg = ossn_print('com_favicons_settings_api_key_saved');
	$done = true;
}

// save favicon master image
$favicons_dir = ossn_route()->www . 'favicons/';
$site  = new OssnFile;
$site->setFile('master_favicon');
$site->setExtension(array(
		'png',
));

if (isset($site->file['tmp_name'])) {
	if (!is_dir($favicons_dir)) {
		mkdir($favicons_dir, 0755);
	}
	if (is_dir($favicons_dir)) {
		$file = $site->file['tmp_name'];
		$size = filesize($file);
		if ($size > 0) {
			if ($size > 500000) { //500KB
				ossn_trigger_message(ossn_print('com_favicons_settings_master_image_too_large'), 'error');
				redirect(REF);
			}
			$image_info = getimagesize($file);
			if ($image_info['mime'] != 'image/png') {
				ossn_trigger_message(ossn_print('com_favicons_settings_master_image_wrong_type'), 'error');
				redirect(REF);
			}
			if ($image_info[0] != $image_info[1]) {
				ossn_trigger_message(ossn_print('com_favicons_settings_master_image_wrong_aspect_ratio'), 'error');
				redirect(REF);
			}
			if ($image_info[0] < 512) {
				ossn_trigger_message(ossn_print('com_favicons_settings_master_image_too_small'), 'error');
				redirect(REF);
			}
			$contents = file_get_contents($file);
			if (strlen($contents) > 0 && file_put_contents($favicons_dir . 'master_favicon.png', $contents)) {
				$cache  = ossn_site_settings('cache');
				if ($cache == false) {
					$done = true;
					if (strlen($msg)) {
						$msg = ossn_print('com_favicons_settings_master_image_and_key_saved');
					} else {
						$msg = ossn_print('com_favicons_settings_master_image_saved');
					}
				} else {
					$done = 2;
					if (strlen($msg)) {
						$msg = ossn_print('com_favicons_settings_master_image_and_key_saved');
					} else {
						$msg = ossn_print('com_favicons_settings_master_image_saved');
					}
				}								
			} else {
				$done = false;
				error_log('Favicons: Error master image upload failed');
				$msg = ossn_print('com_favicons_settings_master_image_upload_failed');
			}
		}
	} else {
		$done = false;
		error_log('Favicons: Error creating subdirectory for favicons');
		$msg  = ossn_print('com_favicons_settings_mkdir_failed');
	}
}	

if ($done === true) {
	ossn_trigger_message($msg);
	redirect(REF);	
} elseif($done == 2) {
	//redirect and flush cache
	ossn_trigger_message($msg);	
	$action = ossn_add_tokens_to_url("action/admin/cache/flush");
	redirect($action);	
} else {
	ossn_trigger_message($msg, 'error');
	redirect(REF);		
}
