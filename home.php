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
		<main id="main" class="site-main blog" role="main">

		<?php
			// WP_Query arguments
			$args = array(
				'posts_per_page' => -1,
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
						the_date( 'F Y', '<h2 class="latest-grid-date">', '</h2>'  );
						echo '<div class="latest-grid">'; //open grid
					} else {
						$f = $query->current_post - 1;
						$old_date = mysql2date( 'F', $query->posts[$f]->post_date );
						if($current_month != $old_date) {
							echo '</div>'; //close grid
							the_date( 'F Y', '<h2 class="latest-grid-date">', '</h2>'  );
							echo '<div class="latest-grid">'; //open grid
						}
					}
					get_template_part( 'template-parts/post/content', 'grid' );
				}
				echo '</div>'; //close last grid

			} else {
				// no posts found
			}

			// Restore original Post Data
			wp_reset_postdata();
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
