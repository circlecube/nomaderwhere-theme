<?php
/**
 * Template part for displaying posts in grid
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-item' ); ?>>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
			echo twentyseventeen_time_link();
			echo '</div><!-- .entry-meta -->';
		};

		the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php //the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
				<img src="http://fpoimg.com/200x200" >
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

</article><!-- #post-## -->
