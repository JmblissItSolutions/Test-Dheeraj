<?php
/**
 * BuddyPress - Members
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires at the top of the members directory template file.
 *
 * @since 1.5.0
 */
do_action( 'bp_before_directory_members_page' ); ?>

<div id="buddypress">

	<?php

	/**
	 * Fires before the display of the members.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_members' ); ?>

	<?php

	/**
	 * Fires before the display of the members content.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_members_content' ); ?>
	<?php if (!isset($_GET['author']) ) { ?>
	<a href="/members/"><h1 style="color:#fff;font-weight:bold;">Community Directory</h1></a>
	<?php /* Backward compatibility for inline search form. Use template part instead. */ ?>
	<?php if ( has_filter( 'bp_directory_members_search_form' ) ) : ?>

		<div id="members-dir-search" class="dir-search" role="search">
			<?php bp_directory_members_search_form(); ?>
		</div><!-- #members-dir-search -->

	<?php else: ?>

		<?php bp_get_template_part( 'common/search/dir-search-form' ); ?>

	<?php endif; ?>
	<?php } ?>

	<?php
	/**
	 * Fires before the display of the members list tabs.
	 *
	 * @since 1.8.0
	 */
	do_action( 'bp_before_directory_members_tabs' ); ?>

	<form action="" method="post" id="members-directory-form" class="dir-form">



		<div class="item-list-tabs" id="subnav" aria-label="<?php esc_attr_e( 'Members directory secondary navigation', 'buddypress' ); ?>" role="navigation">
			<ul>
				<?php

				/**
				 * Fires inside the members directory member sub-types.
				 *
				 * @since 1.5.0
				 */
				do_action( 'bp_members_directory_member_sub_types' ); ?>

			</ul>
		</div>

		<h2 class="bp-screen-reader-text"><?php
			/* translators: accessibility text */
			_e( 'Members directory', 'buddypress' );
		?></h2>

		<div id="members-dir-list" class="members dir-list">
			<?php bp_get_template_part( 'members/members-loop' ); ?>
		</div><!-- #members-dir-list -->

		<?php

		/**
		 * Fires and displays the members content.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_directory_members_content' ); ?>

		<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

		<?php

		/**
		 * Fires after the display of the members content.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_after_directory_members_content' ); ?>

	</form><!-- #members-directory-form -->

	<?php

	/**
	 * Fires after the display of the members.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_members' ); ?>

</div><!-- #buddypress -->

<?php

/**
 * Fires at the bottom of the members directory template file.
 *
 * @since 1.5.0
 */
do_action( 'bp_after_directory_members_page' );
?>
<style>
#members_search_submit{
	float:left;
	padding:17px !important;
}
#members_search{
	float:left;
	width:70%;
	color:#444 !important;
}
</style>