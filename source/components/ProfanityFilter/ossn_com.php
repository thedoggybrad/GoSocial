<?php

 
define('__ACF__', ossn_route()->com . 'ProfanityFilter/');
require_once(__ACF__ . 'libraries/acfreplace.lib.php');

/* *
 * @note Please don't call this function directly in your code.
 */
function ossn_replace_embed_init() {	
 	ossn_add_hook('wall', 'templates:item', 'ossn_embed_replacer', 100);
	ossn_add_hook('comment:view', 'template:params', 'ossn_replace_in_comments', 100);	
}
/**
 * Replace profane ascii patterns with dashes.
 *
 * @note Please don't call this function directly in your code.
 * 
 * @param string $hook Name of hook
 * @param string $type Hook type
 * @param array|object $return Array or Object
 * @params array $params Array contatins params
 *
 * @return array
 * @access private
 */
function ossn_embed_replacer($hook, $type, $return, $params){
	$params['text'] = replacer($return['text']);
	return $params;
}
/**
 * Replace profane ascii patterns with dashes in comments.
 *
 * @note Please don't call this function directly in your code.
 * 
 * @param string $hook Name of hook
 * @param string $type Hook type
 * @param array|object $return Array or Object
 * @params array $params Array contatins params
 *
 * @return array
 * @access private
 */
function ossn_replace_in_comments($hook, $type, $return, $params){
	if(isset($return['comment']['comments:post'])){
		$return['comment']['comments:post'] = replacer($return['comment']['comments:post']);
	} elseif(isset($return['comment']['comments:entity'])){
		$return['comment']['comments:entity'] = replacer($return['comment']['comments:entity']);		
	}
	return $return;	
}
//initilize ossn smilies
ossn_register_callback('ossn', 'init', 'ossn_replace_embed_init');
