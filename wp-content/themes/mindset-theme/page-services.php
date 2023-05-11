<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

	<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<!-- Loop to display links to individual service pages -->
		<?php
		$args = array(
			'post_type' => 'fwd-service',
			'posts_per_page' => -1,
			'order' => 'ASC',
		);
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while( $query->have_posts() ) {
				$query->the_post();
				?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</br>

				<?php
			}
			wp_reset_postdata();
		}
		?>

		<!-- Loop to display services -->
		<?php
		$args = array(
			'post_type' => 'fwd-service',
			'posts_per_page' => -1,
			'order' => 'ASC',
		);
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while( $query->have_posts() ) {
				$query->the_post();
				?>
				<article>
					<h3><?php the_title(); ?></h3>
					<!-- NEED TO REPLACE/FIX THIS WITH STUFF FROM DAY 5 -->
					<?php 
					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'description' ) ) {
							the_field( 'description' );
						}
					}
					?>
				</article>

				<?php
			}
			wp_reset_postdata();
		}
		?>

	<?php 
	// Output links to the Work Categories
	get_template_part( 'template-parts/work', 'categories' ); 
	?>

	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
