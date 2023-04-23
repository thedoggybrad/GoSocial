<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Country Selector
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
$component = new OssnComponents;
$settings = $component->getSettings('CountrySelector');

$auto_locator_options = array(
	'off',
	'on'
);
foreach($auto_locator_options as $option){
	 $auto_locator_option_strings[$option] = ossn_print("ossn:admin:settings:{$option}"); 
}
?>
<div class="card">
	<div class="card-header">
		<?php echo ossn_print('com:country:selector:admin:settings:label:location:detection:header');?>
	</div>
	<div class="card-body">
		<?php 
		echo ossn_print('com:country:selector:admin:settings:label:location:detection:text');
		echo ossn_plugin_view('input/radio', array(
				'name' => 'auto_locator',
				'value' => (($settings ? $settings->auto_locator : false) ?: 'off'),
				'options' => $auto_locator_option_strings,
				'class' => ''
		));
		?>
	</div>
</div>
<div class="card">
	<div class="card-body">
		<input type="submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('save'); ?>"/>
	</div>
</div>