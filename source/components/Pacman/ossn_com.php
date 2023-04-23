<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Pacman
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
define('__PACMAN__', ossn_route()->com . 'Pacman/');

function com_pacman_init()
{
	if (ossn_isLoggedin()) { 
		ossn_extend_view('css/ossn.default', 'pacman/css/component');

		// prepare loading of font and css used by game only
		ossn_new_external_css('pacman-css', 'components/Pacman/vendor/css/pacman.css');
		ossn_new_external_css('pacman-home-css', 'components/Pacman/vendor/css/pacman-home.css');

		// prepare loading of javascript used by game only
		ossn_new_external_js('jquery-buzz', 'components/Pacman/vendor/js/jquery-buzz.js');
		ossn_new_external_js('pacman-game', 'components/Pacman/vendor/js/game.js');
		ossn_new_external_js('pacman-tools', 'components/Pacman/vendor/js/tools.js');
		ossn_new_external_js('pacman-board', 'components/Pacman/vendor/js/board.js');
		ossn_new_external_js('pacman-paths', 'components/Pacman/vendor/js/paths.js');
		ossn_new_external_js('pacman-bubbles', 'components/Pacman/vendor/js/bubbles.js');
		ossn_new_external_js('pacman-fruits', 'components/Pacman/vendor/js/fruits.js');
		ossn_new_external_js('pacman-pacman', 'components/Pacman/vendor/js/pacman.js');
		ossn_new_external_js('pacman-ghosts', 'components/Pacman/vendor/js/ghosts.js');
		ossn_new_external_js('pacman-home', 'components/Pacman/vendor/js/home.js');
		ossn_new_external_js('pacman-sound', 'components/Pacman/vendor/js/sound.js');

		// register pagehandlers to make http://siteurl/pacman
		ossn_register_page('pacman', 'com_pacman_page');
		
		// register menu entry in left sidebar menu
    	ossn_register_sections_menu('newsfeed', array(
			'name' => 'pacman-game',
        	'text' => ossn_print('com:pacman:game'),
        	'url' => ossn_site_url('pacman'),
			'section' => 'games'
	    ));	
    }
}

function com_pacman_page($pages)
{
	// acutally load already prepared css and scripts now
	ossn_load_external_css('pacman-css');
	ossn_load_external_css('pacman-home-css');
	ossn_load_external_js('jquery-buzz');
	ossn_load_external_js('pacman-game');
	ossn_load_external_js('pacman-tools');
	ossn_load_external_js('pacman-board');
	ossn_load_external_js('pacman-paths');
	ossn_load_external_js('pacman-bubbles');
	ossn_load_external_js('pacman-fruits');
	ossn_load_external_js('pacman-pacman');
	ossn_load_external_js('pacman-ghosts');
	ossn_load_external_js('pacman-home');
	ossn_load_external_js('pacman-sound');
	// initialize and display pacman page
	$title = ossn_print('com:pacman:title');
	$contents['content'] = ossn_plugin_view('pacman/pages/pacman');
	$content = ossn_set_page_layout('contents', $contents);
	echo ossn_view_page($title, $content);
}

ossn_register_callback('ossn', 'init', 'com_pacman_init');
