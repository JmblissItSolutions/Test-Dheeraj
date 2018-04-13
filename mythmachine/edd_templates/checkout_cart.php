<?php
/**
 *  This template is used to display the Checkout page when items are in the cart
 */

global $post; ?>
<?php 
/*
*
** For show current cart book details
*	@author : D
*/


$cart_items = edd_get_cart_contents(); 
 do_action( 'edd_cart_items_before' ); 
 	 if ( $cart_items ) : 
 	  foreach ( $cart_items as $key => $item ) :
 	  	$itemcont = get_post_field('post_content', $item['id'] );
 	  	$item_title = edd_get_cart_item_name( $item );
 	   ?>
		<div class="right-book-sec">
			<div class="cart-item-body">
				<div class="curr-book-img">
					<?php echo get_the_post_thumbnail( $item['id'], apply_filters( 'edd_checkout_image_size', array( 150,300 ) ) ); 
					// print_r($item); ?>
				</div>
				<div class="curr-book-desc">
				<?php	echo '<h3 class="edd_checkout_cart_item_title item-cart-name">' . esc_html( $item_title ) . '</h3>'; 
					//echo $itemcont;
				?>
				<div class="item-footer-cart">
				<span class="cart-item-price">
				<?php	echo 'price: '.edd_cart_item_price( $item['id'], $item['options'] );
						do_action( 'edd_checkout_cart_item_price_after', $item ); ?>
				</span>
				<span class="cart-item-remove">
				<a class="edd_cart_remove_item_btn" href="<?php echo esc_url( edd_remove_item_url( $key ) ); ?>"><?php _e( 'Remove', 'easy-digital-downloads' ); ?></a>
				</span>
			</div><!-- End footer items -->
				</div>
			</div>
			
		</div><!-- End Of Right Section  -->
			<?php endforeach;  endif; ?>
<?php do_action( 'edd_cart_items_after' ); ?>




