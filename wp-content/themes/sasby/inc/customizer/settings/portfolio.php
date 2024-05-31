<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\sasby\Customizer\Settings;

use radiustheme\sasby\Customizer\SasbyTheme_Customizer;
use radiustheme\sasby\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\sasby\Customizer\Controls\Customizer_Heading_Control;
use radiustheme\sasby\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\sasby\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class SasbyTheme_Portfolio_Post_Settings extends SasbyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_portfolio_post_controls' ) );
	}

    /**
     * Portfolio Post Controls
     */
    public function register_portfolio_post_controls( $wp_customize ) {


        // Archive Portfolio Post
        $wp_customize->add_setting('portfolio_archive_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'portfolio_archive_heading', array(
            'label' => __( 'Portfolio Archive Option', 'sasby' ),
            'section' => 'rttheme_portfolio_settings',
        )));

        $wp_customize->add_setting( 'portfolio_archive_style',
            array(
                'default' => $this->defaults['portfolio_archive_style'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'portfolio_archive_style',
            array(
                'label' => __( 'Portfolio Archive Layout', 'sasby' ),
                'description' => esc_html__( 'Select the gallery layout for gallery page', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
                'choices' => array(
                    'style1' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog1.png',
                        'name' => __( 'Layout 1', 'sasby' )
                    ),
                    'style2' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog3.png',
                        'name' => __( 'Layout 2', 'sasby' )
                    ),
                    'style3' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/blog2.png',
                        'name' => __( 'Layout 3', 'sasby' )
                    ),
                )
            )
        ) );

        // Portfolio Archive option
        $wp_customize->add_setting( 'portfolio_post_number',
            array(
                'default' => $this->defaults['portfolio_post_number'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'portfolio_post_number',
            array(
                'label' => __( 'Portfolio Archive Post Limit', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
                'type' => 'number',
            )
        );

        $wp_customize->add_setting( 'portfolio_ar_category',
            array(
                'default' => $this->defaults['portfolio_ar_category'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'portfolio_ar_category',
            array(
                'label' => __( 'Show Category', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));

        $wp_customize->add_setting( 'portfolio_ar_action',
            array(
                'default' => $this->defaults['portfolio_ar_action'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'portfolio_ar_action',
            array(
                'label' => __( 'Show Action', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));

        $wp_customize->add_setting( 'portfolio_ar_excerpt',
            array(
                'default' => $this->defaults['portfolio_ar_excerpt'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'portfolio_ar_excerpt',
            array(
                'label' => __( 'Show Excerpt', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));

        $wp_customize->add_setting( 'portfolio_arexcerpt_limit',
            array(
                'default' => $this->defaults['portfolio_arexcerpt_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'portfolio_arexcerpt_limit',
            array(
                'label' => __( 'Portfolio Archive Excerpt Limit', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
                'type' => 'number',
            )
        );


        // Single Portfolio
        $wp_customize->add_setting('portfolio_related_heading', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Heading_Control($wp_customize, 'portfolio_related_heading', array(
            'label' => __( 'Single Portfolio Option', 'sasby' ),
            'section' => 'rttheme_portfolio_settings',
        )));        

        $wp_customize->add_setting( 'single_portfolio_cat',
            array(
                'default' => $this->defaults['single_portfolio_cat'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_portfolio_cat',
            array(
                'label' => __( 'Portfolio Single Category', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));

        $wp_customize->add_setting( 'single_portfolio_client',
            array(
                'default' => $this->defaults['single_portfolio_client'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_portfolio_client',
            array(
                'label' => __( 'Portfolio Single Client', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));

        $wp_customize->add_setting( 'single_portfolio_startdate',
            array(
                'default' => $this->defaults['single_portfolio_startdate'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_portfolio_startdate',
            array(
                'label' => __( 'Portfolio Single Start Date', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));

        $wp_customize->add_setting( 'single_portfolio_enddate',
            array(
                'default' => $this->defaults['single_portfolio_enddate'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_portfolio_enddate',
            array(
                'label' => __( 'Portfolio Single End Date', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));

        $wp_customize->add_setting( 'single_portfolio_weblink',
            array(
                'default' => $this->defaults['single_portfolio_weblink'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_portfolio_weblink',
            array(
                'label' => __( 'Portfolio Single WebLink', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));

        $wp_customize->add_setting( 'single_portfolio_rating',
            array(
                'default' => $this->defaults['single_portfolio_rating'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'single_portfolio_rating',
            array(
                'label' => __( 'Portfolio Single Rating', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));
        
        $wp_customize->add_setting( 'show_related_portfolio',
            array(
                'default' => $this->defaults['show_related_portfolio'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'show_related_portfolio',
            array(
                'label' => __( 'Show Related Portfolio', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
            )
        ));
        
        $wp_customize->add_setting( 'portfolio_related_title',
            array(
                'default' => $this->defaults['portfolio_related_title'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_textarea_sanitization',
            )
        );
        $wp_customize->add_control( 'portfolio_related_title',
            array(
                'label' => __( 'Related Title', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
                'type' => 'textarea',
                'active_callback'   => 'rttheme_is_related_portfolio_enabled',
            )
        );
        
        $wp_customize->add_setting( 'related_portfolio_number',
            array(
                'default' => $this->defaults['related_portfolio_number'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'related_portfolio_number',
            array(
                'label' => __( 'Team Post', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
                'type' => 'number',
                'active_callback'   => 'rttheme_is_related_portfolio_enabled',
            )
        );
        
        $wp_customize->add_setting( 'related_portfolio_title_limit',
            array(
                'default' => $this->defaults['related_portfolio_title_limit'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'related_portfolio_title_limit',
            array(
                'label' => __( 'Title Limit', 'sasby' ),
                'section' => 'rttheme_portfolio_settings',
                'type' => 'number',
                'active_callback'   => 'rttheme_is_related_portfolio_enabled',
            )
        );
    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new SasbyTheme_Portfolio_Post_Settings();
}
