<!doctype html>

  <html class="no-js"  <?php language_attributes(); ?>>

	<head>
		<meta charset="utf-8">
		
		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta class="foundation-mq">
		
		<!-- If Site Icon isn't set in customizer -->
		<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
			<!-- Icons & Favicons -->
			<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
			<link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png" rel="apple-touch-icon" />
			<!--[if IE]>
				<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
			<![endif]-->
			<meta name="msapplication-TileColor" content="#f01d4f">
			<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">
	    	<meta name="theme-color" content="#121212">
	    <?php } ?>
		<!-- Typography -->	
		<link href='https://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php wp_head(); ?>

		<!-- Drop Google Analytics here -->
		<!-- end analytics -->

	</head>
	
	<!-- Uncomment this line if using the Off-Canvas Menu --> 
		
	<body <?php body_class(); ?>>

		<div class="off-canvas-wrapper">
		
			<div class="off-canvas-content" data-off-canvas-content>
				
				<header id="masthead" class="site-header" role="banner">
					<div class="header-inside">
						<!-- Mobile menu toggle insert here & add fontawesome icon -->
							<?php $breakpoint = "medium"; ?>
								<div class="title-bar" data-responsive-toggle="top-bar-menu" data-hide-for="<?php echo $breakpoint ?>">
								<button class="menu-icon" type="button" data-toggle></button>
								<div class="title-bar-title"><?php _e( 'Menu', 'vdproduction' ); ?></div>
								</div>
						<!-- Header navigation menu -->
						<nav role="navigation" class="site-navigation main-navigation">
							<h1 class="assistive-text"><i class="fa fa-bars"></i> <?php _e( 'Menu', 'vdproduction' ); ?></h1>
							<!-- <?php joints_top_nav(); ?> -->
							<?php wp_nav_menu( array(
								'theme_location' => 'main-nav',
								'container_id'   => 'menu',
							) ); ?>
						</nav><!-- .site-navigation .main-navigation -->

						<?php if ( get_theme_mod( 'vdproduction_logo' ) ) { ?>

							<!-- Show the logo image -->
								<div class="logo">
									<h1 class="logo-image">
										<a href="<?php echo home_url( '/' ); ?>">
											<img src="<?php echo esc_url( get_theme_mod( 'vdproduction_logo' ) );?>" alt="<?php the_title_attribute(); ?>" />
											<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
										</a>
									</h1>
								</div>

						<?php } else { ?>

						<!-- Show the default site title and tagline -->
							<div class="logo logo-text">
								<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</h1>
								<p class="site-description"><?php bloginfo( 'description' ); ?></p>
							</div>

						<?php } ?>

						<!-- Get page titles and homepage header buttons -->
						<?php get_template_part( 'parts/template-titles' ); ?>
					</div><!-- .header-inside -->

		<!-- Get the header background image -->
		<?php 
			// get featured image if not homepage
			if ( is_home() && is_front_page() ) {
				// Get header opacity from Appearance > Customize > Header & Footer Image
				$header_opacity = get_theme_mod( 'vdproduction_bg_opacity', '0.2' );
				$header_image = get_header_image();
					if ( ! empty( $header_image ) ) { ?>

						<div class="site-header-bg-wrap">
						<div class="site-header-bg background-effect" style="background-image: url(<?php header_image(); ?>); opacity: <?php echo esc_attr( $header_opacity ); ?>;"></div>
						</div>
					<?php } ?>
			<?php } else { ?>
			<?php
				// Get header opacity from Appearance > Customize > Header & Footer Image
				$header_opacity = get_theme_mod( 'vdproduction_bg_opacity', '0.3' );
				$hero = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); 
					if ( ! empty( $hero ) ) { ?>

						<div class="site-header-bg-wrap">
						<div class="site-header-bg background-effect" style="background-image: url('<?php echo $hero['0'];?>'); opacity: <?php echo esc_attr( $header_opacity ); ?>;"></div>
						</div>
					<?php } ?>
			<?php } ?>
	</header><!-- .site-header -->