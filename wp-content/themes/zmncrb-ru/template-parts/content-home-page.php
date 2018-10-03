<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package zmncrb.ru
 */

?>
		
		<div class="site-map" id="site-map">
				<div id="site-map-toggle-button">Навигация по странице</div>
					<span class="--like-h2"><i class="fa fa-list-ul"></i> Навигация</span>
					<ul>
						<li><a href="#">О больнице</a></li>
						<li><a href="#">Новости</a></li>
						<li><a href="#">Схема проезда</a></li>
						<li><a href="#">Министерство</a></li>
						<li><a href="#">Что-то</a></li>
						<li><a href="#">Что-то</a></li>
						<li><a href="#">Что-то</a></li>
						<li><a href="#">Подвал</a></li>
					</ul>
				</div>
		<section class="landing-carousel" style="background-image: url('<?php echo get_template_directory_uri() . "/img/doc1.png" ?>'); background-size: 45vh;">
			<div class="__cover-block"></div>
			<div class="inform-path">
				<div class="container">
					<div class="row">
						<div class="col-lg-6"></div>
						<div class="col-lg-6 main-central-informer">
							<div class="inform-card">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab aspernatur cumque laboriosam
									nam nesciunt nostrum officiis similique suscipit voluptatem! Aliquid dicta ducimus labore modi
									necessitatibus quia, quis ratione sed!</p>
								<div class="int-button"><a href="#" class="">Продолжить</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="control-panel">
						<a href="#" class="-control-panel_button"><i class="fa fa-headset"></i><h3>Записаться на прием</h3></a>
						<a href="#" class="-control-panel_button"><i class="fa fa-clock"></i><h3>Расписание приемов</h3></a>
						<a href="#" class="-control-panel_button"><i class="fa fa-phone-square"></i><h3>Контакты</h3></a>
						<a href="#" class="-control-panel_button"><i class="fa fa-comment"></i><h3>Обратная связь</h3></a>
					</div>
				</div>
			</div>
		</section>
		<section class="content-block parallax-window" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri() . '/img/tsrb-poliklinnika.jpg' ?>">
			<div class="__cover-block"></div>
			<div class="container">
				<div class="row">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 text-block">
								<h2><i class="fa fa-asterisk"></i><span class="-a-word"> Змеиногорская</span> Центральная Районная Больница <i class="fa fa-asterisk"></i></h2>
								<p>Краевое государственное бюджетное учреждение здравоохранения <span class="-a-word">"Центральная Районная Больница города Змеиногорска"</span><small><br><a
										href="#">( Лицензия № ЛО–22–01–004898 от 23.03.18 г.)</a></small>
									образована в 1929 году. Сегодня это современное многопрофильное лечебное учреждение,
									оснащенное высокотехнологичным оборудованием и укомплектованное квалифицированным персоналом.<br>
									Коллектив больницы успешно решает задачи по охране здоровья населения Змеиногорского района.<br>
									<ul><u>Медицинскую помощь оказывают:</u>
										<li><a href="#">терапевт</a></li>
										<li><a href="#">педиатр</a></li>
										<li><a href="#">хирург</a></li>
										<li><a href="#">акушер-гинеколог</a></li>
										<li><a href="#">анестезиолог-реаниматолог</a></li>
										<li><a href="#">невролог</a></li>
										<li><a href="#">врач функциональной диагностики</a></li>
										<li><a href="#">рентгенолог</a></li>
										<li><a href="#">специалист УЗИ</a></li>
										<li><a href="#">дерматовенеролог</a></li>
										<li><a href="#">врач общей практики</a></li>
									</ul>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Вывод постов "новости" -->
		<section class="news">
			<div class="container">
				<div class="__section-separator"><i class="fa fa-paperclip"></i><h2 class="-a-word"> Новости</h2></div>
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

		<?php
		the_content();
		
?>