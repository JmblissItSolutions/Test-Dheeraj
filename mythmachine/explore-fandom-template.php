<?php /* Template Name: Explore Fandom Template */ ?>
<?php get_header(); ?>
Explore FAndom


<?php 
$args = array(
     'type' => 'random',
     'max' => 3,
     'user_id' => $user_id
);
if ( bp_has_groups( $args ) ) : ?>
 
  <!--   <div class="pagination">
 
        <div class="pag-count" id="group-dir-count">
            <?php bp_groups_pagination_count() ?>
        </div>
 
        <div class="pagination-links" id="group-dir-pag">
            <?php bp_groups_pagination_links() ?>
        </div>
 
    </div> -->
    <div id="container">
 <div class="row-block">
    <?php while ( bp_groups() ) : bp_the_group(); ?>
    	<!-- MY CODE START -->

   <div class="col-4s">
    <div class="my-fndm-books">
    <?php if ( ! bp_disable_group_avatar_uploads() ) { ?>
				<div class="item-avatar">
					<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=50&height=50' ); ?></a>
				</div>
			<?php } else { ?>
         <img src="/wp-content/uploads/2017/11/secrets_of_moldara-1.jpg" alt=""/>
         <?php } ?>
         <h4><a href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a></h4>
         <?php bp_group_description_excerpt(); ?>
       </div>
    </div>
</div>
</div>
    <!-- MY CODE END -->
            <div class="clear"></div>
  
    <?php endwhile; ?>
 
    <?php do_action( 'bp_after_groups_loop' ) ?>
 
<?php else: ?>
 
    <div id="message" class="info">
        <p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div>
 
<?php endif; ?>
<?php
 $array = bp_groups_get_group_types( $args, $output, $operator );
// print_r($array);
?>
<?php get_footer(); ?>