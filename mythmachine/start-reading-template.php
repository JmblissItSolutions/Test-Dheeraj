<?php
/*
Template Name: Start Reading Template
*/
get_header();
$is_page_builder_used = et_pb_is_pagebuilder_used(get_the_ID());
?>

<div id="main-content">

<?php

if (!$is_page_builder_used): ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php
endif; ?>
			<div class="cs_container">
            

  <?php

/**
*
** Test purpose code
*
**/

/**
*
** Test purpose code end
*
**/

$query = new WP_Query(array(
	'post_type' => 'books',
	'posts_per_page' => 5,
	'post_status' => 'publish',
	'orderby' => 'publish_date',
	'order' => 'ASC'
));

if ($query->have_posts()) {
	while ($query->have_posts()) {
		$query->the_post(); ?>

            
<?php
}
echo do_shortcode('[ajax_load_more id="2811592760" container_type="div" post_type="books"  scroll_distance="0" images_loaded="true" button_label="Load More Books" button_loading_label="Loading books.."]');
}
wp_reset_postdata();
?>

</div>

</div> <!-- #main-content -->

<?php
get_footer(); ?>