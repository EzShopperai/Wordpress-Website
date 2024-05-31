<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\sasby\Customizer\Settings;

use radiustheme\sasby\Customizer\SasbyTheme_Customizer;
use radiustheme\sasby\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\sasby\Customizer\Controls\Customizer_Switch_Control;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class SasbyTheme_Banner_Settings extends SasbyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_banner_controls' ) );
	}

    public function register_banner_controls( $wp_customize ) {
	
		// Banner Color	
		$wp_customize->add_setting('breadcrumb_link_color', 
            array(
                'default' => $this->defaults['breadcrumb_link_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_link_color',
            array(
                'label' => esc_html__('Breadcrumb Link Color', 'sasby'),
                'section' => 'banner_section', 
            )
        ));
		
		$wp_customize->add_setting('breadcrumb_link_hover_color', 
            array(
                'default' => $this->defaults['breadcrumb_link_hover_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_link_hover_color',
            array(
                'label' => esc_html__('Breadcrumb Link Hover Color', 'sasby'),
                'section' => 'banner_section', 
            )
        ));
		
		$wp_customize->add_setting('breadcrumb_active_color', 
            array(
                'default' => $this->defaults['breadcrumb_active_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_active_color',
            array(
                'label' => esc_html__('Active Breadcrumb Color', 'sasby'),
                'section' => 'banner_section', 
            )
        ));
		
		$wp_customize->add_setting('breadcrumb_seperator_color', 
            array(
                'default' => $this->defaults['breadcrumb_seperator_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_seperator_color',
            array(
                'label' => esc_html__('Breadcrumb Seperator Color', 'sasby'),
                'section' => 'banner_section', 
            )
        ));		
		
		$wp_customize->add_setting( 'banner_bg_opacity',
            array(
                'default' => $this->defaults['banner_bg_opacity'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization',
            )
        );
        $wp_customize->add_control( 'banner_bg_opacity',
            array(
                'label' => __( 'Banner Background Overlay opacity', 'sasby' ),
                'section' => 'banner_section',
                'type'              => 'range',
                'input_attrs'       => array(
                    'min'           => 0.01,
                    'max'           => 1.00,
                    'step'          => 0.01,
                ),
            )
        );
        
		// Banner padding top
        $wp_customize->add_setting( 'banner_top_padding',
            array(
                'default' => $this->defaults['banner_top_padding'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'banner_top_padding',
            array(
                'label' => __( 'Banner Padding Top', 'sasby' ),
                'section' => 'banner_section',
                'type' => 'number',
            )
        );
        // Banner padding bottom
        $wp_customize->add_setting( 'banner_bottom_padding',
            array(
                'default' => $this->defaults['banner_bottom_padding'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_sanitize_integer',
            )
        );
        $wp_customize->add_control( 'banner_bottom_padding',
            array(
                'label' => __( 'Banner Padding Top', 'sasby' ),
                'section' => 'banner_section',
                'type' => 'number',
            )
        );

        // Banner shape
        $wp_customize->add_setting( 'banner_shape',
            array(
                'default' => $this->defaults['banner_shape'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_switch_sanitization',
            )
        );
        $wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'banner_shape',
            array(
                'label' => __( 'Banner Shape', 'sasby' ),
                'section' => 'banner_section',
            )
        ) );
        $wp_customize->add_setting( 'banner_shape1',
            array(
                'default' => $this->defaults['banner_shape1'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'banner_shape1',
            array(
                'label' => __( 'Banner Shape 1', 'sasby' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'sasby' ),
                'section' => 'banner_section',
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
                'active_callback'   => 'rttheme_is_banner_shape_enabled',
            )
        ) );

        $wp_customize->add_setting('banner_shape_color', 
            array(
                'default' => $this->defaults['banner_shape_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'banner_shape_color',
            array(
                'label' => esc_html__('Banner Shape Color', 'sasby'),
                'section' => 'banner_section', 
                'active_callback'   => 'rttheme_is_banner_shape_enabled',
            )
        ));

    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new SasbyTheme_Banner_Settings();
}
