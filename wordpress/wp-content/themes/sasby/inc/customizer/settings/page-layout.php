<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\sasby\Customizer\Settings;

use radiustheme\sasby\Customizer\SasbyTheme_Customizer;
use radiustheme\sasby\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\sasby\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\sasby\Customizer\Controls\Customizer_Image_Radio_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class SasbyTheme_Page_Layout_Settings extends SasbyTheme_Customizer {

	public function __construct() {
        parent::instance();
        $this->populated_default_data();
        // Register Page Controls
        add_action( 'customize_register', array( $this, 'register_page_layout_controls' ) );
	}

    public function register_page_layout_controls( $wp_customize ) {

        $wp_customize->add_setting( 'page_layout',
            array(
                'default' => $this->defaults['page_layout'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization'
            )
        );
        $wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'page_layout',
            array(
                'label' => __( 'Sidebar Layout', 'sasby' ),
                'description' => esc_html__( 'Select the default template layout for Pages', 'sasby' ),
                'section' => 'page_layout_section',
                'choices' => array(
                    'left-sidebar' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-left.png',
                        'name' => __( 'Left Sidebar', 'sasby' )
                    ),
                    'full-width' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-full.png',
                        'name' => __( 'Full Width', 'sasby' )
                    ),
                    'right-sidebar' => array(
                        'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/sidebar-right.png',
                        'name' => __( 'Right Sidebar', 'sasby' )
                    )
                )
            )
        ) );

        /**
         * Separator
         */
        $wp_customize->add_setting('separator_page', array(
            'default' => '',
            'sanitize_callback' => 'esc_html',
        ));
        $wp_customize->add_control(new Customizer_Separator_Control($wp_customize, 'separator_page', array(
            'settings' => 'separator_page',
            'section' => 'page_layout_section',
        )));
		
		// Content padding top
        $wp_customize->add_setting( 'page_padding_top',
            array(
                'default' => $this->defaults['page_padding_top'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'page_padding_top',
            array(
                'label' => __( 'Content Padding Top', 'sasby' ),
                'section' => 'page_layout_section',
                'type' => 'number',
            )
        );
        // Content padding bottom
        $wp_customize->add_setting( 'page_padding_bottom',
            array(
                'default' => $this->defaults['page_padding_bottom'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'page_padding_bottom',
            array(
                'label' => __( 'Content Padding Bottom', 'sasby' ),
                'section' => 'page_layout_section',
                'type' => 'number',
            )
        );
		
		$wp_customize->add_setting( 'page_banner',
            array(
                'default' => $this->defaults['page_banner'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'page_banner',
            array(
                'label' => __( 'Banner', 'sasby' ),
                'section' => 'page_layout_section',
            )
        ) );
		
		$wp_customize->add_setting( 'page_breadcrumb',
            array(
                'default' => $this->defaults['page_breadcrumb'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'page_breadcrumb',
            array(
                'label' => __( 'Breadcrumb', 'sasby' ),
                'section' => 'page_layout_section',
            )
        ) );
		
        // Banner BG Type 
        $wp_customize->add_setting( 'page_bgtype',
            array(
                'default' => $this->defaults['page_bgtype'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'page_bgtype',
            array(
                'label' => __( 'Banner Background Type', 'sasby' ),
                'section' => 'page_layout_section',
                'description' => esc_html__( 'This is banner background type.', 'sasby' ),
                'type' => 'select',
                'choices' => array(
                    'bgimg' => esc_html__( 'BG Image', 'sasby' ),
                    'bgcolor' => esc_html__( 'BG Color', 'sasby' ),
                ),
            )
        );

        $wp_customize->add_setting( 'page_bgimg',
            array(
                'default' => $this->defaults['page_bgimg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'page_bgimg',
            array(
                'label' => __( 'Banner Background Image', 'sasby' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'sasby' ),
                'section' => 'page_layout_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'sasby' ),
                    'change' => __( 'Change File', 'sasby' ),
                    'default' => __( 'Default', 'sasby' ),
                    'remove' => __( 'Remove', 'sasby' ),
                    'placeholder' => __( 'No file selected', 'sasby' ),
                    'frame_title' => __( 'Select File', 'sasby' ),
                    'frame_button' => __( 'Choose File', 'sasby' ),
                ),
            )
        ) );

        // Banner background color
        $wp_customize->add_setting('page_bgcolor', 
            array(
                'default' => $this->defaults['page_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_bgcolor',
            array(
                'label' => esc_html__('Banner Background Color', 'sasby'),
                'settings' => 'page_bgcolor', 
                'priority' => 10, 
                'section' => 'page_layout_section',
            )
        ));
		
		// Page background image
		$wp_customize->add_setting( 'page_page_bgimg',
            array(
                'default' => $this->defaults['page_page_bgimg'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'page_page_bgimg',
            array(
                'label' => __( 'Page / Post Background Image', 'sasby' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'sasby' ),
                'section' => 'page_layout_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'sasby' ),
                    'change' => __( 'Change File', 'sasby' ),
                    'default' => __( 'Default', 'sasby' ),
                    'remove' => __( 'Remove', 'sasby' ),
                    'placeholder' => __( 'No file selected', 'sasby' ),
                    'frame_title' => __( 'Select File', 'sasby' ),
                    'frame_button' => __( 'Choose File', 'sasby' ),
                ),
            )
        ) );
		// Page background Color
		$wp_customize->add_setting('page_page_bgcolor', 
            array(
                'default' => $this->defaults['page_page_bgcolor'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_page_bgcolor',
            array(
                'label' => esc_html__('Page / Post Background Color', 'sasby'),
                'settings' => 'page_page_bgcolor', 
                'section' => 'page_layout_section', 
            )
        ));
        

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new SasbyTheme_Page_Layout_Settings();
}
