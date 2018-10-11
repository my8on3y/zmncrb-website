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

		<section class="landing-carousel __section-bottom-margin">
			<div class="section-background"></div>
			<div class="__cover-block"></div>	
			<div class="mega-title">
				<div class="animated fadeInDown text-center"><h1>Приветствуем Вас на официальном сайте</h1></div>
				<div class="animated fadeInDown text-center"><h2>Центральной Районной болницы</h2></div>
				<div class="animated fadeInDown text-center"><h5>города</h5><h2> Змеиногорска</h2></div>
			</div>
			<div class="autoplay main-central-slider">
					<div>Ей</div>
					<div>Все</div>
					<div>Шелка</div>
					<div>Цветные</div>
					</div>
			<div class="container">
				<div class="row">
					<div class="control-panel">
					<!-- Изменить шрифт для кнопок !!растягивающийся -->
						<a href="#" class="-control-panel_button"><i class="fa fa-headset"></i>Записаться на прием</a>
						<a href="#" class="-control-panel_button"><i class="fa fa-clock"></i>Расписание приемов</a>
						<a href="#" class="-control-panel_button"><i class="fa fa-phone-square"></i>Контакты</a>
						<a href="#" class="-control-panel_button"><i class="fa fa-comment"></i>Обратная связь</a>
					</div>
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
			<section class="include-inform" data-scroll="once" data-scroll-showCallback="triggerStartNum()">
				<div class="container">
				<div class="__section-separator"><h3 class="-a-word __decor-line-in-headline"><i class="fa fa-clipboard-list"></i> Состав ЦРБ</h3></div>
					<div class="row">
						<table class="text-center">
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
						<!-- <div class="col-lg-2 text-center"><h3>стационар</h3>91 койка</div>
						<div class="col-lg-2 text-center"><h3>поликлиника</h3>260 посещений</div>
						<div class="col-lg-2 text-center"><h3>детская консультация</h3>60 посещений</div>
						<div class="col-lg-2 text-center"><h3>женская консультация</h3>40 посещений</div>
						<div class="col-lg-2 text-center"><h3>врачебных амбулаторий</h3>2</div>
						<div class="col-lg-2 text-center"><h3>ФАП’ов</h3>16</div> -->
						<!-- <ul>
							<li>стационар на 91 койку (61 койка круглосуточного и 30 коек дневного стационара).</li>
							<li>поликлиника на 260 посещений.</li>
							<li>детская консультация на 60 посещений.</li>
							<li>женская консультация на 40 посещений. </li>
							<li>2 врачебные амбулатории.  </li>
							<li>16 ФАП’ов.</li>
						</ul> -->
						<!-- <p>This plugin only <span data-scroll data-scroll-showCallback="customFunction" data-scroll-hideCallback="customFunction('Invisible')" id="lines">0</span> lines of code.</p> -->
					</div>
				</div>
			</section>
		
		<?php
		the_content();
		
?>