<?php
/**
 * Open Source Social Network
 *
 * this component is meant for testing purposes only
 */


function touch_punch_init() {
	if (ossn_isLoggedin()) {
		ossn_extend_view('ossn/site/head', 'js/jquery.ui.touch-punch.min.js');
	}
}

ossn_register_callback('ossn', 'init', 'touch_punch_init');
