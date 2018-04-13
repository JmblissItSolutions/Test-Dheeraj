<?php
/**
 * BuddyPress - Users Profile
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */
?>



<?php
/**
 * Fires before the display of member profile content.
 *
 * @since 1.1.0
 */
do_action('bp_before_profile_content'); ?>
<?php
$current_user = get_userdata(bp_displayed_user_id());
//  $current_user   = wp_get_current_user();
$role_name = $current_user->roles[0];
if ($role_name === 'subscriber') { ?>
    <?php
  switch (bp_current_action()):
    // Edit
  case 'edit':
    bp_get_template_part('members/single/profile/edit');
    break;
    // Change Avatar
  case 'change-avatar':
    bp_get_template_part('members/single/profile/change-avatar');
    break;
    // Change Cover Image
  case 'change-cover-image':
    bp_get_template_part('members/single/profile/change-cover-image');
    break;
    // Compose
  case 'public':
    // Display XProfile
    // if ( bp_is_active( 'xprofile' ) )
    //      bp_get_template_part( 'members/single/profile/profile-loop' );
    //
    //    // Display WordPress profile (fallback)
    //    else
    //      bp_get_template_part( 'members/single/profile/profile-wp' );
    break;
    // Any other
  default:
    bp_get_template_part('members/single/plugins');
    break;
  endswitch; ?>
    
    
<div class="reader-profile">
<?php
}
else if ($role_name === 'author') { ?>

<?php
  switch (bp_current_action()):
    // Edit
  case 'edit':
    bp_get_template_part('members/single/profile/edit');
    break;
    // Change Avatar
  case 'change-avatar':
    bp_get_template_part('members/single/profile/change-avatar');
    break;
    // Change Cover Image
  case 'change-cover-image':
    bp_get_template_part('members/single/profile/change-cover-image');
    break;
    // Compose
  case 'public':
    // Display XProfile
    // if ( bp_is_active( 'xprofile' ) )
    //      bp_get_template_part( 'members/single/profile/profile-loop' );
    //
    //    // Display WordPress profile (fallback)
    //    else
    //      bp_get_template_part( 'members/single/profile/profile-wp' );
    break;
    // Any other
  default:
    bp_get_template_part('members/single/plugins');
    break;
  endswitch; ?>
<div class="author-profile">
<?php
} ?>

