<?php 
/**
 * BuddyPress - Groups Home
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */
//echo $_GET['author'];
$user = get_userdatabylogin($_GET['author']);
//var_dump($user);

?>
<div class="group-home">
<div id="buddypress">


<div id="item-header" role="complementary">


	<div id="item-header-avatar">
<?php echo bp_core_fetch_avatar( array( 'item_id' => $user->ID, 'width' => '150', 'height' => '150' ) ); ?>

	</div><!-- #item-header-avatar -->

<div id="item-header-content">
	<!--<span class="highlight"></span>-->
	<!--<span class="activity" data-livestamp=""></span>-->

	
	<div id="item-meta">
         <h2 class="group-name"><?php echo ucwords($user->display_name); ?></h2>

         <div class="group_description">
						<?php
				 echo  ( xprofile_get_field_data('Bio', $user->ID , $multi_format = 'comma') ) ? xprofile_get_field_data('Bio', $user->ID , $multi_format = 'comma') : "This user has not added Bio yet";
				?>
	</div>
         <div class="profile-social rd-pro-so">
        <a href="<?php
  echo ( xprofile_get_field_data('facebook',$user->ID ) ) ? xprofile_get_field_data('facebook',$user->ID ) : '#' ?>"><span class="fa fa-facebook"></span></a> 
                <a href="<?php
  echo ( xprofile_get_field_data('twitter',$user->ID ) ) ? xprofile_get_field_data('twitter',$user->ID ) : '#' ?>"><span class="fa fa-twitter"></span></a>
                <a href="<?php
  echo ( xprofile_get_field_data('linkedin',$user->ID ) ) ? xprofile_get_field_data('linkedin',$user->ID ) : '#' ?>"><span class="fa fa-linkedin"></span></a>
                </div>
	</div>

</div><!-- #buddypress -->
</div><!-- #item-header-content -->
</div>
</div>
    
<div class="book-Carousel-sec">
<h1 class="carousel-head">My Published Books</h1>
<div id="book-Carousel" >
 
  <?php
  $query = new WP_Query(array(
    'post_type' => 'books',
    'posts_per_page' => - 1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC',
    'author' => $user->ID,
  ));
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post(); ?>
  
    <div class="item">
    <div class="book-Carousel-img">
        <a href="<?php echo get_the_permalink($post_id); ?>"><?php
      the_post_thumbnail('full'); ?></a>
      </div>
      <div class="book-Carousel-title"><h1><a href="<?php
      the_permalink(); ?>"><?php
      the_title(); ?></a></h1></div>
      <div class="book-Carousel-author"><?php
      $autor_id = $query->post_author;
      echo get_the_author_meta('display_name', $author_id); ?>
      </div>
      </div>

  <?php
    }
  }
  wp_reset_postdata();
?>
 </div>
 </div>


 <div class="blog-Carousel-sec">
<h1 class="blog-head">My Published Blogs</h1>
<div id="blog-Carousel" >
 
  <?php
  $query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => - 1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC',
    'author' => $user->ID,
  ));
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post(); ?>
  
    <div class="item">
    <div class="blog-Carousel-img">
        <a href="<?php echo get_the_permalink($post_id); ?>"><?php
      the_post_thumbnail('full'); ?></a>
      </div>
      <div class="blog-Carousel-title"><h1><a href="<?php
      the_permalink(); ?>"><?php
      the_title(); ?></a></h1></div>
      <div class="blog-Carousel-content"><?php
      the_excerpt(); ?>
      
      <a class="read_more" href="<?php
      the_permalink(); ?>">+ Read More</a>
      </div>
      </div>

  <?php
    }
  }
  wp_reset_postdata();
  $author_name = $_GET['author'];
?>
 </div>
 </div>


 <br />   
    <div class="group-category-sec">
    	<h2>top things to do</h2>
        <p class="sub_head">Start exploring your fandom and do the most interesting things </p>

        <div class="cat-row1">
        	<div class="grp-cat-col1 grp-cat-col">
            	<?php
						
						echo '<a href="#"><div class="grp-cat-img"> ';
						?>
						<a href="<?php echo esc_url('/author-page/?author="'. $author_name .'"&section=Official Author Website'); ?>"><img width="99" height="90" src="https://mythmachine.com/wp-content/uploads/2018/01/globe.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""></a>
						<?php 
						
						echo '</div></a>';
						echo '<h3>Official Website</h3>';

					?>
            </div>
        	<div class="grp-cat-col2 grp-cat-col">
            	<?php
						
						echo '<a href="#"><div class="grp-cat-img"> ';
						?>
						<a href="<?php echo esc_url('/author-page/?author="'. $author_name .'"&section=Blog Articles'); ?>"><img width="99" height="90" src="https://mythmachine.com/wp-content/uploads/2017/12/grp-blog.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""></a>
						<?php 
						
						echo '</div></a>';
						echo '<h3>Blog Articles</h3>';

					?>
            </div>
               <div class="grp-cat-col3 grp-cat-col">
            	<?php
						
						echo '<a href="#"><div class="grp-cat-img"> ';
						?>
						<a href="<?php echo esc_url('/author-page/?author="'. $author_name .'"&section=Social Media'); ?>"><img width="99" height="90" src="https://mythmachine.com/wp-content/uploads/2018/01/cross-sword.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""></a>
						<?php 
						
						echo '</div></a>';
						echo '<h3>Social Media</h3>';
					?>
            </div>
        </div>
     
        <div class="cat-row2">
        	<div class="grp-cat-col1 grp-cat-col">
            	<?php
						
						echo '<a href="#"><div class="grp-cat-img"> ';
						?>
						<a href="<?php echo esc_url('/author-page/?author="'. $author_name .'"&section=maps'); ?>"><img width="99" height="90" src="https://mythmachine.com/wp-content/uploads/2017/11/history-geography.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""></a>
						<?php 
						
						echo '</div></a>';
						echo '<h3>Maps</h3>';
					?>
            </div>
        	<div class="grp-cat-col2 grp-cat-col">
            	<?php
						
						echo '<a href="#"><div class="grp-cat-img"> ';
						?>
						<a href="<?php echo esc_url('/author-page/?author="'. $author_name .'"&section=shop'); ?>"><img width="99" height="90" src="https://mythmachine.com/wp-content/uploads/2018/01/shopping-cart.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""></a>
						<?php 
						
						echo '</div></a>';
						echo '<h3>Shop</h3>';
					?>
            </div>
            <div class="grp-cat-col3 grp-cat-col">
            	<?php
						
						echo '<a href="#"><div class="grp-cat-img"> ';
						?>
						<a href="<?php echo esc_url('/author-page/?author="'. $author_name .'"&section=fan_art'); ?>"><img width="99" height="90" src="https://mythmachine.com/wp-content/uploads/2017/11/arts-recreation.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""></a>
						<?php 
						
						echo '</div></a>';
						echo '<h3>Fan Art</h3>';
					?>
            </div>
        </div>
        
    
    </div>

<style>
.profile-social.rd-pro-so {
	text-align:center !important;
}

.blog-Carousel-sec {
	margin-top:28px !important;
}
.grp-cat-col {
	margin-right:4%;
	margin-left:4%;
}
.book-Carousel-sec, .blog-Carousel-sec {
	margin-top:28px !important;
	margin-bottom:50px !important;
}
.group_description{
	padding-left: 40px;
    color: #fff !important;
    padding-right: 40px;
}
</style>
