<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
use Rtrs\Models\Review; 
use Rtrs\Helpers\Functions; 

class WC_Functions {

	protected static $instance = null;

	public function __construct() {
		/* Theme supports for WooCommerce */
		add_action( 'after_setup_theme', array( $this, 'theme_support' ) );
		add_filter( 'body_class', array( $this, 'body_classes' ) );

		/* Shop builder support */
		add_action('rdtheme_after_actions_button', [$this, 'actions_button_control' ], 10, 2 );

		/* ====== Shop/Archive Wrapper ====== */
		// Remove
		add_filter( 'woocommerce_show_page_title',        '__return_false' );
		remove_action( 'woo_main_before',                 'woo_display_breadcrumbs', 10 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_sidebar',             'woocommerce_get_sidebar', 10 );
		remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10 );
		remove_action( 'woocommerce_after_shop_loop',     'woocommerce_pagination', 10 );
		// Add
		add_action( 'woocommerce_before_main_content',     array( $this, 'wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content',      array( $this, 'wrapper_end' ), 10 );
		add_action( 'loop_shop_per_page',                  array( $this, 'sasby_loop_shop_per_page' ), 20 );
		add_action( 'woocommerce_after_shop_loop',         array( $this, 'sasby_products_paginations' ), 10 );
		// Columns
		add_filter( 'loop_shop_columns',                    array( $this, 'loop_shop_columns' ) );

		/* ====== Shop/Details ====== */
		remove_action( 'woocommerce_product_description_heading',  '__return_null' );
		remove_action( 'woocommerce_after_single_product_summary',  'woocommerce_upsell_display', 15 );

		/* Shop top tab */
		remove_action( 'woocommerce_before_shop_loop',                 'woocommerce_result_count', 20 );
		remove_action( 'woocommerce_before_shop_loop',                 'woocommerce_catalog_ordering', 30 );
		add_action( 'woocommerce_before_shop_loop',                    array( $this, 'shop_topbar' ), 20 );


		// Single Product Layout
		add_action( 'init', array( $this, 'single_product_layout_hooks' ) );
		// Hide some tab headings
		add_filter( 'woocommerce_product_description_heading',            '__return_false' );
		add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
		// Single product review
		add_filter( 'woocommerce_product_review_comment_form_args',    array( $this, 'product_review_form' ) );

		/* ====== Checkout Page ====== */
		add_filter( 'woocommerce_checkout_fields', array( $this, 'sasby_checkout_fields' ) );

		/* ====== Mini Cart ====== */
		add_action( 'sasby_woo_cart_icon', array( $this, 'sasby_wc_cart_count' ) );
		add_action( 'woocommerce_add_to_cart_fragments', array( $this, 'sasby_header_add_to_cart_fragment' ) );
		add_action( 'wp_ajax_sasby_product_remove', array( $this, 'sasby_product_remove' ) );
        add_action( 'wp_ajax_nopriv_sasby_product_remove', array( $this, 'sasby_product_remove' ) );
	}


	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function theme_support() {
		add_theme_support( 'woocommerce', 
			array(
				// 'gallery_thumbnail_image_width' => 150,
			) 
		);
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_post_type_support( 'product', 'page-attributes' );
	}

	/*body class*/
	public function body_classes( $classes ) {
		if( isset( $_GET["shopview"] ) && $_GET["shopview"] == 'list' ) {
			$classes[] = 'product-list-view';
		}
		else {
			$classes[] = 'product-grid-view';
		}
		return $classes;
	}

	public function wrapper_start() {
		self::get_custom_template_part( 'shop-header' );
	}

	public function wrapper_end() {
		self::get_custom_template_part( 'shop-footer' );
	}

	public function shop_topbar() {
		self::get_custom_template_part( 'shop-top' );
	}

	public function loop_shop_columns(){
		if( isset($_GET["shopview"]) && $_GET["shopview"] == 'list' ) {
			$cols = 1;
		}else {
			$cols = SasbyTheme::$options['products_cols_width'];
		}
		return $cols;
	}

	public function sasby_products_paginations(){
		SasbyTheme_Helper::pagination();
	}

	// Template Loader
	public static function get_template_part( $template, $args = array() ){
		extract( $args );
		$template = '/' . $template . '.php';
		if ( file_exists( get_stylesheet_directory() . $template ) ) {
			$file = get_stylesheet_directory() . $template;
		}
		else {
			$file = get_template_directory() . $template;
		}
		require $file;
	}
	public static function get_custom_template_part( $template, $args = array() ){
		$template = 'woocommerce/custom/template-parts/' . $template;
		self::get_template_part( $template, $args );
	} 

	/* = Single Page
	=============================================================================*/
	public function single_product_layout_hooks() {
		// Remove Action
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		// Add Action

		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );

		add_action('rdtheme_after_actions_button_product_page', [$this, 'single_meta_actions_button' ], 10, 2 );

		add_action( 'woocommerce_single_product_summary', function(){
			global $product;
			$module_data = [
				'wc_shop_wishlist_icon' => SasbyTheme::$options['wc_product_wishlist_icon'],
				'wc_shop_compare_icon' => SasbyTheme::$options['wc_product_compare_icon'],
			];?>
			<div class="single-product-yith"><?php do_action('rdtheme_after_actions_button_product_page', $product, $module_data); ?></div>
			<?php
		}, 31 );

		// Add to cart button
		add_action( 'woocommerce_before_add_to_cart_button', array( $this, 'add_to_cart_button_wrapper_start' ), 3 );
		add_action( 'woocommerce_after_add_to_cart_button',  array( $this, 'add_to_cart_button_wrapper_end' ), 90 );
	}

