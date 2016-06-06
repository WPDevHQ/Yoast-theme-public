<?php
$plugin_id    = get_post_meta( get_the_ID(), 'download_id', true );
$plugin_title = get_the_title( $plugin_id );
$plugin_price = edd_get_price_option_amount( $plugin_id, 0 );
if ( $plugin_price === 0.00 ) {
	$plugin_price = edd_get_price_option_amount( $plugin_id, 1 );
}

$button_text = __( 'Add to cart', 'yoastcom' );

if ( $plugin_price !== 0.00 ) :
	?>
	<div id="prices-modal">
		<h3>
			<i class="fa fa-cart-plus"
			   aria-hidden="true"></i> <?php printf( __( 'Buy %s', 'yoastcom' ), $plugin_title ); ?>
		</h3>
		<div class="content">
			<p>
				<?php _e( 'Price includes one year updates &amp; support.', 'yoastcom' ); ?><br/>
				<br/>
				<strong><?php printf( __( 'How many sites will you use %s on?', 'yoastcom' ), $plugin_title ); ?></strong><br/>
			</p>
			<?php
			if ( edd_item_in_cart( $plugin_id ) ) {
				echo '<p>' . sprintf( __( '%s is already in your cart, you can modify the number of sites you want to buy a license for there.', 'yoastcom' ), $plugin_title );
				$button_text = __( 'Go to cart', 'yoastcom' );
			}
			echo edd_get_purchase_link( array(
				'download_id' => $plugin_id,
				'text'        => $button_text . ' &raquo;',
			) );
			?>
		</div>
	</div>
<?php endif; ?>