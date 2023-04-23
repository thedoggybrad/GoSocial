<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Privacy Changer
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
?>

function com_PrivacyChanger_changePrivacy(post_guid) {
	Ossn.PostRequest({
		url: Ossn.site_url + 'action/wall/post/privacy_change?post=' + post_guid,
		beforeSend: function(){},
		callback: function(callback) {
			if (callback['success'] == 1) {
				var post = $('#activity-item-' + post_guid);
				var post_privacy_icon = post.find('.post-meta .fa');
				post_privacy_icon.removeClass('fa-globe-americas');
				post_privacy_icon.removeClass('fa-users');
				post_privacy_icon.addClass(callback['icon']);
				var post_privacy_title = post_privacy_icon.parent();
				post_privacy_title.prop('title', callback['title']);
				var post_menu_entry = post.find('.ossn-wall-post-privacy-change');
				post_menu_entry.html(callback['menu']);
			} else {
				Ossn.trigger_message(callback['error'], 'error');
			}
		},
	});
}
