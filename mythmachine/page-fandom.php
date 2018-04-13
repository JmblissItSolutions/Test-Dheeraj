<?php
/*
Template Name:  Fandom Template
Template Post Type: fandom
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<!--<h1 class="entry-title main_title"><?php //the_title(); ?></h1>-->
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
					<div class="meet-author-btn" style="margin:0px !important;text-align:center;"><a href="#"><?php the_title(); ?></a></div>				
					<?php
					global $post;
						$terms = get_the_terms( $post->ID , 'fandom_category' );

						//echo $terms[0]->name;

						$group_id = BP_Groups_Group::group_exists($terms[0]->slug);
						$group = groups_get_group( array( 'group_id' => $group_id ) );
						$slug = $group->slug;
						echo '<div class="back_button" style="background:gray !important;padding:10px;margin:auto !important;text-align:center;width:300px;"><a href="/groups/'.$slug.'">Back to Fandom</a></div>';
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>
<style>
.back_button a{
	color:#000 !important;
}


	</style>