	public function add_to_cart_button_wrapper_start(){
		echo '<div class="single-add-to-cart-wrapper">';
	}

	public function add_to_cart_button_wrapper_end(){
		echo '</div>';
	}
 
	/* = Shop Page
	=============================================================================*/
	public static function get_product_thumbnail( $product, $thumb_size = 'woocommerce_thumbnail' ) {
		$thumbnail   = $product->get_image( $thumb_size, array(), false );
		if ( !$thumbnail ) {
			$thumbnail = wc_placeholder_img( $thumb_size );
		}
		return $thumbnail;
	}
	public static function get_product_thumbnail_link( $product, $thumb_size = 'woocommerce_thumbnail' ) {
		return '<a href="'.esc_attr( $product->get_permalink() ).'">'.self::get_product_thumbnail( $product, $thumb_size ).'</a>';
	}
	public static function print_add_to_cart_icon( $product_id, $icon = true, $text = true ){
		global $product;
		$quantity = 1;
		$class = implode( ' ', array_filter( array(
			'action-cart',
			'product_type_' . $product->get_type(),
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
		) ) );

		$html = '';

		$product_cart_id = WC()->cart->generate_cart_id( $product_id );
	    $in_cart = WC()->cart->find_product_in_cart( $product_cart_id );

		if ( $in_cart ) {
			if ( $text ) {
				$html .= '<i class="fas fa-check"></i>';
			}
		} else {
			if ( $icon ) {
				$html .= '<i class="icon-sasby-cart"></i>';
			}
			if ( $text ) {
				$html .= '<span>' . $product->add_to_cart_text() . '</span>';
			}
		}
		
	    if ( $in_cart ) {
			echo sprintf( '<a rel="nofollow" title="%s" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s">' . $html . '</a>',
				esc_attr( $product->add_to_cart_text() ),
				esc_url( wc_get_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() )
			);
		} else {
			echo sprintf( '<a rel="nofollow" title="%s" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">' . $html . '</a>',
				esc_attr( $product->add_to_cart_text() ),
				esc_url( $product->add_to_cart_url() ),
				esc_attr( isset( $quantity ) ? $quantity : 1 ),
				esc_attr( $product->get_id() ),
				esc_attr( $product->get_sku() ),
				esc_attr( isset( $class ) ? $class : 'action-cart' )
			);
		}
	}

    public function sasby_loop_shop_per_page( $products ) {
        $shop_posts_per_page = SasbyTheme::$options['products_per_page'];
        if (!empty($shop_posts_per_page)) {
           $products = $shop_posts_per_page;
        } else {
            $products = '9';
        }
        return $products;
    }

