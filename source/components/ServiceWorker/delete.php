<?php
/**
 * Open Source Social Network
 * @link      https://www.opensource-socialnetwork.org/
 * @package   Service Worker
 * @author    Michael Zülsdorff <ossn@z-mans.net>
 * @copyright (C) Michael Zülsdorff
 * @license   GNU General Public License https://www.gnu.de/documents/gpl-2.0.en.html
 */
 
copy(ossn_route()->com . 'ServiceWorker/service-worker/favicon-sw-unregister.js', ossn_route()->www . 'favicon-sw.js');
