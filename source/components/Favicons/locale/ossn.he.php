<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Favicons
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

ossn_register_languages('he', array(
	// admin backend
	'favicons' => 'Favicons', // Configure menu entry - don't translate

	'com_favicons_enabling_service_worker_failure' => 'Service worker enabling impossible',
	'com_favicons_settings_workflow' => '
		In order to create a set of favicons for your site you have to: <br><br>
		1. Request an API key<br>
		2. Upload an image to generate the favicons from<br>
		3. Click "Save" to save your settings<br>
		4. Click "Create favicons"<br>
		5. Click "Install favicons"<br>',
	'com_favicons_settings_api_key' => 'API Key',
	'com_favicons_settings_api_key_instruction' => 'Request your key from %s and enter it below',
	'com_favicons_settings_api_key_saved' => 'API key successfully saved',
	'com_favicons_settings_master_image' => 'Master Image',
	'com_favicons_settings_master_image_instruction' => 'with a preview of the generated favicons - important parts should be placed within the unmasked area',
	'com_favicons_settings_master_image_instruction_upload' => 'Upload a new master image (a square PNG image of 512 x 512 pixel minimum)',
	'com_favicons_settings_master_image_too_large' => 'The image must not be larger than 500 kB',
	'com_favicons_settings_master_image_wrong_type' => 'The image has to be a PNG file',
	'com_favicons_settings_master_image_wrong_aspect_ratio' => 'The image has to be a SQUARE image, not a rectangle',
	'com_favicons_settings_master_image_too_small' => 'The minimum image width and height has to be 512 pixel',
	'com_favicons_settings_master_image_and_key_saved' => 'API key and favicon master image successfully saved',
	'com_favicons_settings_master_image_saved' => 'Favicon master image successfully saved',
	'com_favicons_settings_master_image_upload_failed' => 'Favicon master image upload failed',
	'com_favicons_settings_mkdir_failed' => 'Error creating subdirectory for favicons',
	'com_favicons_settings_favicon_generator' => 'Favicon Generator',
	'com_favicons_settings_favicon_generator_instruction' => "
		After clicking the <b>Create favicons</b> button RealFaviconGenerator.net will create a set of favicons derived from
		your master image accompanied by the necessary HTML header tags to make these icons accessable. Be patient and don't close this page
		before a Success message appears below.",
	'com_favicons_settings_create_favicons' => 'Create favicons',
	'com_favicons_settings_preview' => 'Preview',
	'com_favicons_settings_installation' => 'Installation',
	'com_favicons_settings_installation_instruction' => "
		If you're satisfied with the resulting preview above click <b>Install favicons</b> - 
		otherwise upload another master image and repeat the creation process.",
	'com_favicons_settings_install_favicons' => 'Install favicons',
	'com_favicons_settings_files_location' => 'Files location',
	'com_favicons_settings_files_location_instruction' => 'Your favicon files are located in',
	'com_favicons_settings_files_location_instruction_migrating' => '
		In case of migrating your site or preparing an Ossn upgrade, make a backup of this directory first and move it back
		in place afterwards in order to avoid recreating the favicons again.',
	'com_favicons_settings_error_session_timeout' => 'Error: Session timeout or network problem',
	
	'com_favicons_create_error_getting_post_data' => 'Error: Getting post data',
	'com_favicons_create_processing_generating_icons' => 'Generating icons... this may take about a minute or even more depending on your network',
	'com_favicons_create_error_no_response' => 'Error: No response from RealFaviconGenerator.net',
	'com_favicons_create_error_api_request' => 'Error: API request %s',
	'com_favicons_create_processing_processing_archive' => 'Processing favicon archive...',
	'com_favicons_create_error_processing_archive' => 'Error: Processing favicon archive %s',
	'com_favicons_create_processing_success' => 'Success',
	
	'com_favicons_install_processing_opening_download_dir' => 'Opening download directory',
	'com_favicons_install_processing_copying_package' => 'Copying favicons package',
	'com_favicons_install_error_copying_package' => 'Error: Copying favicons package',
	'com_favicons_install_processing_updating_manifest' => 'Updating manifest file',
	'com_favicons_install_processing_success' => 'Success',
	
));