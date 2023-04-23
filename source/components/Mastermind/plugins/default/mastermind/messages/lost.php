<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Mastermind Game
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

$colora = '#' . input('colora');
$colorb = '#' . input('colorb');
$colorc = '#' . input('colorc');
$colord = '#' . input('colord');
?>

<div class="mastermind-message-background">
	<div class="mastermind-message-content">
		<p class="mastermind-message-icon">👎</p>
		<p><?php echo ossn_print('com:mastermind:message:box:lost'); ?></p>
		<div class="mastermind-message-color-row">
			<div class="mastermind-message-color-dot" style="background-color: <?php echo $colora; ?>"></div>
			<div class="mastermind-message-color-dot" style="background-color: <?php echo $colorb; ?>"></div>
			<div class="mastermind-message-color-dot" style="background-color: <?php echo $colorc; ?>"></div>
			<div class="mastermind-message-color-dot" style="background-color: <?php echo $colord; ?>"></div>
		</div>
	</div>
	<div class="control">
		<div class="controls">
			<a href="javascript:void(0);" onclick="Ossn.MessageBoxClose();" class='btn btn-primary'><?php echo ossn_print('com:mastermind:message:box:ok'); ?></a>
		</div>
	</div>
</div>
