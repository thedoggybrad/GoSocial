<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Google Analytics
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
if ($params['settings'] && $params['settings']->ga_code) {
	$ga_code = $params['settings']->ga_code;
} else {
	$ga_code = '';
}
?>
<div class="card">
	<div class="card-body">
		<label><?php echo ossn_print('com:google_analytics:label');?></label>
		<textarea rows="10" name="ga_code" placeholder="<?php echo ossn_print('com:google_analytics:placeholder'); ?>"><?php echo $ga_code;?></textarea>
		<input type="submit" class="btn btn-success" value="<?php echo ossn_print('save'); ?>"/>
	</div>
</div>