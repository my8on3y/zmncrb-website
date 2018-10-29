<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package zmncrb.ru
 */

get_header();
?>

	<section id="primary" class="content-area container">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h3 class="page-title"><i class="fa fa-search" style="color: #1565c0"></i>
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Результаты для: %s', 'zmncrb-ru' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h3>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
