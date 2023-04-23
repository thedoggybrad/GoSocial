<?php

/**
 * Open Source Social Network
 *
 * @package   RemoveConversation
 * @author    Rafael Amorim <amorim@rafaelamorim.com.br>
 * @copyright (C) Rafael Amorim
 * @license   OSSNv4  http://www.opensource-socialnetwork.org/licence/
 * @link      https://www.rafaelamorim.com.br/
 */

/* Define Paths */
define('__REMOVE_CONVERSATION__', ossn_route()->com . 'RemoveConversation/');

//Load Class 
if (com_is_active('OssnMessages')){  
    require_once(__REMOVE_CONVERSATION__ . 'classes/RemoveConversation.php');
} 

function RemoveConversation_init(){    

    if (!com_is_active('OssnMessages')){
        return;
    }
    
    //page
    ossn_register_page('removeconversation', 'removeconversation_page');

    //js
    ossn_extend_view('js/ossn.site', 'js/RemoveConversation');

    //css
    ossn_extend_view('css/ossn.default', 'css/RemoveConversation');

    //actions
    ossn_register_action('message/removeConversation', __REMOVE_CONVERSATION__ . 'actions/message/removeConversation.php');
}

/**
 * Ossn messages page handler
 *
 * @param array $pages Pages
 *
 * @return mixed data
 */
function removeconversation_page()
{
    if (!ossn_isLoggedin()) {
        ossn_error_page();
    }

    $guid_to = input('id');
    $user = ossn_loggedin_user()->guid;
    $params = array(
        'title' => ossn_print('delete'),
        'contents' => ossn_view_form('removeConversation', array(
            'action' => ossn_site_url('action/message/removeConversation'),
            'id' => 'ossn-message-delete-all-form',
            'params' => array(
                'guid_to' => $guid_to,
                'user' => $user,
            ),
        )),
        'button' => ossn_print('delete'),
        'callback' => '#ossn-md-edit-save',
    );
    echo ossn_plugin_view('output/ossnbox', $params);

}

ossn_register_callback('ossn', 'init', 'RemoveConversation_init', 300);