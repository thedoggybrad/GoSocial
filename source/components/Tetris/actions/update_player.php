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
if(!ossn_is_xhr()) {
	redirect(REF);
} else {
	header('Content-Type: application/json');
	$score   = input('score');
	if (!empty($score)) {
		$player_guid = ossn_loggedin_user()->guid;
		$obj = new OssnObject;
		$record = $obj->searchObject(['owner_guid' => "{$player_guid}", 'type' => 'tetris', 'subtype' => 'score']);
		if ($record) {
			if ($score > (int) $record[0]->title) {
				$fields = array(
					'title'
				);
				$values = array(
					$score
				);
				$obj->updateObject($fields, $values, $record[0]->guid);
			}
		}
		else {
			$obj->owner_guid = $player_guid;
			$obj->type = 'tetris';
			$obj->subtype = 'score';
			$obj->title = $score;
			$obj->addObject($obj);
		}
	}		
	echo json_encode(substr(ossn_loggedin_user()->username, 0, 7));
}
