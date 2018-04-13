<?php
/*
Template Name: Forgot Password
*/
get_header(); ?>

<form name="lostpasswordform" id="lostpasswordform" action="<?= site_url("/wp-login.php?action=lostpassword") ?>" method="post">
	<fieldset>
		<p>
			<label for="user_login">Email address</label>
			<input type="text" name="user_login" id="user_login" value="" size="20" required>
		</p>
		<p>
			<label>&nbsp;</label>
			<input type="hidden" name="redirect_to" value="<?= site_url("/account/password-forgotten-success/") ?>">
			<input name="wp-submit" id="wp-submit" type="submit" class="button" value="Send my password">
		</p>
	</fieldset>
</form>



<?php get_footer(); ?>