<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

function reduce_images_size_init() {
		ossn_add_hook('ossn', 'image:resize:quality', 'reduce_images_size');
}
function reduce_images_size(){
		return 30;	
}
ossn_register_callback('ossn', 'init', 'reduce_images_size_init');
