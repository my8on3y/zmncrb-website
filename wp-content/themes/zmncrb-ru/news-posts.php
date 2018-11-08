<?php
/**
 * Template part for displaying home-page new's posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zmncrb.ru
 */
?>
    <!-- Вывод постов "новости" -->
    <section id="news" class="news __section-bottom-margin" rel='m_PageScroll2id'>
			<div class="container">
				<div class="__section-separator"><h3 class="-a-word __decor-line-in-headline" data-scroll="toggle(.visible-st, .invisible-st); once"><i class="fa fa-rss-square"></i> Новости</h3></div>
				<?php $news_posts = get_posts( array(
				'numberposts' => 4,
				'category'    => 3,
				'orderby'     => 'date',
				'order'       => 'DESC',
				'include'     => array(),
				'exclude'     => array(),
				'meta_key'    => '',
				'meta_value'  =>'',
				'post_type'   => 'post',
				'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
				));	?>	
					<div class="row">
							<?php
							foreach( $news_posts as $post ){
								setup_postdata($post); ?>
								<div class="col-lg-6 news-block">
							<?php $thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );  ?>
							
								<img 
									src="<?php echo ( $thumbnail_attributes[0] == null ) ? get_template_directory_uri() . '/img/page-texture.jpg' : $thumbnail_attributes[0];?>"  
									width="140" 
									height="140"  
									alt="Новость">
								<i class="fa fa-quote-left"></i>
								<h3>
									<a 
										href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</h3>
									<?php the_excerpt() ?>
								</div>
							<?php 	
							}							
							wp_reset_postdata(); // сброс 
							?>
					</div>
				</div>
			</section> 