	public static function sasby_product_social_share(){
		$url   = urlencode( get_permalink() );
		$title = urlencode( get_the_title() );
		$defaults = array(
			'facebook' => array(
				'url'  => "http://www.facebook.com/sharer.php?u=$url",
				'icon' => 'fab fa-facebook-f',
				'class' => 'bg-fb'
			),
			'twitter'  => array(
				'url'  => "https://twitter.com/intent/tweet?source=$url&text=$title:$url",
				'icon' => 'fab fa-twitter',
				'class' => 'bg-twitter'
			),
			'linkedin' => array(
				'url'  => "http://www.linkedin.com/shareArticle?mini=true&url=$url&title=$title",
				'icon' => 'fab fa-linkedin-in',
				'class' => 'bg-linked'
			),
			'pinterest'=> array( 
				'url'  => "http://pinterest.com/pin/create/button/?url=$url&description=$title",
				'icon' => 'fab fa-pinterest-square',
				'class' => 'bg-pinterst'
			),
		);

		foreach ( $defaults as $key => $value ) {
			if ( !$value ) {
				unset( $defaults[$key] );
			}
		}
		$sharers = apply_filters( 'rdtheme_social_sharing_icons', $defaults );
		?>
		<div class="post-share-btn">
			<h5 class="item-label"><?php esc_html_e( 'Share:', 'sasby' );?></h5>
			<div class="post-social-sharing">
				<ul class="item-social">
					<?php foreach ( $sharers as $key => $sharer ){ ?>
		            <li>
		            	<a href="<?php echo esc_url( $sharer['url'] );?>" class="<?php echo esc_attr( $sharer['class'] );?>">
		            		<i class="<?php echo esc_attr( $sharer['icon'] );?>"></i>
		            	</a>
		            </li>
		            <?php } ?>
		        </ul>
			</div>
		</div>
	<?php }

	public static function get_stock_status() {
		global $product;
		return $product->is_in_stock() ? esc_html__( 'In Stock', 'sasby' ) : esc_html__( 'Out of Stock', 'sasby' );
	}

	public function product_review_form( $comment_form ){
		$commenter = wp_get_current_commenter();
		$comment_form['fields'] = array(
			'author' => '<div class="row"><div class="col-sm-6"><div class="comment-form-author form-group"><input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__( 'Name *', 'sasby' ) . '" required /></div></div>',
			'email'  => '<div class="comment-form-email col-sm-6"><div class="form-group"><input id="email" class="form-control" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__( 'Email *', 'sasby' ) . '" required /></div></div></div>',
		);

		$comment_form['comment_field'] = '';

		if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating', 'sasby' ) .'</label>
			<select name="rating" id="rating" required>
			<option value="">' . esc_html__( 'Rate&hellip;', 'sasby' ) . '</option>
			<option value="5">' . esc_html__( 'Perfect', 'sasby' ) . '</option>
			<option value="4">' . esc_html__( 'Good', 'sasby' ) . '</option>
			<option value="3">' . esc_html__( 'Average', 'sasby' ) . '</option>
			<option value="2">' . esc_html__( 'Not that bad', 'sasby' ) . '</option>
			<option value="1">' . esc_html__( 'Very Poor', 'sasby' ) . '</option>
			</select></p>';
		}

		$comment_form['comment_field'] .= '<div class="form-group comment-form-comment"><textarea id="comment" name="comment" class="form-control" placeholder="' . esc_attr__( 'Your Review *', 'sasby' ) . '" cols="45" rows="8" required></textarea></div>';

