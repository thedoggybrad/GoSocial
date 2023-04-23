<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Textarea Support
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

 
if(!file_exists(ossn_route()->www . 'vendors/tinymce/themes/mobile/theme.min.js')) {
	$textarea = new OssnComponents;
	$textarea->DISABLE('TextareaSupport');
	error_log('TextareaSupport: Error version mismatch');
	ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
	redirect(REF);
}
