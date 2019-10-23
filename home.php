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
			// while ( have_posts() ) : the_post();

			// 	get_template_part( 'template-parts/page/content', 'page' );

			// endwhile; // End of the loop.
			?>

			<div class="latest-grid">
			<?php
				// WP_Query arguments
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				$args = array(
					'posts_per_page' => 99,
					'post-type'	     => 'post',
					'pages'          => $paged
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
							echo '</div>'; //close grid
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
					?>
					<div class="pagination">
						<?php
							echo paginate_links( array(
								'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
								'total'        => $query->max_num_pages,
								'current'      => max( 1, get_query_var( 'paged' ) ),
								'format'       => '?paged=%#%',
								'show_all'     => false,
								'type'         => 'plain',
								'end_size'     => 2,
								'mid_size'     => 1,
								'prev_next'    => true,
								'prev_text'    => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
								'next_text'    => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
								'add_args'     => false,
								'add_fragment' => '',
							) );
						?>
					</div>

					<?php
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