<?php
$current_user = get_userdata(bp_displayed_user_id());
// $current_user   = wp_get_current_user();
$role_name = $current_user->roles[0];
if ($role_name === 'subscriber') { ?>
    
    
    
    
<div class="reader-profile-box">
         <div class="profile-img">
          <?php
  $current_user = get_userdata(bp_displayed_user_id());
  // $current_user   = wp_get_current_user();
  echo get_avatar($current_user->ID, 215); ?>
         </div>
 <!--end of profile image--> 
 
    <div class="profile-content">
      <h2>Profile</h2>
       <div class="left-cntn">
         <h3><?php
  echo $current_user->display_name; ?></h3>
         <div class="contct-box">
           <p><label>Email</label> <span class="names"><?php
  echo $current_user->user_email; ?></span></p>           
           <p><label>Phone</label> <span class="names"><?php
  echo $phone = xprofile_get_field_data('phone', bp_loggedin_user_id() , $multi_format = 'comma'); ?></span></p>           
           <p><label>Mobile</label> <span class="names"><?php
  echo $mobile = xprofile_get_field_data('mobile', bp_loggedin_user_id() , $multi_format = 'comma'); ?></span>
           </p>
         </div>
         <div class="profile-social rd-pro-so">
        <a href="<?php
  echo xprofile_get_field_data('facebook'); ?>"><span class="fa fa-facebook"></span></a> 
                <a href="<?php
  echo xprofile_get_field_data('twitter'); ?>"><span class="fa fa-twitter"></span></a>
                <a href="<?php
  echo xprofile_get_field_data('linkedin'); ?>"><span class="fa fa-linkedin"></span></a>
                </div>
  <!--end of contact box--> 
  
       </div>
   <!--end of left box--> 
   
<!--    <div class="right-cntn">
      <div class="col-6">
        <h4>148</h4>
        Pages read
      </div>
      
      <div class="col-6">
        <h4>5</h4>
        Books read
      </div>
 <div class="clearfix"></div>
 
 <div class="col-12">
   <a href="#"> show details </a>
 </div>     
   </div> -->
 <!--end of right box-->  
   
      
    </div>
 <!---end of profile-content-->   
     </div>
<div class="item-list-tabs no-ajax" id="subnav" aria-label="<?php
  esc_attr_e('Member secondary navigation', 'buddypress'); ?>" role="navigation">
  <ul>
    <?php
  bp_get_options_nav(); ?>
  </ul>
</div><!-- .item-list-tabs -->
     <?php
}
else if ($role_name === 'author') { ?>
<div class="author-profile-box">
         <div class="profile-img">
          <?php
  $current_user = get_userdata(bp_displayed_user_id());
  //  $current_user   = wp_get_current_user();
  echo get_avatar($current_user->ID, 215); ?>
         </div>
 <!--end of profile image--> 
 
    <div class="profile-content">
      <h2>Profile</h2>
       <div class="full-cntn">
         <h3><?php
  echo $current_user->display_name; ?></h3>
         <div class="contct-box">
           <?php
  //echo $current_user->user_description;
            echo $bio = xprofile_get_field_data('bio', bp_loggedin_user_id() , $multi_format = 'comma');
?> 
           
         </div>
  <!--end of contact box--> 
  
       </div>
   <!--end of left box--> 
   
   
 <!--end of right box-->  
   
      
    </div>
 <!---end of profile-content-->   
       
     </div>
<div class="item-list-tabs no-ajax" id="subnav" aria-label="<?php
  esc_attr_e('Member secondary navigation', 'buddypress'); ?>" role="navigation">
  <ul>
    <?php
  bp_get_options_nav(); ?>
  </ul>
</div><!-- .item-list-tabs -->

     
     <div class="book-Carousel-sec">
<h1 class="carousel-head">My Submitted Books</h1>
<div id="book-Carousel" >
 
  <?php
  $query = new WP_Query(array(
    'post_type' => 'books',
    'posts_per_page' => - 1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC',
    'author' => $current_user->ID,
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
 
 
 
 <div class="book-Carousel-sec">
<h1 class="carousel-head">my bookmarked books</h1>
<div id="bookmarked-Carousel" >
 
  <?php
  $favorites_new = WeDevs_Favorite_Posts::init()->get_favorites();
  // var_dump($favorites);
  foreach($favorites_new as $post) {
    $post_id = $post->post_id;
    $page_num = $post->page_num;
    $c_post = get_post($post_id);
?>
    <div class="item">
    <div class="book-Carousel-img">
       <a href="<?php
    echo get_the_permalink($post_id); ?><?php
    echo $page_num; ?>"><?php
    echo get_the_post_thumbnail($post_id, 'full'); ?></a>
      </div>
      <div class="book-Carousel-title"><h1><a href="<?php
    echo get_the_permalink($post_id); ?><?php
    echo $page_num; ?>"><?php
    echo $c_post->post_title; ?></a></h1></div>
      <div class="book-Carousel-author"><?php
    $autor_id = $c_post->post_author;
    echo get_the_author_meta('display_name', $author_id); ?>
      </div>
      <!-- submit review button -->
      <div class="submit-rev">
      <?php
        $dl = get_page_by_title( html_entity_decode(  $c_post->post_title ), OBJECT, 'download' );
        $dload_id = $dl->ID;
    ?>
      <a href="<?php echo get_the_permalink($dload_id); ?>"><button class="sub-prev-btn">submit a review</button></a>
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
  <?php
  echo do_shortcode('[download_history]'); ?>
 </div>

 <div class="blog-Carousel-sec">
<h1 class="blog-head">My Submitted blog</h1>
<div id="blog-Carousel" >
 
  <?php
  $query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => - 1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC',
    'author' => $current_user->ID,
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
?>
 </div>
 </div>
 
 
<!--      <div class="social-sec">
  <div class="twitter-column social-bg">
      <h1>twitter</h1>
    </div>
    <div class="facebook-column social-bg">
    <h1>facebook</h1>
    </div>
    <div class="instagram-column social-bg">
    <h1>instagram</h1>
    </div>
    
 
 </div> -->

<?php
} ?>

</div><!-- .profile -->

<?php
$current_user = get_userdata(bp_displayed_user_id());
//   $current_user   = wp_get_current_user();
$role_name = $current_user->roles[0];
if ($role_name === 'subscriber') { ?>

<div class="book-Carousel-sec">
<h1 class="carousel-head">books read</h1>
<div id="book-Carousel" >
 
  <?php
  $query = new WP_Query(array(
    'post_type' => 'books',
    'posts_per_page' => - 1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC'
  ));
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post(); ?>
  
    <div class="item">
    <div class="book-Carousel-img">
         <a href="<?php echo get_the_permalink($post_id); ?>"><?php the_post_thumbnail('full'); ?></a>
      </div>
      <div class="book-Carousel-title"><h1><a href="<?php
      the_permalink(); ?>"><?php
      the_title(); ?></a></h1></div>
      </div>

  <?php
    }
  }
  wp_reset_postdata();
?>
 </div>
 </div>
 
 <?php
} ?>

<?php
/**
 * Fires after the display of member profile content.
 *
 * @since 1.1.0
 */
do_action('bp_after_profile_content');

?>
<style>
form input[type="text"] {
  color:#000 !important;
 }
 </style>