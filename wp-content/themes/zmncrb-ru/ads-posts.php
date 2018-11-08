<?php
/**
 * Template part for displaying home-page ad's posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zmncrb.ru
 */
?>
<!-- Вывод постов "новости" -->
<section id="ads-post" class="__section-bottom-margin">
    <div class="container __section-separator">
        <h3 class="-a-word __decor-line-in-headline"><i class="fa fa-paperclip"></i> Объявления</h3>
    </div>
    <div class="ads-post">
        <?php $ads_posts = get_posts( array(
				'numberposts' => 5,
				'category'    => 6,
				'orderby'     => 'date',
				'order'       => 'DESC',
				'include'     => array(),
				'exclude'     => array(),
				'meta_key'    => '',
				'meta_value'  =>'',
				'post_type'   => 'post',
				'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ));	?>
        <div class="container">
        <div class="row">
            <?php
							foreach( $ads_posts as $post ){
								setup_postdata($post); ?>
            <div class="col-lg-12 ads-block">
                <?php esc_attr( the_excerpt() ) ?>
            </div>
           </div>
            <?php 	
							}							
							wp_reset_postdata(); // сброс 
							?>
        </div>
    </div>
</section>