		return $comment_form;
	}

	// WooCommerce Checkout Fields Hook
    public function sasby_checkout_fields( $fields ) {
        $fields['billing']['billing_first_name']['placeholder'] = 'First Name';
        $fields['billing']['billing_first_name']['label'] = false;
        $fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
        $fields['billing']['billing_last_name']['label'] = false;

        $fields['billing']['billing_company']['placeholder'] = 'Company Name';
        $fields['billing']['billing_company']['label'] = false;

        $fields['billing']['billing_country']['placeholder'] = 'Country';
        $fields['billing']['billing_country']['label'] = 'Select Your Country';

        $fields['billing']['billing_address_1']['placeholder'] = 'Street Address';
        $fields['billing']['billing_address_1']['label'] = false;
        $fields['billing']['billing_address_2']['placeholder'] = 'Apartment, Unite ( optional )';
        $fields['billing']['billing_address_2']['label'] = false;

        $fields['billing']['billing_city']['placeholder'] = 'Town / City';
        $fields['billing']['billing_city']['label'] = false;

        $fields['billing']['billing_state']['placeholder'] = 'County';
        $fields['billing']['billing_state']['label'] = false;

        $fields['billing']['billing_postcode']['placeholder'] = 'Post Code / Zip';
        $fields['billing']['billing_postcode']['label'] = false;

        $fields['billing']['billing_email']['placeholder'] = 'Email Address';
        $fields['billing']['billing_email']['label'] = false;

        $fields['billing']['billing_phone']['placeholder'] = 'Phone';
        $fields['billing']['billing_phone']['label'] = false;

        return $fields;
    }

    /*----------------------------------------------------------------------------------*/
    /* Woo Mini Cart
    /*----------------------------------------------------------------------------------*/

    //Minicart Callback Function
    public static function SasbyWooMiniCart(){
        ob_start();
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            do_action( 'sasby_woo_cart_icon' );
        }
        $woo_cart_out = ob_get_clean();
        $woo_cart_out = '<div class="header-action-item cart-area mini-cart-items header-shop-cart">'. $woo_cart_out .'</div>';
        echo wp_kses_stripslashes( $woo_cart_out );
    }

    /* Add Cart icon and count to header if WC is active */
    public function sasby_cart_items(){
        $empty_cart = '<li class="cart-item d-flex align-items-center"><h5 class="text-center no-cart-items">'. apply_filters( 'sasby_woo_mini_cart_empty', esc_html__('Your cart is empty', 'sasby') ) .'</h5></li>';
        if(is_null(WC()->cart)) {
        	return $empty_cart;
		}
		if ( WC()->cart->get_cart_contents_count() == 0 ) return $empty_cart;
        ob_start();
        $shop_page_url = get_permalink( wc_get_page_id( 'cart' ) );
        $remove_loader = apply_filters('woo_mini_cart_loader', SasbyTheme_Helper::get_img( 'spinner2.gif' ));
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            ?>
                <li class="cart-item d-flex align-items-center">
	                <?php
	                    $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
	                    $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
	                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
	                        $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
	                ?>
	                <div class="cart-single-product">
						<div class="media">
							<div class="cart-product-img">
								<?php
		                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
		                            if ( ! $product_permalink ) {
		                                echo ( ''. $thumbnail );
		                            } else {
		                                printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
		                            }
		                        ?>
							</div>
							<div class="media-body cart-content">
								<ul>
									<li class="minicart-title">
										<div class="cart-title-line1">
											<?php echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key ); ?>
										</div>
										<div class="cart-title-line2">
										<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?> &#9747; <?php echo esc_attr( $cart_item['quantity'] ); ?>
										</div>
									</li>
									<li class="minicart-remove">
										<?php
				                            echo apply_filters(
				                                'woocommerce_cart_item_remove_link',
				                                sprintf(
				                                    '<a href="%s" class="remove_from_cart_button remove-cart-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"><i class="fas fa-trash-alt"></i></a>',
				                                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
				                                    esc_attr__( 'Remove this item', 'sasby' ),
				                                    esc_attr( $product_id ),
				                                    esc_attr( $cart_item_key ),
				                                    esc_attr( $_product->get_sku() )
				                                ),
				                                $cart_item_key
				                            );
				                        ?>
									</li>
								</ul>
							</div>
							<span class="remove-item-overlay text-center"><img src="<?php echo esc_url($remove_loader); ?>" alt="<?php esc_attr_e('Loader..', 'sasby') ?>" /></span>
						</div>
					</div>

	                <?php
	                    }//if
	                ?>
                </li>
                <?php
                }//foreach
            ?>
            <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
            <li class="cart-total">
                <div class="total-price">
                    <span class="f-left"><?php _e( 'Total:', 'sasby' ); ?></span>
                    <span class="f-right"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                </div>
            </li>
            <li class="cart-btn">
                <div class="checkout-link">
                    <a class="button wc-forward" href="<?php echo wc_get_cart_url(); ?>"><?php _e( 'View Cart', 'sasby' ); ?></a>
                    <a class="button wc-forward checkout" href="<?php echo wc_get_checkout_url(); ?>"><?php _e( 'Checkout', 'sasby' ); ?></a>
                </div>
            </li>
            <?php endif; ?>
        <?php 
        $out = ob_get_clean();
        return $out;
    }

    public function sasby_wc_cart_count() {     
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
   			if(is_null(WC()->cart)) {
			    $count = WC()->cart->cart_contents_count;
			} else {
				$count = 0;
			}
			// $count = WC()->cart->cart_contents_count();
            $cart_link = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
            ?>
            <div class="cart-list-trigger">
	            <a class="cart-contents cart-trigger-icon" href="<?php echo esc_url( $cart_link ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'sasby' ); ?>"><svg width="22" height="22" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.8216 23.7316C10.8224 24.0355 10.7307 24.3328 10.5581 24.5859C10.3856 24.8391 10.14 25.0367 9.85222 25.1539C9.56448 25.2711 9.24756 25.3026 8.94147 25.2444C8.63539 25.1862 8.35388 25.0409 8.13249 24.8268C7.91109 24.6128 7.75975 24.3396 7.69757 24.0418C7.63538 23.744 7.66516 23.4349 7.78312 23.1536C7.90108 22.8723 8.10194 22.6313 8.36034 22.4612C8.61874 22.291 8.92308 22.1993 9.23494 22.1976H9.24753C9.66501 22.1976 10.0654 22.3592 10.3606 22.6469C10.6558 22.9346 10.8216 23.3247 10.8216 23.7316ZM19.3217 22.1976H19.3091C18.8905 22.1992 18.4897 22.3626 18.1946 22.6519C17.8995 22.9413 17.7342 23.3328 17.7351 23.7408C17.7359 24.1487 17.9028 24.5396 18.1991 24.8278C18.4953 25.116 18.8968 25.2778 19.3154 25.2778C19.734 25.2778 20.1355 25.116 20.4318 24.8278C20.7281 24.5396 20.895 24.1487 20.8958 23.7408C20.8967 23.3328 20.7314 22.9413 20.4363 22.6519C20.1412 22.3626 19.7403 22.1992 19.3217 22.1976ZM25.2214 8.38219L23.9445 15.9489C23.9128 16.5018 23.7651 17.0425 23.5104 17.5376C23.2558 18.0327 22.8996 18.4716 22.464 18.8273C22.0284 19.1829 21.5225 19.4477 20.9777 19.6052C20.4329 19.7628 19.8607 19.8098 19.2966 19.7433H8.88738C8.05496 19.7398 7.25142 19.4456 6.62269 18.9139C5.99396 18.3823 5.58173 17.6486 5.46089 16.8459L3.5556 3.87972C3.50058 3.51559 3.31366 3.18266 3.02864 2.94115C2.74363 2.69964 2.37934 2.5655 2.00165 2.56298H1.66669C1.4162 2.56298 1.17597 2.46601 0.998854 2.29341C0.821734 2.1208 0.722229 1.8867 0.722229 1.6426C0.722229 1.3985 0.821734 1.1644 0.998854 0.9918C1.17597 0.819197 1.4162 0.722229 1.66669 0.722229H2.00165C2.83407 0.725677 3.63761 1.01994 4.26634 1.55158C4.89507 2.08321 5.3073 2.81696 5.42814 3.61957L5.544 4.40372H21.8151C22.3224 4.40366 22.8235 4.5122 23.283 4.72167C23.7425 4.93114 24.1491 5.23643 24.4742 5.61595C24.7992 5.99547 25.0348 6.43995 25.1641 6.91795C25.2935 7.39596 25.3122 7.89582 25.2214 8.38219ZM23.0228 6.7967C22.8753 6.62397 22.6907 6.48496 22.482 6.38952C22.2733 6.29409 22.0456 6.24457 21.8151 6.24447H5.81348L7.32461 16.5858C7.37986 16.9514 7.56806 17.2855 7.85491 17.5272C8.14176 17.7688 8.50817 17.9021 8.88738 17.9025H19.2966C21.3114 17.9025 21.7975 17.1662 22.0833 15.636L23.3602 8.06804C23.4038 7.84499 23.3961 7.61531 23.3378 7.39549C23.2794 7.17568 23.1718 6.97118 23.0228 6.7967ZM17.4076 11.1531H12.3705C12.12 11.1531 11.8798 11.2501 11.7027 11.4227C11.5256 11.5953 11.4261 11.8294 11.4261 12.0735C11.4261 12.3176 11.5256 12.5517 11.7027 12.7243C11.8798 12.8969 12.12 12.9939 12.3705 12.9939H17.4076C17.6581 12.9939 17.8984 12.8969 18.0755 12.7243C18.2526 12.5517 18.3521 12.3176 18.3521 12.0735C18.3521 11.8294 18.2526 11.5953 18.0755 11.4227C17.8984 11.2501 17.6581 11.1531 17.4076 11.1531Z" fill="white"></path>
                    </svg> <?php if ( $count > 0 ) echo '(' . $count . '2' . ')'; ?></a>
                <div class="cart-wrapper">
                    <ul class="minicart">
		            	<?php echo wp_kses_stripslashes( $this->sasby_cart_items() ); ?>
		            </ul>
                </div>
            </div>
            <?php
        }
    }

    /* Ensure cart contents update when products are added to the cart via AJAX */
    public function sasby_header_add_to_cart_fragment( $fragments ) {
        ob_start();
        if(!is_null(WC()->cart)) {
		    $count = WC()->cart->cart_contents_count;
		} else {
			$count = 0;
		}
        $cart_link = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
        ?>
            <div class="header-action-item cart-area mini-cart-items header-shop-cart">
            	<div class="cart-list-trigger">
	                <a class="cart-contents cart-trigger-icon" href="<?php echo esc_url( $cart_link ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'sasby' ); ?>"><svg width="22" height="22" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.8216 23.7316C10.8224 24.0355 10.7307 24.3328 10.5581 24.5859C10.3856 24.8391 10.14 25.0367 9.85222 25.1539C9.56448 25.2711 9.24756 25.3026 8.94147 25.2444C8.63539 25.1862 8.35388 25.0409 8.13249 24.8268C7.91109 24.6128 7.75975 24.3396 7.69757 24.0418C7.63538 23.744 7.66516 23.4349 7.78312 23.1536C7.90108 22.8723 8.10194 22.6313 8.36034 22.4612C8.61874 22.291 8.92308 22.1993 9.23494 22.1976H9.24753C9.66501 22.1976 10.0654 22.3592 10.3606 22.6469C10.6558 22.9346 10.8216 23.3247 10.8216 23.7316ZM19.3217 22.1976H19.3091C18.8905 22.1992 18.4897 22.3626 18.1946 22.6519C17.8995 22.9413 17.7342 23.3328 17.7351 23.7408C17.7359 24.1487 17.9028 24.5396 18.1991 24.8278C18.4953 25.116 18.8968 25.2778 19.3154 25.2778C19.734 25.2778 20.1355 25.116 20.4318 24.8278C20.7281 24.5396 20.895 24.1487 20.8958 23.7408C20.8967 23.3328 20.7314 22.9413 20.4363 22.6519C20.1412 22.3626 19.7403 22.1992 19.3217 22.1976ZM25.2214 8.38219L23.9445 15.9489C23.9128 16.5018 23.7651 17.0425 23.5104 17.5376C23.2558 18.0327 22.8996 18.4716 22.464 18.8273C22.0284 19.1829 21.5225 19.4477 20.9777 19.6052C20.4329 19.7628 19.8607 19.8098 19.2966 19.7433H8.88738C8.05496 19.7398 7.25142 19.4456 6.62269 18.9139C5.99396 18.3823 5.58173 17.6486 5.46089 16.8459L3.5556 3.87972C3.50058 3.51559 3.31366 3.18266 3.02864 2.94115C2.74363 2.69964 2.37934 2.5655 2.00165 2.56298H1.66669C1.4162 2.56298 1.17597 2.46601 0.998854 2.29341C0.821734 2.1208 0.722229 1.8867 0.722229 1.6426C0.722229 1.3985 0.821734 1.1644 0.998854 0.9918C1.17597 0.819197 1.4162 0.722229 1.66669 0.722229H2.00165C2.83407 0.725677 3.63761 1.01994 4.26634 1.55158C4.89507 2.08321 5.3073 2.81696 5.42814 3.61957L5.544 4.40372H21.8151C22.3224 4.40366 22.8235 4.5122 23.283 4.72167C23.7425 4.93114 24.1491 5.23643 24.4742 5.61595C24.7992 5.99547 25.0348 6.43995 25.1641 6.91795C25.2935 7.39596 25.3122 7.89582 25.2214 8.38219ZM23.0228 6.7967C22.8753 6.62397 22.6907 6.48496 22.482 6.38952C22.2733 6.29409 22.0456 6.24457 21.8151 6.24447H5.81348L7.32461 16.5858C7.37986 16.9514 7.56806 17.2855 7.85491 17.5272C8.14176 17.7688 8.50817 17.9021 8.88738 17.9025H19.2966C21.3114 17.9025 21.7975 17.1662 22.0833 15.636L23.3602 8.06804C23.4038 7.84499 23.3961 7.61531 23.3378 7.39549C23.2794 7.17568 23.1718 6.97118 23.0228 6.7967ZM17.4076 11.1531H12.3705C12.12 11.1531 11.8798 11.2501 11.7027 11.4227C11.5256 11.5953 11.4261 11.8294 11.4261 12.0735C11.4261 12.3176 11.5256 12.5517 11.7027 12.7243C11.8798 12.8969 12.12 12.9939 12.3705 12.9939H17.4076C17.6581 12.9939 17.8984 12.8969 18.0755 12.7243C18.2526 12.5517 18.3521 12.3176 18.3521 12.0735C18.3521 11.8294 18.2526 11.5953 18.0755 11.4227C17.8984 11.2501 17.6581 11.1531 17.4076 11.1531Z" fill="white"></path>
                        </svg> <?php if ( $count >= 0 ) echo '<span>' . $count . '</span>'; ?></a>
	                <div class="cart-wrapper">
		                <ul class="minicart">
		                <?php echo wp_kses_stripslashes( $this->sasby_cart_items() ); ?>
		                </ul>
		            </div>
	            </div>
            </div>
        <?php
        $fragments['div.mini-cart-items'] = ob_get_clean();
        return $fragments;
    }

    public function sasby_wc_cart_ajax() {
        $output = '';
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        	if(!is_null(WC()->cart)) {
			    $count = WC()->cart->cart_contents_count;
			} else {
				$count = 0;
			}
            $cart_link = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
            ob_start();
            ?>
            <a class="cart-contents" href="<?php echo esc_url( $cart_link ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'sasby' ); ?>"><i class="icon-sasby-cart"></i> <?php if ( $count > 0 ) echo '(' . $count . ')'; ?></a>
            <ul class="minicart">
            <?php
                echo wp_kses_stripslashes( $this->sasby_cart_items() );
            ?>
            </ul>
            <?php
            $output = ob_get_clean();
        }
        return  $output;
    }

    public function sasby_product_remove() {
        global $wpdb, $woocommerce;
        session_start();
        foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item){
            if($cart_item['product_id'] == $_POST['product_id'] ){
                $woocommerce->cart->remove_cart_item($cart_item_key);
            }
        }
        $return["mini_cart"] = $this->sasby_wc_cart_ajax();
        echo json_encode($return);
        exit();
    }

    /*Shop meta action*/
    public function actions_button_control( $product, $module_data ) {
        if( ! $product ){
            return ;
        }
        $product_id = $product->get_id();

        if( isset( $module_data['wc_shop_wishlist_icon'] ) && $module_data['wc_shop_wishlist_icon'] ){
        	do_action( 'rtsb/modules/wishlist/print_button', $product_id );  
        }
        if( isset( $module_data['wc_shop_quickview_icon'] ) && $module_data['wc_shop_quickview_icon'] ){
        	do_action( 'rtsb/modules/quick_view/print_button', $product_id ); 
        }
        if( isset( $module_data['wc_shop_compare_icon'] ) && $module_data['wc_shop_compare_icon'] ){
        	do_action( 'rtsb/modules/compare/print_button', $product_id );
        }
    }

    /*Product single meta action*/
    public function single_meta_actions_button( $product, $module_data ) {
        if( ! $product ){
            return ;
        }
        $product_id = $product->get_id();
        if( isset( $module_data['wc_shop_wishlist_icon'] ) && $module_data['wc_shop_wishlist_icon'] ){ ?>
        	<span class="wishlist"><?php do_action( 'rtsb/modules/wishlist/print_button', $product_id );echo esc_html("Add To Wishlist", 'sasby'); ?></span>
		<?php }
        if( isset( $module_data['wc_shop_compare_icon'] ) && $module_data['wc_shop_compare_icon'] ){ ?>
        	<span class="compare"><?php do_action( 'rtsb/modules/compare/print_button', $product_id );echo esc_html("Add To Compare", 'sasby'); ?></span>
        <?php }

    }

}

WC_Functions::instance();