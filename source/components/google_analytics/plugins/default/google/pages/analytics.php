<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Google Analytics
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
$settings = new OssnComponents;
$settings = $settings->getComSettings('google_analytics');
if (!$settings || $settings && !isset($settings->ga_code)) {
	return;
}
$ga_code  = $settings->ga_code;
?>

<!-- Google Analytics -->
<?php 
echo html_entity_decode($ga_code, ENT_QUOTES, 'UTF-8');
?>
<!-- End Google Analytics -->
