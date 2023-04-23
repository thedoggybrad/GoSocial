<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Privacy Changer
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__PRIVACY_CHANGER__', ossn_route()->com . 'PrivacyChanger/');

function com_privacy_changer_init()
{
	ossn_extend_view('js/ossn.site', 'js/PrivacyChanger');
	if (ossn_isLoggedin()) {
		ossn_add_hook('wall', 'post:menu', 'com_privacy_changer_wall_post_menu');
		ossn_register_action('wall/post/privacy_change', __PRIVACY_CHANGER__ . 'actions/wall/post/privacy_change.php');
	}
}

function com_privacy_changer_wall_post_menu($hook, $type, $return, $params) {
	$user = ossn_loggedin_user();
	if ($params['post']->type != 'user' || $params['post']->access == OSSN_PRIVATE) {
		return ossn_view_menu('wallpost', 'wall/menus/post-controls');
	}
	if ($params['post']->poster_guid == $user->guid || $params['post']->owner_guid == $user->guid || $user->canModerate()) {
		ossn_unregister_menu('privacy', 'wallpost');
		ossn_register_menu_item('wallpost', array(
			'name'      => 'privacy',
			'class'     => 'ossn-wall-post-privacy-change',
			'text'      => ossn_print("com:privacy:changer:change:privacy:{$params['post']->access}"),
			'href'      => "javascript:onclick=com_PrivacyChanger_changePrivacy({$params['post']->guid});",
			'data-guid' => $params['post']->guid,
		));
	} else {
		ossn_unregister_menu('privacy', 'wallpost');
	}
	return ossn_view_menu('wallpost', 'wall/menus/post-controls');
}

ossn_register_callback('ossn', 'init', 'com_privacy_changer_init');