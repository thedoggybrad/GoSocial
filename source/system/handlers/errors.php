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
$email = ossn_site_settings('owner_email');
$icon  = ossn_theme_url().'images/broken.png';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title><?php echo ossn_site_settings('site_name'); ?></title>
		<link rel="stylesheet"href="<?php echo ossn_site_url(); ?>themes/<?php echo ossn_site_settings('theme'); ?>/plugins/default/css/exception.css"type="text/css"/>
	</head>
	<body>
		<div class="ossn-exception-topbar">&#128736; <span style="margin-left:5px;"><?php echo ossn_site_settings('site_name'); ?></span></div>
		<div class="ossn-exception-handler">
			<div class="container-inner">
				<div class="ossn-logo"></div>
				<div class="title"><?php echo ossn_print('ossn:exception:title', array($email)); ?></div>
			</div>
			<?php if(ossn_isAdminLoggedin()){ ?>
			<div class="ossn-exception-description">
				<div>
					<pre><?php echo $params['exception']; ?></pre>
				</div>
			</div>
			<?php } else { ?>
			<div class="ossn-exception-description">
				<div>
					<pre>#<?php echo $params['time']; ?>|<?php echo $params['session_id'];?></pre>
				</div>
			</div>
			<?php } ?>
		</div>
	</body>
</html>