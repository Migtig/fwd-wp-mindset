<?php
/**
 * The template for displaying the home page
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

			// Remember weird syntax for this function. this calls for "template-parts/content-page", 
			// but using the weird comma-separated shit gives a fallback route
			get_template_part( 'template-parts/content', 'page' );
		?>

		<section class="home-intro"></section>

		<section class="home-work"></section>
		

		<?php
		$args = array(
			'post_type' => 'fwd-work',
			'posts_per_page' => 4,
		);

		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			?>

			<section class="home-work">
			<h2>Featured Works</h2>

			<?php
			while( $query->have_posts() ) {
				$query->the_post();
				?>

				<article>
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
						<?php the_post_thumbnail('medium'); ?>
					</a>
				</article>

				<?php
			}
			?>
			</section>
			<?php
			wp_reset_postdata();

		}
		
		?>
		

		<section class="home-left"></section>

		<section class="home-right"></section>

		<section class="home-slider"></section>

		<section class="home-blog"></section>



		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
