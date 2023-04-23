<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   bio
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
?>

<script>
	var content = '<?php echo $params['content'];?>'; 
	var hr_menu = $('#profile-hr-menu');
	$('<div class="d-md-none"><div style="float:left;background-color:var(--main-bg-color); color:var(--text-color);padding-top:50px;padding-left: 10px;padding-right: 10px;">' + content + '</div></div>').insertBefore(hr_menu);
</script>