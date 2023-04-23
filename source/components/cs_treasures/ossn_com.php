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


function cs_treasures_init() {
	ossn_register_page('cs_treasures', 'cs_treasures_pages');
	ossn_extend_view('css/ossn.default', 'css/cs_treasures');
	ossn_extend_view('js/opensource.socialnetwork', 'js/cs_treasures');
	  if (ossn_isLoggedin()) {       
		
    	ossn_register_sections_menu('newsfeed', array(
        	'name' => 'treasures',
			'text' => ossn_print('cs_treasures:title'),
        	'url' => ossn_site_url('cs_treasures'),
        	'icon' => $icon,
		    'section' => 'games'
	    	));		
    }
}


function cs_treasures_pages($pages) {

 if (!ossn_isLoggedin()) {
            ossn_error_page();
   }
$title = ossn_print('cs_treasures:head');
   $contents['content'] = ossn_plugin_view('cs_treasures/cs_treasures');
   $content = ossn_set_page_layout('contents', $contents);
   echo ossn_view_page($title, $content);
}

ossn_register_callback('ossn', 'init', 'cs_treasures_init');
