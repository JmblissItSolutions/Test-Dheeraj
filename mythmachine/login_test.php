<?php /* Template Name: Login Test */ ?>
<?php get_header(); ?>
<?php
/* Main redirection of the default login page */

add_action('init','redirect_login_page');

/* Where to go if a login failed */
function custom_login_failed() {
	$login_page  = home_url('/login/');
	wp_redirect($login_page . '?login=failed');
	exit;
}
add_action('wp_login_failed', 'custom_login_failed');

/* Where to go if any of the fields were empty */
function verify_user_pass($user, $username, $password) {
	$login_page  = home_url('/login/');
	if($username == "" || $password == "") {
		wp_redirect($login_page . "?login=empty");
		exit;
	}
}
add_filter('authenticate', 'verify_user_pass', 1, 3);

/* What to do on logout */
function logout_redirect() {
	$login_page  = home_url('/login/');
	wp_redirect($login_page . "?login=false");
	exit;
}
add_action('wp_logout','logout_redirect');
?>

<?php get_footer(); ?>