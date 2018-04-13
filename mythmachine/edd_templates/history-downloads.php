<?php if( ! empty( $_GET['edd-verify-success'] ) ) : ?>
<p class="edd-account-verified edd_success">
	<?php _e( 'Your account has been successfully verified!', 'easy-digital-downloads' ); ?>
</p>
<?php
endif;
/**
 * This template is used to display the download history of the current user.
 */
$purchases = edd_get_users_purchases( get_current_user_id(), 20, true, 'any' );
if ( $purchases ) :
	do_action( 'edd_before_download_history' ); ?>
<div id="book-lib-Carousel" >

		<?php foreach ( $purchases as $payment ) :
			$downloads      = edd_get_payment_meta_cart_details( $payment->ID, true );
			$purchase_data  = edd_get_payment_meta( $payment->ID );
			$email          = edd_get_payment_user_email( $payment->ID );

			if ( $downloads ) :
				foreach ( $downloads as $download ) :

					// Skip over Bundles. Products included with a bundle will be displayed individually
					if ( edd_is_bundled_product( $download['id'] ) )
						continue; ?>

					<div class="item">
						<?php
						$price_id       = edd_get_cart_item_price_id( $download );
						$download_files = edd_get_download_files( $download['id'], $price_id );
						$name           = $download['name'];

						// Retrieve and append the price option name
						if ( ! empty( $price_id ) && 0 !== $price_id ) {
							$name .= ' - ' . edd_get_price_option_name( $download['id'], $price_id, $payment->ID );
						}

						do_action( 'edd_download_history_row_start', $payment->ID, $download['id'] );
						?>
						  	<div class="book-Carousel-img"><img src="<?php 
						$src = wp_get_attachment_image_src( get_post_thumbnail_id($download['id']), 'full' );
						$url = $src[0];
						echo $url; ?>">
						</div>
						<div class="book-Carousel-title">
							<?php echo esc_html( $name ); ?>
						</div>
						<?php if ( ! edd_no_redownload() ) : ?>
							<div class="book-Carousel-author">
								<?php

								if ( 'publish' == $payment->post_status ) :

									if ( $download_files ) :

										foreach ( $download_files as $filekey => $file ) :

											$download_url = edd_get_download_file_url( $purchase_data['key'], $email, $filekey, $download['id'], $price_id );
											?>

											
												<a href="<?php echo esc_url( $download_url ); ?>" class="edd_download_file_link button primary-button">
													Click to Download
												</a>
											

											<?php do_action( 'edd_download_history_files', $filekey, $file, $id, $payment->ID, $purchase_data );
										endforeach;

									else :
										_e( 'No downloadable files found.', 'easy-digital-downloads' );
									endif; // End if payment complete

								else : ?>
									<span class="edd_download_payment_status">
										<?php printf( __( 'Payment status is %s', 'easy-digital-downloads' ), edd_get_payment_status( $payment, true) ); ?>
									</span>
									<?php
								endif; // End if $download_files
								?>
							</div>
							 <!-- submit review button -->
								      <div class="submit-rev">
								      <a href="<?php echo get_the_permalink( $download['id'] ); ?>"><button class="sub-prev-btn">submit a review</button></a>
								      </div>
						<?php endif; // End if ! edd_no_redownload()

						do_action( 'edd_download_history_row_end', $payment->ID, $download['id'] );
						?></div><?php
				endforeach; // End foreach $downloads
			endif; // End if $downloads
		endforeach;
		?>

	<?php do_action( 'edd_after_download_history' ); ?>
		      </div>

<?php else : ?>
	<p class="edd-no-downloads"><?php _e( 'You have not purchased any books, but hey! go ahead and buy one now', 'easy-digital-downloads' ); ?></p>
<?php endif; ?>

