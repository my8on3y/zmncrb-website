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
						<li><a href="#news" rel='m_PageScroll2id'>Новости</a></li>
						<li><a href="#">Схема проезда</a></li>
						<li><a href="#">Министерство</a></li>
						<li><a href="#">Что-то</a></li>
						<li><a href="#">Что-то</a></li>
						<li><a href="#">Что-то</a></li>
						<li><a href="#">Подвал</a></li>
					</ul>
				</div>

		<section class="landing-carousel">
			<div class="section-background"></div>
			<div class="__cover-block"></div>
			<div class="autoplay main-central-slider">
				<?php require get_template_directory() . '/slider/home-page-slider.php'; ?>
			</div>
			<div class="control-panel">
						<a href="#" class="-control-panel_button"><i class="fa fa-headset"></i>Записаться на прием</a>
						<a href="<?php echo get_page_by_path( '/time-table-page' ) -> guid ?>" class="-control-panel_button"><i class="fa fa-clock"></i>Расписание приемов</a>
						<a href="#" class="-control-panel_button"><i class="fa fa-phone-square"></i>Контакты</a>
						<a href="#" class="-control-panel_button"><i class="fa fa-comment"></i>Обратная связь</a>
			</div>
		</section>
		<section id="parral" class="content-block __section-bottom-margin">
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
		<section id="news" class="news __section-bottom-margin" rel='m_PageScroll2id'>
			<div class="container">
				<div class="__section-separator"><h3 class="-a-word __decor-line-in-headline" data-scroll="toggle(.visible-st, .invisible-st); once"><i class="fa fa-paperclip"></i> Новости</h3></div>
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

			<!-- Информация о составе -->
			<section class="include-inform __section-bottom-margin" data-scroll="once" data-scroll-showCallback="triggerStartNum()">
				<div class="container">
				<div class="__section-separator"><h3 class="-a-word __decor-line-in-headline"><i class="fa fa-clipboard-list"></i> Состав ЦРБ</h3></div>
					<div class="row">
						<table class="text-center"s>
							<tr>
								<th><i class="fa fa-bed"></i></th>
								<th><i class="fa fa-hospital-alt"></i></th>
								<th><i class="fa fa-child"></i></th>
								<th><i class="fa fa-female"></i></th>
								<th><i class="fa fa-hospital"></i></th>
								<th><i class="fa fa-home"></i></th>
							</tr>					
							<tr>
								<th>стационар</th>
								<th>поликлиника</th>
								<th>детская консультация</th>
								<th>женская консультация</th>
								<th>врачебных амбулаторий</th>
								<th>ФАП’ов</th>
							</tr>						
							<tr><td><span id="informNum1" style="font-size: 20pt; color: #29b6f6"></span> койка</td>
							<td><span id="informNum2" style="font-size: 20pt; color: #29b6f6"></span> посещений</td>
							<td><span id="informNum3" style="font-size: 20pt; color: #29b6f6"></span> посещений</td>
							<td><span id="informNum4" style="font-size: 20pt; color: #29b6f6"></span> посещений</td>
							<td><span id="informNum5" style="font-size: 20pt; color: #29b6f6"></span></td>
							<td><span id="informNum6" style="font-size: 20pt; color: #29b6f6"></span></td></tr>
						</table>
					</div>
				</div>
			</section>
			
			<section class="organisation-work-time __section-bottom-margin">
				<div class="container">
					<div class="__section-separator"><h3 class="__decor-line-in-headline"><i class="fa fa-clipboard-list"></i><span class="-a-word"> Режим</span> работы</h3></div>
					<div class="row">
						<div class="col-lg-12">
							<table class="" align="left" style="width: 100%;">
								<tr align="left"><th><i class="fa fa-hospital" style="color: #D93240;"></i> Отделение</th><th><i class="fa fa-clock" style="color: #D93240;"></i> Режим работы</th></tr>
								<tr><td>Стационар</td><td>круглосуточно</td></tr>
								<tr><td>Поликлиника </td><td>с 7.30 - 20.00</td></tr>
								<tr><td>Детская консультация</td><td>с 7.30 - 17.00 </td></tr>
								<tr><td>Женская консультация</td><td>с 8.00 - 17.00</td></tr>
								<tr><td>Административная часть</td><td>с 8.30 - 16.48</td></tr>
							</table>
						</div>
				</div>
			</section>

			<section class="yandex-map  __section-bottom-margin">
				<div class="container">
					<div class="__section-separator"><h3 class="__decor-line-in-headline"><i class="fa fa-map"></i><span class="-a-word"> Схема</span> проезда</h3></div>
				</div>
				<div class="map">
					<div class="container">
						<div class="row">
							<div class="col-lg-8"><iframe id="yandex-map" src="https://yandex.ru/map-widget/v1/-/CBB9IZtQ0B" width="100%" height="400" frameborder="1" allowfullscreen="true" style="border: none;"></iframe></div>
							<div class="col-lg-4">
								<ul><h3>Схема проезда</h3>
									<li>Змеиногосркая ЦРБ</li>
									<li>Автобусный маршрут №2</li>
									<li>улица Фролова 18</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php
		the_content();
		get_sidebar();
		
?>