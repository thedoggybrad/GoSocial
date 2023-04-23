<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Favicons
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
require_once __FAVICONS__ . 'vendors/rfg_api_response.php';

// some vars to be set by Ossn
$site_url = ossn_site_url();
$site_name = ossn_site_settings('site_name'); 
$site_app = 'Ossn App';
$site_download_dir = ossn_get_userdata("tmp/Favicons");

// Receive the RAW post data.
$postdata = trim(file_get_contents("php://input"));
if ($postdata == NULL) {
	error_log('Favicons: Error getting post data');
	echo "\t" . ossn_print('com_favicons_create_error_getting_post_data');
	ob_flush();
	flush();
	sleep(1);
	exit;
}
$response = json_decode($postdata, true);
$api_key = $response['favicon_generation']['api_key'];
$versioning_param_value = $response['favicon_generation']['callback']['custom_parameter'];
$master_picture_url = $response['favicon_generation']['master_picture']['url'];

// API request
$url = 'https://realfavicongenerator.net/api/favicon';
$request =
'{
	"favicon_generation": {
		"api_key": "' . $api_key . '",
		"master_picture": {
			"type": "url",
			"url": "' . $master_picture_url . '"
		},
		"files_location": {
			"type": "path",
			"path": "' . $site_url . 'favicons"
		},
		"favicon_design": {
			"desktop_browser": {},
			"ios": {
				"picture_aspect": "no_change",
				"startup_image": {
					"master_picture": {
						"type": "url",
						"url": "' . $master_picture_url . '"
					},
					"background_color": "#ffffff"
				},
				"assets": {
					"ios6_and_prior_icons": false,
					"ios7_and_later_icons": true,
					"precomposed_icons": false,
					"declare_only_default_icon": true
				}
			},
			"windows": {
				"picture_aspect": "no_change",
				"background_color": "#2b5797",
				"assets": {
					"windows_80_ie_10_tile": true,
					"windows_10_ie_11_edge_tiles": {
						"small": false,
						"medium": true,
						"big": true,
						"rectangle": false
					}
				}
			},
			"firefox_app": {
				"picture_aspect": "circle",
				"keep_picture_in_circle": "true",
				"circle_inner_margin": "5",
				"background_color": "#ffffff",
				"manifest": {
					"app_name": "' . $site_name . '",
					"app_description": "' . $site_app . '",
					"developer_name": "Opensource-Socialnetwork",
					"developer_url": "https://www.opensource-socialnetwork.org"
				}
			},
			"android_chrome": {
				"picture_aspect": "shadow",
				"manifest": {
					"name": "' . $site_name . '",
					"display": "standalone",
					"orientation": "portrait",
					"start_url": "' . $site_url . '",
					"existing_manifest": "{\"name\": \"' . $site_name . '\"}"
				},
				"assets": {
					"legacy_icon": true,
					"low_resolution_icons": false
				},
				"theme_color": "#ffffff"
			},
			"safari_pinned_tab": {
				"picture_aspect": "black_and_white",
				"threshold": 60,
				"theme_color": "#136497"
			},
			"coast": {
				"picture_aspect": "background_and_margin",
				"background_color": "#136497",
				"margin": "12%"
			},
			"open_graph": {
				"picture_aspect": "background_and_margin",
				"background_color": "#136497",
				"margin": "12%",
				"ratio": "1.91:1"
			},
			"yandex_browser": {
				"background_color": "background_color",
				"manifest": {
					"show_title": true,
					"version": "1.0"
				}
			}
		},
		"settings": {
			"compression": "3",
			"scaling_algorithm": "Mitchell",
			"error_on_image_too_small": true,
			"readme_file": true,
			"html_code_file": true,
			"use_path_as_is": false
		},
		"versioning": {
			"param_name": "ver",
			"param_value": "' . $versioning_param_value .'"
		}
	}
}';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

if ($result === false) {
	error_log('Favicons: Error no response from RealFaviconGenerator');
	echo "\t" . ossn_print('com_favicons_create_error_no_response');
	ob_flush();
	flush();
	sleep(1);
	exit;
}

$result_msg = json_decode($result, true);
if ($result_msg['favicon_generation_result']['result']['status'] == 'error') {
	error_log('Favicons: Error API request ' . $result_msg['favicon_generation_result']['result']['error_message']);
	echo "\t" . ossn_print('com_favicons_create_error_api_request', array($result_msg['favicon_generation_result']['result']['error_message']));
	ob_flush();
	flush();
	sleep(1);
	exit;
}

// result seems valid, so 
// download stuff from RealFaviconGenerator.net
// unpack it in data_dir/tmp/Favicons
// copy preview to Ossn root

echo ossn_print('com_favicons_create_processing_processing_archive');
ob_flush();
flush();
sleep(1);

$download = new RealFaviconGeneratorApiResponse;
try {
	$download->RFGApiResponse($result);
	$download->downloadAndUnpack($site_download_dir);
}
catch(Exception $e) {
	$msg = $e->getMessage();
	error_log('Favicons: Error Processing Favicon archive' . $msg);
	echo "\t" . ossn_print('com_favicons_create_error_processing_archive', array($msg));
	ob_flush();
	flush();
	sleep(1);
	exit;
}

echo ossn_print('com_favicons_create_processing_success');
ob_flush();
flush();
exit;