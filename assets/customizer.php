<?php
// This file adds a few extra options to the customizer


// Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
function vdproduction_customize_preview_js() {
	wp_enqueue_script( 'vdproduction_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '201510', true );
}
add_action( 'customize_preview_init', 'vdproduction_customize_preview_js' );


// Sanitize header background select option
function vdproduction_sanitize_background_select( $header_bg ) {

	if( ! in_array( $header_bg, array( 'enable', 'disable' ) ) ) {
		$header_bg = 'enable';
	}
	return $header_bg;
}


// Sanitize text input
function vdproduction_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}


// Sanitize page drop down
function vdproduction_sanitize_integer( $input ) {
	if( is_numeric( $input ) ) {
		return intval( $input );
	}
}


// Sanitize opacity decimal
function vdproduction_sanitize_decimal( $input ) {
	filter_var( $input, FILTER_FLAG_ALLOW_FRACTION );
	return ( $input );
}


// Sanitize checkbox
function vdproduction_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

// @param WP_Customize_Manager $wp_customize
function vdproduction_customizer_register( $wp_customize ) {

	//Logo Image	
	$wp_customize->add_setting( 'vdproduction_logo', array(
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'vdproduction_logo', array(
		'label'    => __( 'Logo Upload', 'vdproduction' ),
		'section'  => 'title_tagline',
		'settings' => 'vdproduction_logo',
		'priority' => 10
	) ) );

	//Color Options
	$wp_customize->add_setting( 'vdproduction_accent_color', array(
		'default'           => '#37BF91',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vdproduction_accent_color', array(
		'label'     => __( 'Accent Color', 'vdproduction' ),
		'section'   => 'colors',
		'settings'  => 'vdproduction_accent_color',
		'priority'  => 2,
	) ) );


	//Header and Footer Background Color
	$wp_customize->add_setting( 'vdproduction_header_color', array(
		'default'           => '#282E34',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vdproduction_header_color', array(
		'label'     => __( 'Header & Footer Background Color', 'vdproduction' ),
		'section'   => 'colors',
		'settings'  => 'vdproduction_header_color',
		'priority'  => 4,

	) ) );


	// Header Title Color
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->add_setting( 'vdproduction_title_color', array(
		'default'           => '#FFFFFF',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vdproduction_title_color', array(
		'label'     => __( 'Header Title Text Color', 'vdproduction' ),
		'section'   => 'colors',
		'settings'  => 'vdproduction_title_color',
		'priority'  => 6,
	) ) );


	//Header Subtitle Color
	$wp_customize->add_setting( 'vdproduction_subtitle_color', array(
		'default'           => '#A2ABB3',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vdproduction_subtitle_color', array(
		'label'     => __( 'Header Subtitle Text Color', 'vdproduction' ),
		'section'   => 'colors',
		'settings'  => 'vdproduction_subtitle_color',
		'priority'  => 8,
	) ) );


	//Header Navigation Link Color
	$wp_customize->add_setting( 'vdproduction_nav_color', array(
		'default'           => '#b5bdc3',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vdproduction_nav_color', array(
		'label'     => __( 'Header Navigation Link Color', 'vdproduction' ),
		'section'   => 'colors',
		'settings'  => 'vdproduction_nav_color',
		'priority'  => 10,
	) ) );
	
	//Header Image Section
	$wp_customize->add_section( 'header_image', array(
		'title'          => __( 'Header Image', 'vdproduction' ),
		'theme_supports' => 'custom-header',
		'priority'       => 60,
	) );

	$wp_customize->get_setting( 'header_image' )->transport = 'postMessage';

	//Header Background Opacity Range
	$wp_customize->add_setting( 'vdproduction_bg_opacity', array(
		'default'           => '.1',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'vdproduction_sanitize_decimal',
	) );

	$wp_customize->add_control( 'vdproduction_bg_opacity', array(
		'type'        => 'range',
		'priority'    => 10,
		'section'     => 'header_image',
		'label'       => __( 'Header Image Opacity', 'vdproduction' ),
		'description' => 'Change the opacity of your header image.',
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 1,
			'step'  => .1,
			'style' => 'width: 100%',
		),
	) );

	//Theme Options section
	$wp_customize->add_section( 'vdproduction_theme_options_section', array(
		'title'           => __( 'Theme Options', 'vdproduction' ),
		'priority'        => 1,
	) );

	//Homepage Template Options
	$wp_customize->add_panel( 'vdproduction_home_options', array(
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Homepage Settings', 'vdproduction' ),
		'description'    => __( 'Change the options for this theme.', 'vdproduction' ),
	) );
	
	//Homepage Header Section
	$wp_customize->add_section( 'vdproduction_title_section', array(
		'title'           => __( 'Header Titles', 'vdproduction' ),
		'priority'        => 2,
		'description'     => __( 'Add homepage title text for header and subtitle.', 'vdproduction' ),
		'panel'           => 'vdproduction_home_options',
	) );
	
	//Homepage Header Title Text
	$wp_customize->add_setting( 'vdproduction_header_hero_one_text', array(
		'default'           => __( 'Add a title', 'vdproduction' ),
		'type'              => 'option',
		'sanitize_callback' => 'vdproduction_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'vdproduction_header_hero_one_text', array(
		'label'           => __( 'Title Text', 'vdproduction' ),
		'section'         => 'vdproduction_title_section',
		'settings'        => 'vdproduction_header_hero_one_text',
		'type'            => 'text',
		'priority'        => 10
	) );
	
	//Homepage Header Subtitle Text
	$wp_customize->add_setting( 'vdproduction_header_hero_two_text', array(
		'default'           => __( 'Add a subtitle', 'vdproduction' ),
		'type'              => 'option',
		'sanitize_callback' => 'vdproduction_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'vdproduction_header_hero_two_text', array(
		'label'           => __( 'Title Text', 'vdproduction' ),
		'section'         => 'vdproduction_title_section',
		'settings'        => 'vdproduction_header_hero_two_text',
		'type'            => 'text',
		'priority'        => 10
	) );
	
	//Homepage Header Section
	$wp_customize->add_section( 'vdproduction_header_section', array(
		'title'           => __( 'Header Section', 'vdproduction' ),
		'priority'        => 2,
		'description'     => __( 'Add button links to your homepage header section.', 'vdproduction' ),
		'panel'           => 'vdproduction_home_options',
	) );

	//Homepage Header Button Link
	$wp_customize->add_setting( 'vdproduction_header_button_one_link', array(
		'default'           => '',
		'sanitize_callback' => 'vdproduction_sanitize_integer',
	) );

	$wp_customize->add_control( 'vdproduction_header_button_one_link', array(
		'type'     => 'dropdown-pages',
		'label'    => 	__( 'Button One Link', 'vdproduction' ),
		'settings' => 'vdproduction_header_button_one_link',
		'section'  => 'vdproduction_header_section',
		'priority' => 8
	) );

	//Homepage Header Button Text
	$wp_customize->add_setting( 'vdproduction_header_button_one_text', array(
		'default'           => __( 'Read More', 'vdproduction' ),
		'type'              => 'option',
		'sanitize_callback' => 'vdproduction_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'vdproduction_header_button_one_text', array(
		'label'           => __( 'Button One Text', 'vdproduction' ),
		'section'         => 'vdproduction_header_section',
		'settings'        => 'vdproduction_header_button_one_text',
		'type'            => 'text',
		'priority'        => 10
	) );

	//Homepage Header Button Color
	$wp_customize->add_setting( 'vdproduction_header_button_one_color', array(
		'default'           => '#37BF91',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vdproduction_header_button_one_color', array(
		'label'           => __( 'Button One Color', 'vdproduction' ),
		'section'         => 'vdproduction_header_section',
		'settings'        => 'vdproduction_header_button_one_color',
		'priority'        => 11,
	) ) );

	//Homepage Header Button Two Link
	$wp_customize->add_setting( 'vdproduction_header_button_two_link', array(
		'default'           => '',
		'sanitize_callback' => 'vdproduction_sanitize_integer',
	) );

	$wp_customize->add_control( 'vdproduction_header_button_two_link', array(
		'type'     => 'dropdown-pages',
		'label'    => 	__( 'Button Two Link', 'vdproduction' ),
		'settings' => 'vdproduction_header_button_two_link',
		'section'  => 'vdproduction_header_section',
		'priority' => 12
	) );

	//Homepage Header Button Two Text
	$wp_customize->add_setting( 'vdproduction_header_button_two_text', array(
		'default'           => __( 'Read More', 'vdproduction' ),
		'type'              => 'option',
		'sanitize_callback' => 'vdproduction_sanitize_text',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'vdproduction_header_button_two_text', array(
		'label'           => __( 'Button Two Text', 'vdproduction' ),
		'section'         => 'vdproduction_header_section',
		'settings'        => 'vdproduction_header_button_two_text',
		'type'            => 'text',
		'priority'        => 14
	) );

	//Homepage Header Button Two Color
	$wp_customize->add_setting( 'vdproduction_header_button_two_color', array(
		'default'           => '#37BF91',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vdproduction_header_button_two_color', array(
		'label'           => __( 'Button Two Color', 'vdproduction' ),
		'section'         => 'vdproduction_header_section',
		'settings'        => 'vdproduction_header_button_two_color',
		'priority'        => 15,
	) ) );	
	
}
add_action( 'customize_register', 'vdproduction_customizer_register' );	

