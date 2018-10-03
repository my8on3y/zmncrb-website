<?php
/**
 * The template for displaying all new's posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package zmncrb.ru
 */

$news_posts = get_posts( array(
	'numberposts' => 5,
	'category'    => 3,
	'orderby'     => 'date',
	'order'       => 'DESC',
	'include'     => array(),
	'exclude'     => array(),
	'meta_key'    => '',
	'meta_value'  =>'',
	'post_type'   => 'post',
	'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
) );

foreach( $news_posts as $post ){
	setup_postdata($post);
    // формат вывода the_title() ...
}

wp_reset_postdata(); // сброс