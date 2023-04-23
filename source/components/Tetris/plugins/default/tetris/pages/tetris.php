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
?>
<div id="tetris-body">		
		
	<div id="sound"></div>

	<div id="help">
		<h2><?php echo ossn_print('com:tetris:help:help'); ?></h2>
		<table align="center" border="0" cellPadding="2" cellSpacing="0">
			<tbody>
				<tr><td><?php echo ossn_print('com:tetris:help:left:right:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:tetris:help:left:right:action'); ?></td></tr>
				<tr><td><?php echo ossn_print('com:tetris:help:down:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:tetris:help:down:action'); ?></td></tr>
				<tr><td><?php echo ossn_print('com:tetris:help:rotate:right:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:tetris:help:rotate:right:action'); ?></td></tr>
				<tr><td><?php echo ossn_print('com:tetris:help:rotate:left:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:tetris:help:rotate:left:action'); ?></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td><?php echo ossn_print('com:tetris:help:pause:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:tetris:help:pause:action'); ?></td></tr>
				<tr><td><?php echo ossn_print('com:tetris:help:show:hide:next:key'); ?></td><td>&nbsp;<?php echo ossn_print('com:tetris:help:show:hide:next:action'); ?></td></tr>
			</tbody>
		</table>
	</div>
	
	<div id="home">
		<h1>Tetris</h1>
		<h2>Lucio PANEPINTO</h2>
		<h3>2014</h3>
		<span class="start invisible"><?php echo ossn_print('com:tetris:home:start'); ?></span>
		<div id="scores">
			<h2><?php echo ossn_print('com:tetris:home:highscores'); ?></h2>
			<table align="center" border="0" cellPadding="2" cellSpacing="0">
				<thead>
					<tr><th><?php echo ossn_print('com:tetris:home:rank'); ?></th><th><?php echo ossn_print('com:tetris:home:score'); ?></th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo ossn_print('com:tetris:home:name'); ?></th></tr>
				</thead>
				<tbody>
					<?php
					$obj = new OssnObject;
					$records = $obj->searchObject(['type' => 'tetris', 'subtype' => 'score', 'order_by' => 'title + 0 DESC']);
					$cnt = 1;
					if ($records) {
						foreach($records as $record) {
							$gamer = ossn_user_by_guid($record->owner_guid);
							if ($gamer) {
								$gamer_name = $gamer->username;
							}
							else {
								$gamer_name = 'deleted';
							}
							echo '<tr><td id="position' . $cnt . '">' . $cnt . '</td><td id="score' . $cnt . '">' . $record->title . '</td><td id="name' . $cnt . '">' . $gamer_name . '</td></tr>';
							$cnt++;
						}
					}
					for ($cnt; $cnt <= 4; $cnt++) {
						echo '<tr><td id="position' . $cnt . '">' . $cnt . '</td><td id="score' . $cnt . '">0</td><td id="name' . $cnt . '">-------</td></tr>';
					}
					?>
				</tbody>
			</table>
		</div>
		<div>
			<a class="sound" href="javascript:void(0);" data-sound="on"><img src="components/Tetris/vendor/img/sound-on.png" alt="" border="0"></a>
			<div class="help-button"><?php echo ossn_print('com:tetris:home:help'); ?></div>
		</div>
	</div>
	
	<div id="panel">
		<h1>Tetris</h1>
		<div id="board"></div>
		<div id="level">
			<h2><?php echo ossn_print('com:tetris:panel:level'); ?></h2>
			<span></span>
		</div>
		<div id="lines">
			<h2><?php echo ossn_print('com:tetris:panel:lines'); ?></h2>
			<span></span>
		</div>
		<div id="score">
			<h2><?php echo ossn_print('com:tetris:panel:score'); ?></h2>
			<span></span>
		</div>
		<div id="next">
			<h2><?php echo ossn_print('com:tetris:panel:next'); ?></h2>
			<span>
				<div id="board-next"></div>
			</span>
		</div>
		<div>
			<a class="sound" href="javascript:void(0);" data-sound="on"><img src="components/Tetris/vendor/img/sound-on.png" alt="" border="0"></a>
			<div class="help-button"><?php echo ossn_print('com:tetris:panel:help'); ?></div>
		</div>
	</div>
	
	<div id="control">
		<div class="move-left"></div>
		<div class="move-right"></div>
		<div class="move-down"></div>
		<div class="rotate"></div>
		<div class="pause"></div>
		<div class="view-next not"></div>
	</div>
	
</div>
<script>
SCORE_1_NAME = $('#name1').html();
SCORE_2_NAME = $('#name2').html();
SCORE_3_NAME = $('#name3').html();
SCORE_4_NAME = $('#name4').html();
SCORE_1 = $('#score1').html();
SCORE_2 = $('#score2').html();
SCORE_3 = $('#score3').html();
SCORE_4 = $('#score4').html();
</script>