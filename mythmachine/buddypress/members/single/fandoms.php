  
            <div class="border-frame">
       <h3>my fandoms</h3>
       <a href="/groups/" class="verticl-middl btn-mid">add a fandom</a>
     </div>
<!--end of border-->
  
  <div class="row-block">
  <?php 
  if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) :
  while ( bp_groups() ) : bp_the_group(); ?>
    <div class="col-4s">
    <div class="my-fndm-books">
    <?php if ( ! bp_disable_group_avatar_uploads() ) { ?>
				<div class="item-avatar">
					<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=full&width=100&height=100' ); ?></a>
				</div>
			<?php } else { ?>
         <img src="/wp-content/uploads/2017/11/secrets_of_moldara-1.jpg" alt=""/>
         <?php } ?>
         <h4><?php bp_group_link(); ?></h4>
         <?php bp_group_description_excerpt(); ?>
       </div>
    </div>
    	<?php endwhile; 
		endif; 
		?>
<!--end of colum-->    


<!--end of colum-->    
  </div>
  
  <div class="mid-btn">
     <a href="#">Request a new fandom</a>
  </div>
<?php $current_user = get_userdata(bp_displayed_user_id());
// $current_user   = wp_get_current_user();
$role_name = $current_user->roles[0];
if ($role_name === 'author') { ?>
 <div class="mid-btn">
     <a href="/contact">Create a new fandom</a>
  </div>  
  <?php } ?>
  
  <!--END my HTML -->