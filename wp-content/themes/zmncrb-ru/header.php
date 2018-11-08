<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zmncrb.ru
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body id="select-body" <?php body_class(); ?>>
<header class="__header-section">

<section class="top-nav-panel">
	<div class="container">
		<div class="row">
			<div class="col-lg-4"></div>
				<div class="col-lg-8 top-nav-line">
						<div class="top-informer"><i class="fa fa-calendar-alt"></i><?php echo ' ' . date( "d.m.Y" ) ?></div>
						<div class="top-informer"><i class="fa fa-thermometer-half"></i><?php 
								if( @file_get_contents( 'http://api.openweathermap.org/data/2.5/forecast?id=1485042&APPID=13aaa71d9a2f582f139fd7cc6ec5b3cc') ) :
								$json = file_get_contents( 'http://api.openweathermap.org/data/2.5/forecast?id=1485042&APPID=13aaa71d9a2f582f139fd7cc6ec5b3cc');
								$JSON_Array = json_decode( $json, true );
								$JSON_value = round ( $JSON_Array['list'][0]['main']['temp'] - 273.15 ); 
								else: $json = 'обновление';
								endif;
								echo ' ' .  $JSON_value . '&deg C'; 
							?>
						</div>
						<div class="top-informer .geo-location"><i class="fa fa-map-marker-alt"></i> Zmeinogorsk</div>
					</div>
			</div>
		</div>
	</section>

<section class="brand-information">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-xs-12 logo">
				<img src="<?php echo get_template_directory_uri() . '/img/logo.png' ?>" width="80px" alt="">
				<h1>змеиногорская</h1>
				<h4>центральная районная больница</h4>
				<small>краевое государственное бюджетное учреждение здравоохранения</small>
			</div>
			<div class="col-lg-5 col-xs-12 visit-card-flex">
				<div class="visit-section"><h5>Приёмная главного врача</h5><span class="phone-number"><a href="tel:+7(38587)2-25-27">+7(38587) 2-25-27 </a><i class="fa fa-mobile-alt"></i></span></div>
				<div class="visit-section"><h5>Регистратура поликлиники</h5><span class="phone-number"><a href="tel:+7(38587)2-18-20">+7(38587) 2-18-20 </a><i class="fa fa-mobile-alt"></i></span></div>
				<div class="visit-section"><h5>Email</h5><span class="mail"><a href="mailto:zmncrb@zmncrb.ru">zmncrb@zmncrb.ru </a></span></div>
			</div>
			<div class="col-lg-3 search-panel">						
				<span class="blind-mode"><a itemprop="Copy" href="#" class="bt_widget-vi-on"><img src="http://zmncrb-website/wp-content/plugins/for-the-visually-impaired/img/icon_24.png" class="vi_widget_img"> Версия для слабовидящих</a></span>
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</section>
<section class="nav-panel">
	<div class="container">
		<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12">
					<div class="bottom-nav-line">
						<?php
						wp_nav_menu( array(
							'theme_location'  => 'nav-menu-top',
							'menu'            => 'Меню сайта',
							'container'		  =>  false,
							'depth'			  =>  3,
							'menu_class'      => 'menu', 
							'menu_id'         => 'nav-menu',
							'fallback_cb'	  => '',
							'items_wrap'	  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						));		
							?>						
					</div>	
				</div>
			</div>
		</div>
	</div>
</section>

</header>	<!-- #masthead -->
<main class="content-area">

