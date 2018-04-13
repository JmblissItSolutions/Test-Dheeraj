<?php
/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of the members loop.
 *
 * @since 1.2.0
 */

if ( isset($_GET['author']) && !isset($_GET['section']) ) {
	include('members-profile.php');
}else{
do_action( 'bp_before_members_loop' ); ?>

<?php if ( bp_get_current_member_type() ) : ?>
	<p class="current-member-type"><?php bp_current_member_type_message() ?></p>
<?php endif; ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ).'per_page=10' ) ) : 


	/**
	 * Fires before the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_members_list' ); ?>

	<ul id="members-list" class="item-list" aria-live="assertive" aria-relevant="all">

	<?php while ( bp_members() ) : bp_the_member(); ?>

		<li <?php bp_member_class(); ?>>
			<?php $member_type = bp_get_member_type( bp_get_member_user_id(), false ); ?>
			<div class="badge_<?php echo $member_type[0]; ?>">
			<span><?php echo $member_type[0]; ?></span>
			</div>

			<div class="item">

			<div class="item-avatar">
				<?php if ( $member_type[0] == 'author' ){ ?>
					<a href="<?php echo '/members/?author='. bp_core_get_username( bp_get_member_user_id() ); ?>"><?php  bp_member_avatar( 'type=thumb&height=150&width=150' ); ?></a>
				<?php }else{
					bp_member_avatar( 'type=thumb&height=150&width=150' );
				}
				?>
				<br />
				<?php if ( $member_type[0] == 'author' ){ ?>
					<a href="<a href="<?php echo '/members/?author='. bp_core_get_username( bp_get_member_user_id() ); ?>"><?php bp_member_name(); ?></a>
				<?php }else{
					bp_member_name();
				}
			?>
         <div class="profile-social rd-pro-so">
        <a href="<?php
  echo ( xprofile_get_field_data('facebook',bp_get_member_user_id() ) ) ? xprofile_get_field_data('facebook',bp_get_member_user_id() ) : '#' ?>"><span class="fa fa-facebook"></span></a> 
                <a href="<?php
  echo ( xprofile_get_field_data('twitter',bp_get_member_user_id() ) ) ? xprofile_get_field_data('twitter',bp_get_member_user_id() ) : '#' ?>"><span class="fa fa-twitter"></span></a>
                <a href="<?php
  echo ( xprofile_get_field_data('linkedin',bp_get_member_user_id() ) ) ? xprofile_get_field_data('linkedin',bp_get_member_user_id() ) : '#' ?>"><span class="fa fa-linkedin"></span></a>
                </div>
  <!--end of contact box--> 

				</div>

				<?php

				/**
				 * Fires inside the display of a directory member item.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_members_item' ); ?>
				<div class="item_bio">
					<h3 style="color:#000;font-weight:bold;">BIO</h3>
				<?php if ( $member_type[0] == 'author' ){ 
				 echo  ( xprofile_get_field_data('Bio', bp_get_member_user_id() , $multi_format = 'comma') ) ? xprofile_get_field_data('Bio', bp_get_member_user_id() , $multi_format = 'comma') : "This user has not added Bio yet";
				}else{
				echo  ( xprofile_get_field_data('Reader Bio', bp_get_member_user_id() , $multi_format = 'comma') ) ? xprofile_get_field_data('Reader Bio', bp_get_member_user_id() , $multi_format = 'comma') : "This user has not added Bio yet";
				}
				?>
			</div>
				<div class="item_bio">
					<h3 style="color:#000;font-weight:bold;">Top 5 Books</h3>
				<?php
				 echo  ( xprofile_get_field_data('Top 5 Books', bp_get_member_user_id() , $multi_format = 'comma') ) ? xprofile_get_field_data('Top 5 Books', bp_get_member_user_id() , $multi_format = 'comma') : "This user has not added Top 5 Books yet";
				?>
			</div>			
			</div>

 
			<div class="action">

				<?php

				/**
				 * Fires inside the members action HTML markup to display actions.
				 *
				 * @since 1.1.0
				 */
				do_action( 'bp_directory_members_actions' ); ?>

			</div>

			<div class="clear"></div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php

	/**
	 * Fires after the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-dir-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( "Sorry, no members were found.", 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php

/**
 * Fires after the display of the members loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_members_loop' );
?>

<style>
.item-avatar {
	float:left;
	width:200px;
	text-transform:uppercase;
}
.item_bio{
    padding: 24px;
    width: 70%;
    float: left;

}
.item{
background: url(/wp-content/themes/mythmachine/images/bg-reader-board.png) no-repeat center top !important;
    background-size: 100% 100% !important;
    background-repeat: no-repeat !important;
	float:left;
	width:100%;
	color:#000 !important;
}
.item a{
	color:#000 !important;
}
#buddypress div.dir-search{
	margin-bottom:10px;
}
div#content-area {
	padding:20px;
	margin-bottom:20px;
}
#buddypress div.pagination {
	background: #fff;
    font-size: 20px;
    color: #000;
}
#members-directory-form{
	margin-top:10px;
	padding:0px;
}
#buddypress ul.item-list li {
	margin-top:10px;
	margin-bottom:20px;
	border:0px !important;
	padding:0px;
}
#buddypress ul.item-list {
	border:0px !important;
}
#buddypress ul.item-list li img.avatar {
	float:none !important;
}

.badge_author {
  background-color: #2ea3f2;
  box-shadow: 0 0 3px 2px rgba(0,0,0,0.8);
  height: 100px;
  right: -50px;
  position: absolute;
  top: -50px;
  width: 100px;
  
  -webkit-transform: rotate(45deg);
}

.badge_author span {
    color: #fff;
    font-family: sans-serif;
    font-size: 1.005em;
    right: 0px;
    top: 74px;
    position: absolute;
    width: 80px;
}

.badge_reader {
  background-color: #808080;
  box-shadow: 0 0 3px 2px rgba(0,0,0,0.8);
  height: 100px;
  right: -50px;
  position: absolute;
  top: -50px;
  width: 100px;
  
  -webkit-transform: rotate(45deg);
}

.badge_reader span {
    color: #fff;
    font-family: sans-serif;
    font-size: 1.005em;
    right: 0px;
    top: 74px;
    position: absolute;
    width: 80px;
}
@media only screen and (max-width: 480px) {
#buddypress div.dir-search {
	display:none !important;
}
#buddypress h1 {
	font-size:20px;
}
.item_bio {
    padding: 10px;
    width: 80%;
    float: left;
    font-size: 12px;
    line-height: 1;
}
.profile-social.rd-pro-so {
	text-align:left;
}
.item-avatar{
	padding:10px;
}
#buddypress div.pagination {
	font-size:12px;
	text-align:center;
}
#buddypress div.pagination .pagination-links {
	float:none;
}
}
</style>

<?php 
} 