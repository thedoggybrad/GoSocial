<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Privacy Changer
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
$user = ossn_loggedin_user();
$id = input('post');
$ossnwall = new OssnWall();
$post = $ossnwall->GetPost($id);

if ($user && $post && ossn_is_xhr()) {
	header('Content-Type: application/json');
	if (($post->type != 'user') || ($post->type == 'user' && !$user->canModerate())) {
		if (($post->type != 'user') || ($post->type == 'user' && $post->poster_guid != $user->guid && $post->owner_guid != $user->guid)) {
	 		echo json_encode(array(
				'success' => 0,
				'error' => ossn_print('com:privacy:changer:access:denied'),
			));
			exit;
		}
	}

	$post->data = new stdClass;

	if ($post->access == OSSN_PUBLIC) {
		$post->data->access = OSSN_FRIENDS;
		$icon = 'fa-users';
		$title = ossn_print('title:access:3');
		$menu = ossn_print("com:privacy:changer:change:privacy:3");
	} else {
		if ($post->access == OSSN_FRIENDS) {
			$post->data->access = OSSN_PUBLIC;
			$icon = 'fa-globe-americas';
			$title = ossn_print('title:access:2');
			$menu = ossn_print("com:privacy:changer:change:privacy:2");
		}
	}

	if ($post->save()) {
		echo json_encode(array(
			'success' => 1,
			'icon' => $icon,
			'title' => $title,
			'menu' => $menu,
		));
		exit;
	} else {
		echo json_encode(array(
			'success' => 0,
			'error' => ossn_print('com:privacy:changer:change:failed'),
		));
		exit;
	}
}

ossn_trigger_message(ossn_print('com:privacy:changer:access:denied'), 'error');
redirect(REF);
