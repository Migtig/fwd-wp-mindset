<?php
/**
 * The template for displaying Work archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">


		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<?php
		$args = array(
			'post_type'      => 'fwd-work',
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'fwd-work-category',
					'field'    => 'slug',
					'terms'    => 'coding',
				)
			),
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo( '<section><h2>Coding</h2>');
			while( $query->have_posts() ) {
				$query->the_post();
				?>
				<article>
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
						<?php the_post_thumbnail('medium', array( 'class' => 'alignleft' ) ); ?>
					</a>
					<?php the_excerpt(); ?>
				</article>
				<?php
			}
			wp_reset_postdata();
			echo('</section>');
		}

		$args = array(
			'post_type'      => 'fwd-work',
			'posts_per_page' => -1,
			'tax_query'      => array(
				array(
					'taxonomy' => 'fwd-work-category',
					'field'    => 'slug',
					'terms'    => 'design',
				)
			),
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			echo( '<section><h2>Design</h2>');
			while( $query->have_posts() ) {
				$query->the_post();
				?>
				<article>
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
						<?php the_post_thumbnail('medium', array( 'class' => 'alignleft' ) ); ?>
					</a>
					<?php the_excerpt(); ?>
				</article>
				<?php
			}
			wp_reset_postdata();
			echo('</section>');
		}


		?>

	</main><!-- #primary -->

<?php
get_footer();
