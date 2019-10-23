<?php
/**
 * Template Name: Blog
 *
 * If the user has selected a static page for their blog posts, this is what will
 * appear. 
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main home" role="main">

			<?php
			// while ( have_posts() ) : the_post();

			// 	get_template_part( 'template-parts/page/content', 'page' );

			// endwhile; // End of the loop.
			?>

			<div class="latest-grid">
			<?php
				//loop and get latest posts - display as a grid of thumbnials with hover state	
				// WP_Query arguments
				$args = array(
					'posts_per_page' => '99',
					'post-type'	     => 'post',
				);

				// The Query
				$query = new WP_Query( $args );
				
				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						// do something
						$current_month = get_the_date('F');
						if( $query->current_post === 0 ) { 
							the_date( 'F Y', '<h2>', '</h2>'  );
						} else {
							$f = $query->current_post - 1;       
							$old_date = mysql2date( 'F', $query->posts[$f]->post_date ); 
							if($current_month != $old_date) {
								the_date( 'F Y', '<h2>', '</h2>'  );
							}
						}
						get_template_part( 'template-parts/post/content', 'grid' );
					}
				} else {
					// no posts found
				}

				// Restore original Post Data
				wp_reset_postdata();
			?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();