//Output custom color options from Customizer
function vdproduction_custom_colors() {
	?>
	<style type="text/css">
		<?php if ( get_theme_mod( 'vdproduction_accent_color' ) ) { ?>
			/* Link color */
			a,
			#comments .bypostauthor .fn:before {
				color: <?php echo get_theme_mod( 'vdproduction_accent_color', '#37BF91' ); ?>;
			}
		<?php } ?>

		<?php if ( get_theme_mod( 'vdproduction_title_color' ) ) { ?>
		/* Header title color */
		.hero-title h2 {
			color: <?php echo get_theme_mod( 'vdproduction_title_color', '#FFFFFF' ); ?>;
		}
		<?php } ?>

		<?php if ( get_theme_mod( 'vdproduction_subtitle_color' ) ) { ?>
			/* Header subtitle color */
			.hero-title h3,
			.hero-title p {
				color: <?php echo get_theme_mod( 'vdproduction_subtitle_color', '#A2ABB3' ); ?>;
			}
		<?php } ?>

		<?php if ( get_theme_mod( 'vdproduction_nav_color' ) ) { ?>
			/* Main navigation link color */
			.main-navigation a,
			.site-description {
				color: <?php echo get_theme_mod( 'vdproduction_nav_color', '#b5bdc3' ); ?>;
			}
		<?php } ?>

		<?php if ( get_theme_mod( 'vdproduction_header_color' ) ) { ?>
			/* Background color for the header and footer */
			.site-header, .site-footer {
				background-color: <?php echo get_theme_mod( 'vdproduction_header_color', '#2B3136' ) ;?>;
			}
		<?php } ?>

		<?php if ( get_theme_mod( 'vdproduction_header_button_one_color' ) ) { ?>
			/* Background color for the first button in the header */
			.button-one {
				background: <?php echo get_theme_mod( 'vdproduction_header_button_one_color', '#37BF91' ) ;?>;
			}
		<?php } ?>

		<?php if ( get_theme_mod( 'vdproduction_header_button_two_color' ) ) { ?>
			/* Background color for the second button in the header */
			.button-two {
				background: <?php echo get_theme_mod( 'vdproduction_header_button_two_color', '#37BF91' ) ;?>;
			}
		<?php } ?>
		
	</style>
<?php
}
add_action( 'wp_head', 'vdproduction_custom_colors' );