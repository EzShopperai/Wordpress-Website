<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
namespace radiustheme\sasby\Customizer\Settings;

use radiustheme\sasby\Customizer\SasbyTheme_Customizer;
use WP_Customize_Media_Control;
use WP_Customize_Color_Control;
/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class SasbyTheme_Error_Settings extends SasbyTheme_Customizer {

	public function __construct() {
	    parent::instance();
        $this->populated_default_data();
        // Add Controls
        add_action( 'customize_register', array( $this, 'register_error_controls' ) );
	}

    public function register_error_controls( $wp_customize ) {
		
		$wp_customize->add_setting('error_bodybg_color', 
            array(
                'default' => $this->defaults['error_bodybg_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'error_bodybg_color',
            array(
                'label' => esc_html__('Body Background Color', 'sasby'),
                'section' => 'error_section', 
            )
        ));
		// Error image
        $wp_customize->add_setting( 'error_image',
            array(
                'default' => $this->defaults['error_image'],
                'transport' => 'refresh',
                'sanitize_callback' => 'absint',
            )
        );
        $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'error_image',
            array(
                'label' => __( 'Error Image', 'sasby' ),
                'description' => esc_html__( 'This is the description for the Media Control', 'sasby' ),
                'section' => 'error_section',
                'mime_type' => 'image',
                'button_labels' => array(
                    'select' => __( 'Select File', 'sasby' ),
                    'change' => __( 'Change File', 'sasby' ),
                    'default' => __( 'Default', 'sasby' ),
                    'remove' => __( 'Remove', 'sasby' ),
                    'placeholder' => __( 'No file selected', 'sasby' ),
                    'frame_title' => __( 'Select File', 'sasby' ),
                    'frame_button' => __( 'Choose File', 'sasby' ),
                )
            )
        ) );
		
        // Error Text
        $wp_customize->add_setting( 'error_text1',
            array(
                'default' => $this->defaults['error_text1'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'error_text1',
            array(
                'label' => __( 'Error Heading', 'sasby' ),
                'section' => 'error_section',
                'type' => 'text',
            )
        );
        $wp_customize->add_setting( 'error_text2',
            array(
                'default' => $this->defaults['error_text2'],
                'transport' => 'refresh',
                'sanitize_callback' => 'sanitize_textarea_field'
            )
        );
        $wp_customize->add_control( 'error_text2',
            array(
                'label' => __( 'Error Text', 'sasby' ),
                'section' => 'error_section',
                'type' => 'textarea',
            )
        );
        // Button Text
        $wp_customize->add_setting( 'error_buttontext',
            array(
                'default' => $this->defaults['error_buttontext'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_text_sanitization'
            )
        );
        $wp_customize->add_control( 'error_buttontext',
            array(
                'label' => __( 'Button Text', 'sasby' ),
                'section' => 'error_section',
                'type' => 'text',
            )
        );
		
		$wp_customize->add_setting('error_text1_color', 
            array(
                'default' => $this->defaults['error_text1_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'error_text1_color',
            array(
                'label' => esc_html__('Error Heading Color', 'sasby'),
                'section' => 'error_section', 
            )
        ));
		
		$wp_customize->add_setting('error_text2_color', 
            array(
                'default' => $this->defaults['error_text2_color'],
                'type' => 'theme_mod', 
                'capability' => 'edit_theme_options', 
                'transport' => 'refresh', 
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'error_text2_color',
            array(
                'label' => esc_html__('Error Text Color', 'sasby'),
                'section' => 'error_section', 
            )
        ));

        /*Animation*/
        $wp_customize->add_setting( 'error_animation',
            array(
                'default' => $this->defaults['error_animation'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'error_animation',
            array(
                'label' => __( 'Animation On/Off', 'sasby' ),
                'section' => 'error_section',
                'type' => 'select',
                'choices' => array(
                    'wow' => esc_html__( 'Animation On', 'sasby' ),
                    'hide' => esc_html__( 'Animation Off', 'sasby' ),
                ),
            )
        );

        $wp_customize->add_setting( 'error_animation_effect',
            array(
                'default' => $this->defaults['error_animation_effect'],
                'transport' => 'refresh',
                'sanitize_callback' => 'rttheme_radio_sanitization',
            )
        );
        $wp_customize->add_control( 'error_animation_effect',
            array(
                'label' => __( 'Entrance Animation', 'sasby' ),
                'section' => 'error_section',
                'type' => 'select',
                'choices' => array(
                    'none' => esc_html__( 'none', 'sasby' ),
                    'bounce' => esc_html__( 'bounce', 'sasby' ),
                    'flash' => esc_html__( 'flash', 'sasby' ),
                    'pulse' => esc_html__( 'pulse', 'sasby' ),
                    'rubberBand' => esc_html__( 'rubberBand', 'sasby' ),
                    'shakeX' => esc_html__( 'shakeX', 'sasby' ),
                    'shakeY' => esc_html__( 'shakeY', 'sasby' ),
                    'headShake' => esc_html__( 'headShake', 'sasby' ),
                    'swing' => esc_html__( 'swing', 'sasby' ),                 
                    'fadeIn' => esc_html__( 'fadeIn', 'sasby' ),
                    'fadeInDown' => esc_html__( 'fadeInDown', 'sasby' ),
                    'fadeInLeft' => esc_html__( 'fadeInLeft', 'sasby' ),
                    'fadeInRight' => esc_html__( 'fadeInRight', 'sasby' ),
                    'fadeInUp' => esc_html__( 'fadeInUp', 'sasby' ),                   
                    'bounceIn' => esc_html__( 'bounceIn', 'sasby' ),
                    'bounceInDown' => esc_html__( 'bounceInDown', 'sasby' ),
                    'bounceInLeft' => esc_html__( 'bounceInLeft', 'sasby' ),
                    'bounceInRight' => esc_html__( 'bounceInRight', 'sasby' ),
                    'bounceInUp' => esc_html__( 'bounceInUp', 'sasby' ),           
                    'slideInDown' => esc_html__( 'slideInDown', 'sasby' ),
                    'slideInLeft' => esc_html__( 'slideInLeft', 'sasby' ),
                    'slideInRight' => esc_html__( 'slideInRight', 'sasby' ),
                    'slideInUp' => esc_html__( 'slideInUp', 'sasby' ), 
                ),
            )
        );
		
    }

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new SasbyTheme_Error_Settings();
}
