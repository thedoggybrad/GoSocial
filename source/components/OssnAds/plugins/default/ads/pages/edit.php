<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
echo ossn_view_form('edit', array(
    'action' => ossn_site_url() . 'action/ossnads/edit',
    'component' => 'OssnAds',
    'class' => 'ossn-ads-form',
	'params' => $params,
), false);
