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

		<section class="home-intro">
			<h2><?php esc_html_e( 'Who We Are', 'fwd' ); ?></h2>
			<?php
			$args = array( 'page_id' => 15 );

			$intro_query = new WP_Query( $args );

			if ( $intro_query -> have_posts() ) {
				while ( $intro_query -> have_posts() ) {
					$intro_query -> the_post();
					the_content();
				}
				wp_reset_postdata();
			}
			?>
		</section>

		<section class="home-work">

		</section>
		

		<?php
		$args = array(
			'post_type'      => 'fwd-work',
			'posts_per_page' => 4,
			'tax_query'      => array(
				array(
					'taxonomy' => 'fwd-featured',
					'field'    => 'slug',
					'terms'    => 'front-page-works',
				)
			),
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
						<?php the_post_thumbnail( 'medium' ); ?>
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

		<section class="home-blog">
			<h2><?php esc_html_e( 'Latest Blog Posts', 'fwd' ); ?></h2>
			<?php
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => 4,
			);

			$blog_query = new WP_Query( $args );
			if ( $blog_query -> have_posts() ) {
				while ( $blog_query -> have_posts() ) {
					$blog_query -> the_post();
					?>
					<article>
						<?php
						the_post_thumbnail( 'preview-blog' );
						?>
						<a href="<?php the_permalink(); ?>">
							<h3><?php the_title(); ?></h3>
							<?php echo( get_the_date() ); ?>
						</a>

					</article>
					<?php
				}
				wp_reset_postdata();
			}
			?>
		</section>



		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #primary -->

<?php
get_sidebar();
get_footer();
