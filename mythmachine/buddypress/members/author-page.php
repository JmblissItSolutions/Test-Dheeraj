<?php

get_header();

$user = get_userdatabylogin($_GET['author']);
$section = $_GET['section'];

?>

<div id="main-content">


	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">


				<article>


					

					<div class="entry-content">
					<?php
				 echo  ( xprofile_get_field_data($section, $user->ID , $multi_format = 'comma') ) ? xprofile_get_field_data($section, $user->ID , $multi_format = 'comma') : "This user has not added Bio yet";
				?>
					</div> <!-- .entry-content -->


				</article> <!-- .et_pb_post -->



			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>
<style>
.back_button a{
	color:#000 !important;
}
</style>