<?php /* Template Name: TML temp */ ?>
<?php  if ( is_user_logged_in() ){ 

  if ( isset($_COOKIE['BookMarkPage'])){
    $page = $_COOKIE['BookMarkPage'];
    $pro_url = '/books/secrets-of-moldara/'.$page;
    ?> 
    <script>
    jQuery( window ).load(function() {
		document.cookie = "BookMarkPage=; expires='Thu, 01 Jan 1970 00:00:01 GMT';domain=mythmachine.com; path=/";
	});
 	 </script>
    <?php 
       header('Location:' .$pro_url);

  	}else{

	$pro_url = bp_loggedin_user_domain()  . 'profile/';
	header('Location:' .$pro_url);
	}
}
?>
<?php get_header(); ?>
<?php //dynamic_sidebar( 'Login Page' ); ?> 
<div class="container" >
    
   		<div class="form-overlay">
            <?php echo do_shortcode( '[theme-my-login]' ); ?>
            
        </div>

</div>

<?php get_footer(); ?>

