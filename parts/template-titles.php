<?php
//Template for displaying post and page titles in the header.

?>

<?php if ( is_home() && is_front_page() ) { ?>

<div class="hero-title">
	<div class="hero-title-inside">
		<?php 
			// Get the header texts from the options in customizer
			$header_one_text = get_option( 'vdproduction_header_hero_one_text' );
			$header_two_text = get_option( 'vdproduction_header_hero_two_text' );
		?>
		<h2 class="title"><?php echo esc_attr( $header_one_text ); ?></h2>
			<p class="entry-subtitle"><?php echo esc_attr( $header_two_text ); ?></p>
			
			<?php 
			// Show the custom header text and button on homepage		
		
			// Get the first CTA button link from Appearance > Customize > Theme Options -> Homepage Header Section
			if ( get_theme_mod( 'vdproduction_header_button_one_link' ) ) {

				$button_page_id = get_theme_mod( 'vdproduction_header_button_one_link' );
				$button_url = get_permalink( $button_page_id );

				if ( get_option( 'vdproduction_header_button_one_text' ) ) {
					$button_text = get_option( 'vdproduction_header_button_one_text' );

				} else {
					$button_text = get_the_title( $button_page_id );
				} ?>

				<a class="cta-button button button-one" href="<?php echo esc_url( $button_url ); ?>" title="<?php echo esc_attr( $button_text ); ?>">
					<?php echo $button_text; ?>
				</a>
				<?php
			}
			?>
			<?php
			// Get the second CTA button link from Appearance > Customize > Theme Options -> Homepage Header Section
			if ( get_theme_mod( 'vdproduction_header_button_two_link' ) ) {

				$button_two_page_id = get_theme_mod( 'vdproduction_header_button_two_link' );
				$button_two_url = get_permalink( $button_two_page_id );

				if ( get_option( 'vdproduction_header_button_two_text' ) ) {
					$button_two_text = get_option( 'vdproduction_header_button_two_text' );

				} else {
					$button_two_text = get_the_title( $button_two_page_id );
				} ?>

				<a class="cta-button button button-two" href="<?php echo esc_url( $button_two_url ); ?>" title="<?php echo esc_attr( $button_two_text ); ?>"><?php echo $button_two_text; ?></a>
				<?php
			} ?>
			
	</div>
</div>
	
<?php } else { ?>

<div class="hero-title">
	<div class="hero-title-inside">
		<h2 class="title">
			<?php
				if ( is_category() ) :
					single_cat_title();

				elseif ( is_tag() ) :
					single_tag_title();

				elseif ( is_author() ) :
					the_post();
					printf( __( 'Author: %s', 'vdproduction' ), '' . get_the_author() . '' );
					rewind_posts();

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'vdproduction' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'vdproduction' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'vdproduction' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

				elseif ( is_404() ) :
					_e( 'Page Not Found', 'vdproduction' );

				elseif ( is_search() ) :
					printf( __( 'Search Results for: %s', 'vdproduction' ), '<span>' . get_search_query() . '</span>' );

				else :
					single_post_title();

				endif;
			?>
		</h2>


		<?php
			// Get the blog page ID
			if ( ! defined( 'get_the_ID' ) ) {
				$blog_id = get_the_id();
			}
			$page_id = ( 'page' == get_option( 'show_on_front' ) ? get_option( 'page_for_posts' ) : $blog_id );

			// Get post and page subtitles
			if ( is_singular() && function_exists( 'the_subtitle' ) ) { ?>
				<?php the_subtitle( '<p class="entry-subtitle">', '</p>' ); ?>
		<?php } elseif ( is_home() && is_front_page() ) { ?>
			
		<?php } ?>

		
		<?php do_action( 'vdproduction_below_page_titles' ); ?>
	</div><!-- .hero-title-inside -->
</div><!-- .hero-title -->

<?php } ?>