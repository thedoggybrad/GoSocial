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
$token = captcha_generate_token();
?>
<div class="margin-top-10">
	<img src="<?php echo ossn_site_url("captcha/{$token}");?>" />
	<input type="text" name="captcha_text" class="margin-top-10" placeholder="<?php echo ossn_print('captcha:text');?>" />
</div>
<input type="hidden" name="captcha" value="<?php echo $token;?>" />

