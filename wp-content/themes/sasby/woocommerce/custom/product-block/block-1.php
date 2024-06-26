<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

global $product;
$product_id  = $product->get_id();
$product_bg    = get_post_meta( $product_id, 'sasby_product_bgc', true );
$product_bgc = "";
if( !empty($product_bg) ) {
	$product_bgc = 'style="background-color: ' . $product_bg . '"';
}
?>
<div class="rt-product-block rt-product-grid">
	<div class="rt-thumb-wrapper" <?php echo wp_specialchars_decode( esc_attr( $product_bgc ), ENT_COMPAT ); ?>>
		<div class="rt-thumb">
			<a href="<?php the_permalink();?>"><?php woocommerce_template_loop_product_thumbnail(); ?></a>
			<div class="rt-buttons">				
				<div class="btn-icons">
					<?php
						if ( SasbyTheme::$options['wc_shop_cart_icon'] ) WC_Functions::print_add_to_cart_icon( $product_id, true, true );
						$module_data = [
							'wc_shop_quickview_icon' => SasbyTheme::$options['wc_shop_quickview_icon'],
							'wc_shop_wishlist_icon' => SasbyTheme::$options['wc_shop_wishlist_icon'],
							'wc_shop_compare_icon' => SasbyTheme::$options['wc_shop_compare_icon'],
						];
						do_action('rdtheme_after_actions_button', $product, $module_data);
					?>
				</div>
			</div>
		</div>
		<?php if ( SasbyTheme::$options['wc_shop_sale_flash'] ) woocommerce_show_product_loop_sale_flash(); ?>
	</div>
	<div class="content-box">
        <?php
            $product_categories = get_the_terms( $product_id, 'product_cat' );
            if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) {
                foreach ( $product_categories as $category ) {
                    echo '<a class="rt_cat" href="' . get_term_link( $category ) . '">' . $category->name . '</a><br>';
                }
            }
        ?>
		<div class="rt-title-area">
			<h2 class="rt-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
		</div>

		<?php if ( SasbyTheme::$options['wc_shop_rating'] == 1 ) { ?>
		<div class="rating-custom">
			<?php wc_get_template( 'rating.php' ); ?>
		</div>
		<?php } ?>
        <div class="rt-price-area">
			<?php if ( $price_html = $product->get_price_html() ) : ?>
                <div class="rt-price"><?php echo wp_kses_post( $price_html ); ?></div>
			<?php endif; ?>
        </div>
		<?php woocommerce_template_loop_add_to_cart(); ?>

	</div>
</div>