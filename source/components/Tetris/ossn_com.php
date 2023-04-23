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
define('__TETRIS__', ossn_route()->com . 'Tetris/');

function com_tetris_init() {
	if (ossn_isLoggedin()) { 
		// make component's css site-wide available for defining icons used in left sidebar menu
		ossn_extend_view('css/ossn.default', 'tetris/css/component');

		// prepare loading of font and css used by game only
		ossn_new_external_css('tetris-font', 'https://fonts.googleapis.com/css?family=Oswald:400light,700,400,400bold', false);
		ossn_new_external_css('tetris-css', 'components/Tetris/vendor/css/tetris.css');

		// prepare loading of javascript used by game only
		ossn_new_external_js('jquery-buzz', 'components/Tetris/vendor/js/jquery-buzz.js');
		ossn_new_external_js('tetris-vars', 'components/Tetris/vendor/js/tetris-vars.js');
		ossn_new_external_js('tetris-tools', 'components/Tetris/vendor/js/tetris-tools.js');
		ossn_new_external_js('tetris-pieces', 'components/Tetris/vendor/js/tetris-pieces.js');
		ossn_new_external_js('tetris-lines', 'components/Tetris/vendor/js/tetris-lines.js');
		ossn_new_external_js('tetris-score', 'components/Tetris/vendor/js/tetris-score.js');
		ossn_new_external_js('tetris-sound', 'components/Tetris/vendor/js/tetris-sound.js');
		ossn_new_external_js('tetris-game', 'components/Tetris/vendor/js/tetris-game.js');

		// register pagehandlers to make http://siteurl/tetris and http://siteurl/tetris-scores available
		ossn_register_page('tetris', 'com_tetris_page');
		ossn_register_page('tetris-scores', 'com_tetris_scores_page');
		
		// register menu entry in left sidebar menu
    	ossn_register_sections_menu('newsfeed', array(
			'name' => 'tetris-game',  // the icon will be derived from this name - see css file for further details
        	'text' => ossn_print('com:tetris:game'),
        	'url' => ossn_site_url('tetris'),
			'section' => 'games'
	    ));	

    	ossn_register_sections_menu('newsfeed', array(
			'name' => 'tetris-scores',  // the icon will be derived from this name - see css file for further details
        	'text' => ossn_print('com:tetris:scores'),
        	'url' => ossn_site_url('tetris-scores'),
			'section' => 'games'
	    ));	
		
		// register action for updating player's score
		ossn_register_action('tetris/update_player', __TETRIS__ . 'actions/update_player.php');
		
		// register a callback in order to delete the member's score record if the member has been deleted
		ossn_register_callback('user', 'delete', 'com_tetris_delete_score_record');
		// register a callback in order to delete ALL score records if the component is being deleted
		// ossn_register_callback('component', 'deleted', 'com_tetris_delete_all_score_records');
    }
}

function com_tetris_page($pages) {
	// acutally load already prepared css and scripts now
	ossn_load_external_css('tetris-font');
	ossn_load_external_css('tetris-css');
	ossn_load_external_js('jquery-buzz');
	ossn_load_external_js('tetris-vars');
	ossn_load_external_js('tetris-tools');
	ossn_load_external_js('tetris-pieces');
	ossn_load_external_js('tetris-lines');
	ossn_load_external_js('tetris-score');
	ossn_load_external_js('tetris-sound');
	ossn_load_external_js('tetris-game');
	// initialize and display tetris page
	$title = ossn_print('com:tetris:title');
	$contents['content'] = ossn_plugin_view('tetris/pages/tetris');
	$content = ossn_set_page_layout('contents', $contents);
	echo ossn_view_page($title, $content);
}

function com_tetris_scores_page($pages) {
    $params['title'] = ossn_print('com:tetris:scores:title');
	$params['page'] = $pages;
    $title = $params['title'];
    $contents = array('content' => ossn_plugin_view('tetris/pages/tetris-scores', $params),);
    $content = ossn_set_page_layout('contents', $contents);
    echo ossn_view_page($title, $content);
}

function com_tetris_delete_score_record($callback, $type, $params) {
	$deleted_user_guid = $params['entity']->guid;
	$obj = new OssnObject;
	$record = $obj->searchObject(['owner_guid' => "{$deleted_user_guid}", 'type' => 'tetris', 'subtype' => 'score']);
	if ($record) {
		$record[0]->deleteObject();
	}
}

function com_tetris_delete_all_score_records($callback, $type, $params) {
	if ($params['component']->com_id == 'Tetris') {
		$obj = new OssnObject;
		// remember that pagelimit won't allow us to retrieve all records at once
		// so loop through chunks of pagelimit size until last record is removed
		while($records = $obj->searchObject(['type' => 'tetris', 'subtype' => 'score'])) {
			foreach($records as $record) {
				$record->deleteObject();
			}
		}
	}
}

ossn_register_callback('ossn', 'init', 'com_tetris_init');
