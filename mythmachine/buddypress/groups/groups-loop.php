<?php
/**
 * BuddyPress - Groups Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter().
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */
//do_action( 'bp_before_groups_loop' );
?>




	<div class="fcrd-fn-col et_pb_row et_pb_row_2">	
	  <div class="pag-count" id="group-dir-count">
            <?php bp_groups_pagination_count(); ?>
        </div>	
<?php 
$args2 = array(
      'per_page' => 3,
);

if ( bp_has_groups( $args2 ) ) : ?>

	<?php while ( bp_groups() ) : bp_the_group(); ?>

				<div class="grp-item et_pb_column et_pb_column_1_3  et_pb_column_2">
				<div class="group-box et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_2">
					<div class="et_pb_text_inner">
					<div class="fcrd-col">
<div class="col-overl">
	<div class="item-avatar">
	 <?php if ( ! bp_disable_group_avatar_uploads() ) { ?>
	 <a href="<?php bp_group_permalink(); ?>">
	<?php bp_group_avatar( 'type=full&width=250&height=200' ); } ?></a>
	</div>
	<div class="avatar-detial">
		<h2><a href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a></h2>
		<?php bp_group_description_excerpt(); ?>
	</div>
</div>
</div>
				</div>
			</div> <!-- .et_pb_text -->
			</div> <!-- .et_pb_column -->
	<?php endwhile; ?>

	 <?php do_action( 'bp_after_groups_loop' ) ?>
</div><!-- END OF GROUP ROW -->
	<?php

	/**
	 * Fires after the listing of the groups list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_groups_list' ); ?>


<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There were no groups found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>
	<div class="grp-pagination">
		<div class="pagination-links" id="group-dir-pag">
            <?php bp_groups_pagination_links(); ?>
        </div>
    </div>
<?php

/**
 * Fires after the display of groups from the groups loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_groups_loop' );
?>
<br />
            <div class="fandom-info-btn" style="text-align:center;"><a href="/contact/">+ Request New Fandom</a></div>
            <br />


<!-- CATEGORY DIV START -->
<!-- <div class="fcrd-bot-sec et_pb_row et_pb_row_4">
				<div class="et_pb_column et_pb_column_4_4  et_pb_column_8 et-last-child">
				
				
				<div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_8">
				
				
				<div class="et_pb_text_inner">
					<div class="fcrd-last-categ">
<div class="fcrd-last-title">
<h1>Explore More fandoms from following categories</h1>
<p></p></div>
<div class="fcrd-all-cat">
<ul>
	<?php
// $array = bp_groups_get_group_types( $args, $output, $operator );

//  foreach ($array as $arr) {
//  	//print_r($arr);
//  	$tname = $arr->labels['name']; 
// 		if($tname !== "Featured"){
?>
<li class="cat-li"><a href="#">
<div class="cat-over">
<p><img src="/wp-content/uploads/2017/11/hunger-games-cat.png"></p>
<p><?php //echo $tname; ?></p>
</div>
</a><p><a href="#"></a></p></li>
<?php
?>
</ul>
</div>
</div>
				</div>
			</div> <!-- .et_pb_text -->
			</div> <!-- .et_pb_column -->
				
				
			</div> 
<!-- cATEGORY eND -->