<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Mastermind Game
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */

define('__MASTERMIND__', ossn_route()->com . 'Mastermind/');

function com_mastermind_init()
{
	if (method_exists(new OssnSite, 'setSetting')) {
		// make component's css site-wide available for defining icons used in left sidebar menu
		ossn_extend_view('css/ossn.default', 'mastermind/css/component');

		// prepare loading of fonts, css and scripts used by game only
		ossn_new_external_css('mastermind-font', '//fonts.googleapis.com/css?family=Barlow+Semi+Condensed|Spectral+SC', false);
		ossn_new_external_css('mastermind-css', 'components/Mastermind/vendor/css/style.css');
		ossn_new_external_js('mastermind-vibration-js', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js', false);

		// register pagehandlers to make http://siteurl/Mastermind and subpages
		ossn_register_page('Mastermind', 'com_mastermind_page_handler');
		
    	// register left menu entry
    	ossn_register_sections_menu('newsfeed', array(
			'name' => 'mastermind',
        	'text' => 'Mastermind',
        	'url' => ossn_site_url('Mastermind'),
			'section' => 'games'
	    ));
	} else {
		error_log('Mastermind: Error version mismatch');
		ossn_trigger_message(ossn_print('ossn:admin:settings:save:error'), 'error');
		$comp = new OssnComponents;
		$comp->DISABLE('Mastermind');
		redirect(REF);
	}
}

function com_mastermind_page_handler($pages)
{
	$end_of_game = $pages[0];
	if (empty($end_of_game)) {
		// acutally load already prepared fonts, css and scripts now
		ossn_load_external_css('mastermind-font');
		ossn_load_external_css('mastermind-css');
		ossn_load_external_js('mastermind-vibration-js');

		// initialize and display Mastermind main page
		$title = 'Mastermind';
		$contents['content'] = ossn_plugin_view('mastermind/pages/mastermind');
		$content = ossn_set_page_layout('contents', $contents);
		echo ossn_view_page($title, $content);
		return;
	}
	
	switch ($end_of_game) {
		// handle Mastermind sub-pages
		case 'won':
			echo ossn_plugin_view('output/ossnbox', array(
				'title' => ossn_print('com:mastermind:message:box:title:ended'),
				'contents' => ossn_plugin_view('mastermind/messages/won'),
				'control' => false
			));
			break;
		case 'lost':
			echo ossn_plugin_view('output/ossnbox', array(
				'title' => ossn_print('com:mastermind:message:box:title:ended'),
				'contents' => ossn_plugin_view('mastermind/messages/lost'),
				'control' => false
			));
			break;
		case 'disclose':
			echo ossn_plugin_view('output/ossnbox', array(
				'title' => ossn_print('com:mastermind:message:box:title:disclosed'),
				'contents' => ossn_plugin_view('mastermind/messages/disclosed'),
				'control' => false
			));
			break;

		default:
			ossn_error_page();
			break;
	}
}

ossn_register_callback('ossn', 'init', 'com_mastermind_init');
