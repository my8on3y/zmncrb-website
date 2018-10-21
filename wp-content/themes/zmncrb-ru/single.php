<?php
/*
Template Name: time-table template
*/

get_header();
?>

	<div id="primary" class="content-area container">
		<div class="row">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );	
				endwhile; // End of the loop.
		?>
		</div>
	</div><!-- #primary -->

<?php
get_footer();
