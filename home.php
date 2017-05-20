<?php get_header(); ?>
			
	<div id="content">
	
		<div id="inner-content" class="row">
	
		    <main id="main" class="large-12 medium-12 columns" role="main">
				<div class="container">
					<div class="content-left-popular">
						<span><h3><?php esc_html_e( 'Popular', 'vdproduction' ); ?></h3></span>
					</div><!-- content-section -->
										
				</div><!-- container -->	
				<div id="content-row" class="left">	
					<?php
						function filter_where($where = '') {
							//posts in the last 30 days
							$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
							return $where;
						}
						add_filter('posts_where', 'filter_where');

						query_posts('post_type=post&posts_per_page=4&orderby=comment_count&order=DESC');

						while (have_posts()): the_post(); ?>

							<!-- To see additional archive styles, visit the /parts directory -->
							<?php get_template_part( 'parts/loop', 'archive-grid' ); ?>

					<?php
						endwhile;
						wp_reset_query();
					?>	
				    
					<?php joints_page_navi(); ?>
					
				</div><!-- content-row -->
				
				<div class="container">
					<div class="content-left-latest">
						<span><h3><?php esc_html_e( 'Latest', 'vdproduction' ); ?></h3></span>
					</div><!-- content-section -->
					
				</div><!-- container -->
				
				<div id="content-row" class="left">				
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			 
						<!-- To see additional archive styles, visit the /parts directory -->
						<?php get_template_part( 'parts/loop', 'archive-grid' ); ?>
				    
					<?php endwhile; ?>	

						<?php joints_page_navi(); ?>
					
					<?php else : ?>
											
						<?php get_template_part( 'parts/content', 'missing' ); ?>
						
					<?php endif; ?>
				
				</div><!-- content-row -->
																								
		    </main> <!-- end #main -->		    

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>