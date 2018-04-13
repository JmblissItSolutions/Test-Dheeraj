<?php
/**
 * BuddyPress - My Books
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>


<div class="item-list-tabs no-ajax" id="subnav" aria-label="<?php esc_attr_e( 'Member secondary navigation', 'buddypress' ); ?>" role="navigation">
	<ul>
		<?php bp_get_options_nav(); ?>
	</ul>
</div><!-- .item-list-tabs -->



            
              <div class="mybook-tab-block">
                
                  <div class="mybook-tab-content">
  <?php $favorites = WeDevs_Favorite_Posts::init()->get_favorites();
  //var_dump($favorites);
  $count = 0;

 foreach ( $favorites as $post ) {
  $count++;
 $post_id = $post->post_id; 
 $page_num = $post->page_num;
 $first_post = get_post($post_id);
 
 if ( $count <= 1 ) {
 ?>
  <div class="left-content">
      <div class="mybook-title"><h1><a href="<?php echo get_the_permalink($post_id); ?><?php echo $page_num; ?>"><?php echo $first_post->post_title; ?></a></h1></div>
      <div class="mybook-text"><?php echo $first_post->post_excerpt; ?>
      <div class="mybookt-btn">
    <a href="<?php echo get_the_permalink($post_id); ?><?php echo $page_num; ?>" class="continue-btn">Continue Reading</a>
    </div>
      </div>
      </div>
      <div class="right-book">
        <?php echo get_the_post_thumbnail( $post_id, 'medium'); ?>
      </div>
 
    
 
  <?php           
    }
  }
    wp_reset_postdata();
           
?>
</div>
                  
                </div>
                

 
 <div class="book-Carousel-sec">
<h1 class="carousel-head">bookmarked books</h1>
<div id="book-Carousel" >
 
  <?php
$favorites_new = WeDevs_Favorite_Posts::init()->get_favorites();
  //var_dump($favorites);
 foreach ( $favorites_new as $post ) {
 $post_id = $post->post_id; 
 $page_num = $post->page_num;
 $c_post = get_post($post_id);
  ?>
    <div class="item">
    <div class="book-Carousel-img">
       <a href="<?php echo get_the_permalink($post_id); ?><?php echo $page_num; ?>"><?php echo get_the_post_thumbnail( $post_id, 'full' ); ?></a>
      </div>
      <div class="book-Carousel-title"><h1><a href="<?php echo get_the_permalink($post_id); ?><?php echo $page_num; ?>"><?php echo $c_post->post_title;?></a></h1></div>
      <div class="book-Carousel-author"><?php $autor_id = $c_post->post_author; echo get_the_author_meta( 'display_name', $author_id ); ?>
      </div>
      </div>

  <?php   

  }
    wp_reset_postdata();
           
?>
 </div>
 </div>
 
 <div class="book-Carousel-sec">
<h1 class="carousel-head">my library <span>(Purchased Books)</span></h1>
  <?php echo do_shortcode('[download_history]'); ?>
 </div>
 

