<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$pagination  = ossn_call_hook('pagination', 'page_limit', false, 10);
$offset      = (int) $_GET['offset'];
if ($offset < 1) $offset = 1;
$rank_factor = ($offset - 1) * $pagination;

$obj = new OssnObject;
$records = $obj->searchObject(['type' => 'tetris', 'subtype' => 'score', 'order_by' => 'title + 0 DESC']);
$count   = $obj->searchObject(['type' => 'tetris', 'subtype' => 'score', 'count' => true]);
?>

<div class="container">
	<div class="col-md-1">
	</div>
	<div class="col-md-10">
		<div class="ossn-widget">
			<div class="widget-heading"><?php echo ossn_print('com:tetris:scores:title'); ?>
			</div>
			<div class="widget-content">
				<table class="table ossn-users-list">
				<tbody>
				<tr class="table-titles">
					<th><?php echo ossn_print('com:tetris:scores:rank'); ?></th>
					<th><?php echo ossn_print('com:tetris:scores:score'); ?></th>
					<th><?php echo ossn_print('com:tetris:scores:member'); ?></th>
				</tr>
				<?php 
				if($count){
					$cnt = 1;
					foreach($records as $record) {
						$rank = $cnt + $rank_factor;
						$gamer = ossn_user_by_guid($record->owner_guid);
						if ($gamer) {
							$gamer_name = $gamer->fullname;
						}
						else {
							$gamer_name = ossn_print('com:tetris:scores:member:deleted');
						}
						echo '<tr><td>' . $rank  . '</td><td>' . $record->title . '</td><td>' . $gamer_name . '</td></tr>';
						$cnt++;
					}
				}
				?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php echo ossn_view_pagination($count); ?>
</div>