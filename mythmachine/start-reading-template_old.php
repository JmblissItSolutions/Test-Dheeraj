<?php

/*
Template Name: Start Reading Template OLD
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
			<div class="cs_container">
            
            	<div class="featured-main-block">
                
                	<div class="featured-post-content">
  <?php
  $query = new WP_Query(array('post_type'=>'books','posts_per_page'=>1,'post_status' => 'publish','orderby' => 'publish_date','order' => 'DESC'));
if ( $query->have_posts() ) {	while ( $query->have_posts() ) {$query->the_post();?>
 <div class="featured-post-title"><h1>featured book <?php //the_title();?></h1></div>
 <div class="right-book">
      	<?php the_post_thumbnail('full');?>
      </div>
  <div class="left-content">      
      <div class="featured-post-text"><?php the_excerpt();?>
      <div class="featured-post-btn">
		<a href="<?php the_permalink(); ?>" class="reading-btn">Start Reading</a>
	  </div>
      </div>
      </div>
      
 
    
 
  <?php						}}
    wp_reset_postdata();
					 
?>
</div>
                	
                </div>
            
            	<div class="cat-main-block">
                	<div class="sign-board">
                    	<h2>Explore More Books from following categories</h2>
                    </div>
                    
					<div class="books-category">
    				<?php
					$args=array(
					'orderby' => 'name',
					'order' => 'ASC',
					'taxonomy'  => 'bookcategory'
				
					);
					$categories=get_categories($args);
					
					foreach($categories as $category) {
					echo '<div class="cat-item-box"> <a href="' . get_term_link( $category->term_id ) . '" title="' . sprintf( __( "%s" ), $category->name ) . '" ' . '>';
					if(has_category_thumbnail($category->term_id)) {
						
						the_category_thumbnail($category->term_id);
						echo '<h2>'. $category->name.'</h2>';
					}
					echo '</a></div>';
					}
					?>
	     
</div>
</div>
</div>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
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
					<?php
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

			<?php //get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>