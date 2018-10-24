<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zmncrb.ru
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		$title = the_title( '', '', 0 );
		$titleArr = explode( ' ', $title );
		$titleContent = implode(' ', array_slice( $titleArr, 1, 15 ) ); 
		if ( is_singular() ) :
			echo '<h2 class="entry-title"><i class="fa fa-quote-left" style="color: #6b6b6b;"></i> <span class="-b-word">' . $titleArr[0] . '</span> ' . $titleContent . '</h2>';
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">

			</div><!-- .entry-meta -->
		<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'zmncrb-ru' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		?>
	</div><!-- .entry-content -->

