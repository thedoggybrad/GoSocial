<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Favicons
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
// some vars to be set by Ossn
$site_url  = ossn_site_url();
$site_path = ossn_route()->www;
$package_dir = ossn_get_userdata('tmp/Favicons/') . 'favicon_package/';

echo ossn_print('com_favicons_install_processing_opening_download_dir');
ob_flush();
flush();
sleep(2);

// copy files from data_dir to site
com_favicon_copy($package_dir, $site_path . 'favicons');
echo ossn_print('com_favicons_install_processing_copying_package');
ob_flush();
flush();
sleep(2);

// enhance manifest file
$manifest = $site_path . 'favicons/site.webmanifest';
if (!file_exists($manifest)) {
	error_log('Favicons: Error copying favicons package');
	echo "\t" . ossn_print('com_favicons_install_error_copying_package');
	ob_flush();
	flush();
	sleep(1);
	exit;
} else {
	$content = file_get_contents($manifest, true);
	// add maskable option
	$replace = "image/png\",\n\t\t\t\"purpose\": \"any maskable\"\n";
	$update_a = str_replace("image/png\"\n", $replace, $content);
	// add service worker url
	$replace = "any\",\n    \"scope\": \"" . $site_url . "\",\n    \"serviceworker\": {\n        \"src\": \"" . $site_url . "favicon-sw.js\"\n    }\n";
	$update_b = str_replace("portrait\"\n", $replace, $update_a);
	file_put_contents($manifest, $update_b);
	echo ossn_print('com_favicons_install_processing_updating_manifest');
	ob_flush();
	flush();
	sleep(2);
}

echo ossn_print('com_favicons_install_processing_success');
ob_flush();
flush();
$cache  = ossn_site_settings('cache');
if ($cache) {
	$action = ossn_add_tokens_to_url("action/admin/cache/flush");
	redirect($action);	
}
exit;

function com_favicon_copy($src, $dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while (false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                com_favicon_copy($src . '/' . $file, $dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file, $dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 