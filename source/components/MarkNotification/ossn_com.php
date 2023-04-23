<?php

/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   MarkNotification
 * @author    Michieal O'Sullivan
 * @copyright (C) Apophis Software
 * @license   GNU General Public License https://www.gnu.org/licenses/gpl-3.0.en.html
 */

define('__MARKNOTIFICATION__', ossn_route()->com . 'MarkNotification/');

function ossn_mark_notifications_init() {
    //css
    ossn_extend_view('css/ossn.default', 'css/marknotif');
    //js
    ossn_extend_view('js/opensource.socialnetwork', 'js/marknotif');
    //pages
    ossn_register_page('mark', 'ossn_notifications_page');
    //actions
    ossn_register_action('mark/delete', __MARKNOTIFICATION__ . 'actions/delnotif.php');
    ossn_register_action('mark/read', __MARKNOTIFICATION__ . 'actions/marknotif.php');
    ossn_register_action('mark/unread', __MARKNOTIFICATION__ . 'actions/markunread.php');

    //set up hooks, to tap into the existing structure.
    $alltypes = array(
        'comments:post',
        'comments:entity:file:profile:photo',
        'comments:entity:file:profile:cover',
        'comments:post:businesspage:wall',
        'comments:entity:event:wall',
        'comments:entity:poll_entity',
        'comments:post:group:wall',
        'event:relation:going',
        'event:relation:interested',
        'event:relation:nointerested',
        'like:annotation',
        'like:annotation:comments:post',
        'like:annotation:comments:entity',
        'like:entity',
        'like:entity:event:wall',
        'like:entity:file:ossn:aphoto',
        'like:entity:file:profile:photo',
        'like:entity:file:profile:cover',
        'like:entity:poll_entity',
        'like:entity:blog',
        'like:post',
        'like:post:group:wall',
        'like:post:businesspage:wall',
        'groupinvite',
        'group:joinrequest',
        'mention:comment:created',
        'ossnpoke:poke',

        'report',
        'wall:friends:tag',

    );
    foreach ($alltypes as $type) {
        ossn_add_hook('notification:view', $type, 'notification_insert_custom_html');
    }
}

function notification_insert_custom_html($hook, $htype, $return, $params) {
    $nguid = $params->guid;

    if (!empty($return)) {
        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->loadHTML('<?xml encoding="UTF-8">'.$return, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $div = $doc->getElementsByTagName('a')->item(0);

        $frag = $doc->createDocumentFragment();

        //Mark the notification as read
        $link = 'javascript:void(0);'; //htmlspecialchars(ossn_site_url("action/mark/read?guid=" . $nguid, true));
        $notif_text = ossn_print('mark:notification:read');
        $notif_title = ossn_print('mark:notification:read:title');
        $data = "<a href='" . $link . "' class='apop-notif-read' OnClick='mnInstant(2, {$nguid})' title='" . $notif_title . "'>" . $notif_text . "</a>";
        $frag->appendXml($data);

        //Delete the notification.
        $notif_text = ossn_print('mark:notification:delete');
        $notif_title = ossn_print('mark:notification:delete:title');
        $link ='javascript:void(0);'; //htmlspecialchars(ossn_site_url("action/mark/delete?guid={$nguid}", true));
        $data = "<a href='" . $link . "' class='apop-notif-delete' OnClick='mnInstant(1, {$nguid})' title='" . $notif_title . "'>" . $notif_text . "</a>";
        $frag->appendXml($data);

/*        //Mark the notification as unread
        $link = htmlspecialchars(ossn_site_url("action/mark/unread?guid=" . $nguid, true));
        $notif_text = ossn_print('mark:notification:unread');
        $notif_title = ossn_print('mark:notification:unread:title');
        $data = "<a href='" . $link . "' class='apop-notif-unread' title='" . $notif_title . "'>" . $notif_text . "</a>";
        $frag->appendXml($data);
*/
        $data = "<br/><hr class='apop-hr'/>";
        $frag->appendXML($data);

        $div->appendChild($frag);

        //return $doc->saveHTML();
        return str_replace('<?xml encoding="UTF-8">', '', $doc->saveHTML());
    }
    return $return;
}
ossn_register_callback('ossn', 'init', 'ossn_mark_notifications_init');
