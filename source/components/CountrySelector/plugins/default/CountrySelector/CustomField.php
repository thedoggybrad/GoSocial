<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Country Selector
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
?>
<script>
$(document).ready(function() { 
	var custom_field = '<tr class=\" customfield-item\"><th><?php echo ossn_print('com:country:selector:label'); ?></th><td><?php echo ossn_print($params['user']->country); ?></td></tr>';
	$(custom_field).insertAfter('.customfield-list tr:last');
});
</script>
