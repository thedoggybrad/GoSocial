<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   Arcade
 * @author    AT3META <at3meta@3ncircle.com>
 * @copyright 2021 3NCIRCLE Inc.
 * @license   General Public Licence V3
 * @link      https://www.gnu.org/licenses/gpl-3.0.en.html
 */
define('__ARCADE__', ossn_route()->com . 'Arcade/');

function arcade_init() {
	ossn_register_page('arcade', 'arcade_pages');
	  if (ossn_isLoggedin()) {       
		ossn_extend_view('css/ossn.default', 'css/arcade');
		
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'diablo',

						'text' => ossn_print('com:ossn:diablo'),

						'url' => ossn_site_url('arcade/diablo'),

						'section' => 'arcade',

				));
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'diabloii',

						'text' => ossn_print('com:ossn:diabloii'),

						'url' => ossn_site_url('arcade/diabloii'),

						'section' => 'arcade',

				));	
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'doom',

						'text' => ossn_print('com:ossn:doom'),

						'url' => ossn_site_url('arcade/doom'),

						'section' => 'arcade',

				));
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'doomii',

						'text' => ossn_print('com:ossn:doomii'),

						'url' => ossn_site_url('arcade/doomii'),

						'section' => 'arcade',

				));
					ossn_register_sections_menu('newsfeed', array(

						'name' => 'dukenukem',

						'text' => ossn_print('com:ossn:dukenukem'),

						'url' => ossn_site_url('arcade/dukenukem'),

						'section' => 'arcade',

				));
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'wolfenstein',

						'text' => ossn_print('com:ossn:wolfenstein'),

						'url' => ossn_site_url('arcade/wolfenstein'),

						'section' => 'arcade',

				));
					
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'zelda',

						'text' => ossn_print('com:ossn:zelda'),

						'url' => ossn_site_url('arcade/zelda'),

						'section' => 'arcade',

				));
				
				ossn_register_sections_menu('newsfeed', array(

						'name' => 'sonic',

						'text' => ossn_print('com:ossn:sonic'),

						'url' => ossn_site_url('arcade/sonic'),

						'section' => 'arcade',

				));	
    }
}
function arcade_pages($pages) {

if(!ossn_isLoggedin()) {

				ossn_error_page();
		}


		switch($pages[0]) {

				case 'diablo':

						$guid                = $pages[1];

						$title               = ossn_print('com:ossn:diablo');
						
						$contents['content'] = ossn_plugin_view('pages/diablo', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'diabloii':

						$guid                = $pages[2];

						$title               = ossn_print('com:ossn:diabloii');
						
						$contents['content'] = ossn_plugin_view('pages/diabloii', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'doom':

						$guid                = $pages[3];

						$title               = ossn_print('com:ossn:doom');
						
						$contents['content'] = ossn_plugin_view('pages/doom', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'doomii':

						$guid                = $pages[4];

						$title               = ossn_print('com:ossn:doomii');

						$contents['content'] = ossn_plugin_view('pages/doomii', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);
						
						break;
					
				case 'dukenukem':

						$guid                = $pages[5];

						$title               = ossn_print('com:ossn:dukenukem');
						
						$contents['content'] = ossn_plugin_view('pages/dukenukem', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'wolfenstein':

						$guid                = $pages[6];

						$title               = ossn_print('com:ossn:wolfenstein');

						$contents['content'] = ossn_plugin_view('pages/wolfenstein', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);
						
	                    break;
					
				case 'zelda':

						$guid                = $pages[7];

						$title               = ossn_print('com:ossn:zelda');
						
						$contents['content'] = ossn_plugin_view('pages/zelda', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;
						
				case 'sonic':

						$guid                = $pages[7];

						$title               = ossn_print('com:ossn:sonic');
						
						$contents['content'] = ossn_plugin_view('pages/sonic', array(

								'guid' => $guid

						));

						$content             = ossn_set_page_layout('newsfeed', $contents);

						echo ossn_view_page($title, $content);

						break;

	}
}
ossn_register_callback('ossn', 'init', 'arcade_init');
