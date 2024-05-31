<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.1
 */
namespace radiustheme\sasby\Customizer;
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class SasbyTheme_Customizer {
	// Get our default values
	protected $defaults;
    protected static $instance = null;

	public function __construct() {
		// Register Panels
		add_action( 'customize_register', array( $this, 'add_customizer_panels' ) );
		// Register sections
		add_action( 'customize_register', array( $this, 'add_customizer_sections' ) );
	}

    public static function instance() {
        if (null == self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function populated_default_data() {
        $this->defaults = rttheme_generate_defaults();
    }

	/**
	 * Customizer Panels
	 */
	public function add_customizer_panels( $wp_customize ) {

        // Add General Panel
        $wp_customize->add_panel( 'rttheme_general_panel',
            array(
                'title' => __( 'General', 'sasby' ),
                'description' => esc_html__( 'Adjust the overall layout for your site.', 'sasby' ),
                'priority' => 1,
            )
        );

        // Add Header Panel
        $wp_customize->add_panel( 'rttheme_header_panel',
            array(
                'title' => __( 'Header', 'sasby' ),
                'description' => esc_html__( 'Adjust the overall layout for your site.', 'sasby' ),
                'priority' => 2,
            )
        );

		// Add Header Panel
		$wp_customize->add_panel( 'rttheme_footer_panel',
			array(
				'title' => __( 'Footer', 'sasby' ),
				'description' => esc_html__( 'Adjust the overall layout for your site.', 'sasby' ),
				'priority' => 3,
			)
		);



		// Add Color Section
        $wp_customize->add_panel( 'rttheme_color_panel',
            array(
                'title' => __( 'Color', 'sasby' ),
                'description' => esc_html__( 'Adjust the overall layout for your site.', 'sasby' ),
                'priority' => 4,
            )
        );

	    // Add Layput Panel
		$wp_customize->add_panel( 'rttheme_layouts_defaults',
		 	array(
				'title' => __( 'Layout Settings', 'sasby' ),
				'description' => esc_html__( 'Adjust the overall layout for your site.', 'sasby' ),
				'priority' => 9,
			)
		);

        // Add General Panel
        $wp_customize->add_panel( 'rttheme_blog_settings',
            array(
                'title' => __( 'Blog Settings', 'sasby' ),
                'description' => esc_html__( 'Adjust the overall layout for your site.', 'sasby' ),
                'priority' => 10,
            )
        );
		
		// Add General Panel
        $wp_customize->add_panel( 'rttheme_cpt_settings',
            array(
                'title' => __( 'Custom Posts', 'sasby' ),
                'description' => esc_html__( 'All custom posts settings here.', 'sasby' ),
                'priority' => 12,
            )
        );
		
	}

    /**
    * Customizer sections
    */
	public function add_customizer_sections( $wp_customize ) {

		// Rename the default Colors section
		$wp_customize->get_section( 'colors' )->title = 'Background';

		// Move the default Colors section to our new Colors Panel
		$wp_customize->get_section( 'colors' )->panel = 'colors_panel';

		// Change the Priority of the default Colors section so it's at the top of our Panel
		$wp_customize->get_section( 'colors' )->priority = 10;

		// Add Logo Section
        $wp_customize->add_section( 'logo_section',
            array(
                'title' => __( 'Theme Logo', 'sasby' ),
                'priority' => 1,
                'panel' => 'rttheme_general_panel',
            )
        );  
        // Add Information Section
        $wp_customize->add_section( 'control_section',
            array(
                'title' => __( 'Theme Control', 'sasby' ),
                'priority' => 2,
                'panel' => 'rttheme_general_panel',
            )
        ); 
        // Add General Section
        $wp_customize->add_section( 'general_section',
            array(
                'title' => __( 'Theme General', 'sasby' ),
                'priority' => 3,
                'panel' => 'rttheme_general_panel',
            )
        ); 
        // Add Social Section
        $wp_customize->add_section( 'social_section',
            array(
                'title' => __( 'Theme Social', 'sasby' ),
                'priority' => 4,
                'panel' => 'rttheme_general_panel',
            )
        );  

        // Add Header Main Section
        $wp_customize->add_section( 'header_section',
            array(
                'title' => __( 'Header Main', 'sasby' ),
                'priority' => 2,
                'panel' => 'rttheme_header_panel',
            )
        );
        // Add Header Mobile Section
        $wp_customize->add_section( 'header_mobile_section',
            array(
                'title' => __( 'Header Mobile', 'sasby' ),
                'priority' => 3,
                'panel' => 'rttheme_header_panel',
            )
        );

        // Add Header Panel
        $wp_customize->add_section(
            'footer_cta_section',
            array(
                'title' => __('Footer Top Banner ( Style 1-2 ) ', 'sasby'),
                'priority' => 1,
                'panel' => 'rttheme_footer_panel',
            )
        );

        // Add Header Panel
        $wp_customize->add_section(
            'footer_address_section',
            array(
                'title' => __('Footer Address ( Style 3 ) ', 'sasby'),
                'priority' => 1,
                'panel' => 'rttheme_footer_panel',
            )
        );

		// Add Footer Section
		$wp_customize->add_section( 'footer_layout_settings',
			array(
				'title' => __( 'Footer Layout Settings', 'sasby' ),
				'priority' => 2,
				'panel' => 'rttheme_footer_panel',
			)
		);

		// Add Footer Section
		$wp_customize->add_section( 'footer_color_settings',
			array(
				'title' => __( 'Footer Color Settings', 'sasby' ),
				'priority' => 3,
				'panel' => 'rttheme_footer_panel',
			)
		);

		// Add Footer Section
		$wp_customize->add_section( 'footer_section',
			array(
				'title' => __( 'Footer Copyright Text', 'sasby' ),
				'priority' => 4,
				'panel' => 'rttheme_footer_panel',
			)
		);


        // Add Color Main Section
        $wp_customize->add_section( 'color_main_section',
            array(
                'title' => __( 'Color Main', 'sasby' ),
                'priority' => 1,
                'panel' => 'rttheme_color_panel',
            )
        );

        // Add Color Menu Section
        $wp_customize->add_section( 'color_menu_section',
            array(
                'title' => __( 'Color Menu', 'sasby' ),
                'priority' => 2,
                'panel' => 'rttheme_color_panel',
            )
        );

        // Add Color Main Section
        $wp_customize->add_section( 'color_dark_section',
            array(
                'title' => __( 'Color Dark', 'sasby' ),
                'priority' => 3,
                'panel' => 'rttheme_color_panel',
            )
        );

        // Add News Ticker Section
        $wp_customize->add_section( 'reading_progress_bar_section',
            array(
                'title' => __( 'Progress Bar', 'sasby' ),
                'priority' => 6,
            )
        );        
		
		// Add Footer Section
        $wp_customize->add_section( 'banner_section',
            array(
                'title' => __( 'Banner', 'sasby' ),
                'priority' => 7,
            )
        );

        // Add Pages Slug Section       
        $wp_customize->add_section( 'slug_layout_section',
            array(
                'title' => __( 'Post Type Slug', 'sasby' ),
                'priority' => 1,
                'panel' => 'rttheme_layouts_defaults',
            )
        );
		
		// Add Pages Layout Section	
        $wp_customize->add_section( 'page_layout_section',
            array(
                'title' => __( 'Pages Layout', 'sasby' ),
                'priority' => 2,
                'panel' => 'rttheme_layouts_defaults',
            )
        );
        // Add Blog Archive Layout Section
        $wp_customize->add_section( 'blog_layout_section',
            array(
                'title' => __( 'Blog Archive Layout', 'sasby' ),
                'priority' => 3,
                'panel' => 'rttheme_layouts_defaults',
            )
        );
		
		// Add Blog Single Layout Section
        $wp_customize->add_section( 'post_single_layout_section',
            array(
                'title' => __( 'Post Single Layout', 'sasby' ),
                'priority' => 4,
                'panel' => 'rttheme_layouts_defaults',
            )
        );

        // Add Team Archive Layout Section
        $wp_customize->add_section( 'team_layout_section',
            array(
                'title' => __( 'Team Archive Layout', 'sasby' ),
                'priority' => 5,
                'panel' => 'rttheme_layouts_defaults',
            )
        );
        
        // Add Team Single Layout Section
        $wp_customize->add_section( 'team_single_layout_section',
            array(
                'title' => __( 'Team Single Layout', 'sasby' ),
                'priority' => 6,
                'panel' => 'rttheme_layouts_defaults',
            )
        );

        // Add Service Layout Section
        $wp_customize->add_section( 'service_layout_section',
            array(
                'title' => __( 'Service Archive Layout', 'sasby' ),
                'priority' => 7,
                'panel' => 'rttheme_layouts_defaults',
            )
        );

        // Add Service Single Layout Section
        $wp_customize->add_section( 'service_single_layout_section',
            array(
                'title' => __( 'Service Single Layout', 'sasby' ),
                'priority' => 8,
                'panel' => 'rttheme_layouts_defaults',
            )
        );

        // Add Portfolio Layout Section
        $wp_customize->add_section( 'portfolio_layout_section',
            array(
                'title' => __( 'Portfolio Archive Layout', 'sasby' ),
                'priority' => 9,
                'panel' => 'rttheme_layouts_defaults',
            )
        );

        // Add Portfolio Single Layout Section
        $wp_customize->add_section( 'portfolio_single_layout_section',
            array(
                'title' => __( 'Portfolio Single Layout', 'sasby' ),
                'priority' => 11,
                'panel' => 'rttheme_layouts_defaults',
            )
        );

        // Add Shop Archive Layout Section
        $wp_customize->add_section( 'wc_shop_layout_section',
            array(
                'title' => __( 'Shop Archive Layout', 'sasby' ),
                'priority' => 12,
                'panel' => 'rttheme_layouts_defaults',
            )
        );
        
        // Add Shop Single Layout Section
        $wp_customize->add_section( 'wc_product_layout_section',
            array(
                'title' => __( 'Product Single Layout', 'sasby' ),
                'priority' => 13,
                'panel' => 'rttheme_layouts_defaults',
            )
        );   
		
		// Add Search Layout Section
        $wp_customize->add_section( 'search_layout_section',
            array(
                'title' => __( 'Search Layout', 'sasby' ),
                'priority' => 14,
                'panel' => 'rttheme_layouts_defaults',
            )
        );
		
		// Add Error Layout Section
        $wp_customize->add_section( 'error_layout_section',
            array(
                'title' => __( 'Error Layout', 'sasby' ),
                'priority' => 15,
                'panel' => 'rttheme_layouts_defaults',
            )
        );
		     
		
        // Add Blog Settings Section -------------------------
        $wp_customize->add_section( 'blog_post_settings_section',
            array(
                'title' => __( 'Blog Settings', 'sasby' ),
                'priority' => 10,
                'panel' => 'rttheme_blog_settings',
            )
        );
        // Add Single Blog Settings Section
        $wp_customize->add_section( 'single_post_secttings_section',
            array(
                'title' => __( 'Post Settings', 'sasby' ),
                'priority' => 12,
                'panel' => 'rttheme_blog_settings',
            )
        );
		// Add Single Share Settings Section
        $wp_customize->add_section( 'single_post_share_section',
            array(
                'title' => __( 'Post Share', 'sasby' ),
                'priority' => 13,
                'panel' => 'rttheme_blog_settings',
            )
        );
		
		// Add Team Section
        $wp_customize->add_section( 'rttheme_team_settings',
            array(
                'title' => __( 'Team Setting', 'sasby' ),
                'priority' => 1,
				'panel' => 'rttheme_cpt_settings',
            )
        );

        // Add Service Section
        $wp_customize->add_section( 'rttheme_service_settings',
            array(
                'title' => __( 'Service Setting', 'sasby' ),
                'priority' => 2,
                'panel' => 'rttheme_cpt_settings',
            )
        );

        // Add Portfolio Section
        $wp_customize->add_section( 'rttheme_portfolio_settings',
            array(
                'title' => __( 'Portfolio Setting', 'sasby' ),
                'priority' => 3,
                'panel' => 'rttheme_cpt_settings',
            )
        );
        
        // Add Error Page Section
        $wp_customize->add_section( 'error_section',
            array(
                'title' => __( 'Error Page', 'sasby' ),
                'priority' => 16,
            )
        );
        // Add our wooCommerce shop Section
        $wp_customize->add_section('shop_layout_section',
            array(
               'title'    => esc_html__('Shop Archive Layout', 'sasby'),
               'priority' => 1,
               'panel'    => 'woocommerce',
            )
        );
        
        // Add our wooCommerce product Section
        $wp_customize->add_section('product_layout_section',
            array(
               'title'    => esc_html__('Shop Single Layout', 'sasby'),
               'priority' => 2,
               'panel'    => 'woocommerce',
            )
        );

	}

}
