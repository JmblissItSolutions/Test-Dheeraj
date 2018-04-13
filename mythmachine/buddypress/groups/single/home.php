<?php
/**
 * BuddyPress - Groups Home
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>
<div id="buddypress" class="title-fandom">

	<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>

	<?php

	/**
	 * Fires before the display of the group home content.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_before_group_home_content' ); ?>

	<div id="item-header" role="complementary">

		<?php
		/**
		 * If the cover image feature is enabled, use a specific header
		 */
		if ( bp_group_use_cover_image_header() ) :
			bp_get_template_part( 'groups/single/cover-image-header' );
		else :
			bp_get_template_part( 'groups/single/group-header' );
		endif;
		?>

	</div><!-- #item-header -->
    
 <div class="blog-Carousel-sec">
<h1 class="blog-head">Recent blog</h1>
<div id="blog-Carousel" >
 
  <?php
          $group_name = strtolower(bp_get_group_slug());

  $query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => - 1,
    'post_status' => 'publish',
    'orderby' => 'publish_date',
    'order' => 'DESC',
	'tax_query' => array(
			        'relation' => 'AND',
			        array(
			            'taxonomy' => 'category',
			            'field' => 'slug',
			            'terms' => $group_name,
			        )
			    ),

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
 <br />   
    <div class="group-category-sec max-wd-set">
    	<h2>top things to do</h2>
        <p class="sub_head">Start exploring your fandom and do the most interesting things </p>
        <?php        
        //echo $group_name;
		$args = array(
		    'post_type' => 'fandom',
		    'posts_per_page' => 6,
		    'tax_query' => array(
		        'relation' => 'AND',
		        array(
		            'taxonomy' => 'fandom_category',
		            'field' => 'slug',
		            'terms' => $group_name,
		        )
		    )
		);
		$count = 1;
		$my_query = null;
        $my_query = new Wp_Query($args);
        ?>
        <div class="cat-row1">
        <?php 
        if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); 
         ?>
        	<div class="grp-cat-col<?php echo $count; ?> grp-cat-col">
            	<?php
						
						echo '<a href="' . get_the_permalink() . '" title="' . sprintf( __( "%s" ), get_the_title() ) . '" ' . '><div class="grp-cat-img"> ';
						
						the_post_thumbnail();
						//echo '<h2>'. the_title().'</h2>';
						
						echo '</div></a>';
						echo '<h3>'. the_title().'</h3>';
						$count++;
					?>
            	
            
            </div>
        <?php endwhile; endif;?>
        </div>
        
<!--         	<div class="meet-author-btn"><a href="#">Meet Authors Writing for This Fandom</a></div>
 --> 
 <br />           <div class="fandom-info-btn"><a href="/contact/">+ Submit fandom info</a></div>
        
    
    </div>
    

	<!--<div id="item-nav">
		<div class="item-list-tabs no-ajax" id="object-nav" aria-label="<?php esc_attr_e( 'Group primary navigation', 'buddypress' ); ?>" role="navigation">
			<ul>

				<?php bp_get_options_nav(); ?>

				<?php

				/**
				 * Fires after the display of group options navigation.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_group_options_nav' ); ?>

			</ul>
		</div>
	</div>--><!-- #item-nav -->

	<div id="item-body">

		<?php

		/**
		 * Fires before the display of the group home body.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_before_group_body' );

		/**
		 * Does this next bit look familiar? If not, go check out WordPress's
		 * /wp-includes/template-loader.php file.
		 *
		 * @todo A real template hierarchy? Gasp!
		 */

			// Looking at home location
			if ( bp_is_group_home() ) :

				if ( bp_group_is_visible() ) {

					// Load appropriate front template
					bp_groups_front_template_part();

				} else {

					/**
					 * Fires before the display of the group status message.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_before_group_status_message' ); ?>

					<div id="message" class="info">
						<p><?php bp_group_status_message(); ?></p>
					</div>

					<?php

					/**
					 * Fires after the display of the group status message.
					 *
					 * @since 1.1.0
					 */
					do_action( 'bp_after_group_status_message' );

				}

			// Not looking at home
			else :

				// Group Admin
				if     ( bp_is_group_admin_page() ) : bp_get_template_part( 'groups/single/admin'        );

				// Group Activity
				elseif ( bp_is_group_activity()   ) : bp_get_template_part( 'groups/single/activity'     );

				// Group Members
				elseif ( bp_is_group_members()    ) : bp_groups_members_template_part();

				// Group Invitations
				elseif ( bp_is_group_invites()    ) : bp_get_template_part( 'groups/single/send-invites' );

				// Old group forums
				elseif ( bp_is_group_forum()      ) : bp_get_template_part( 'groups/single/forum'        );

				// Membership request
				elseif ( bp_is_group_membership_request() ) : bp_get_template_part( 'groups/single/request-membership' );

				// Anything else (plugins mostly)
				else                                : bp_get_template_part( 'groups/single/plugins'      );

				endif;

			endif;

		/**
		 * Fires after the display of the group home body.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_after_group_body' ); ?>

	</div><!-- #item-body -->

	<?php

	/**
	 * Fires after the display of the group home content.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_group_home_content' ); ?>

	<?php endwhile; endif; ?>
    

</div><!-- #buddypress -->

<style>
.blog-Carousel-sec {
	margin-top:28px !important;
}
.grp-cat-col {
	margin-right:4%;
	margin-left:4%;
}
</style>

