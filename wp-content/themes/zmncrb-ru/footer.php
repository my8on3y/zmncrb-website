<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zmncrb.ru
 */

?>

	</div><!-- #content -->
	</main>
	<footer class="footer-section">

		<div class="container">
			<div class="row">
				<div class="col-lg-5"><h4>Наши координаты</h4>
				<ul>
					<li>КГБУЗ "ЦРБ г. Змеиногорска"</li>
					<li><i class="fa fa-map-marker-alt"></i> 658480, Алтайский край, г. Змеиногорска, ул. Фролова 18</li>
					<li><i class="fa fa-phone"></i> Приёмная главного врача: 8(38587) 2-25-24</li>
					<li><i class="fa fa-phone"></i> Регистратура поликлиники: 8(38587) 2-18-20</li>
					<li><i class="fa fa-phone"></i> Регистратура детская к-ия: 8(38587) 2-08-75</li>
					<li><i class="fa fa-envelope"></i> e-mail: zmncrb@zmncrb.ru</li>
				</ul>
				</div>
				<div class="col-lg-4"><h4>Наши партнеры</h4></div>
				<div class="col-lg-3"><h4>Федеральные порталы</h4></div>
			</div>
			<div class="informers-section">
				<div class="footer-informer">
					<!-- Rating@Mail.ru logo -->
						<a href="https://top.mail.ru/jump?from=3065487">
						<img src="//top-fwz1.mail.ru/counter?id=3065487;t=433;l=1" 
						style="border:0;" height="31" width="88" alt="Рейтинг@Mail.ru" /></a>
					<!-- //Rating@Mail.ru logo -->
					<!-- Rating@Mail.ru counter -->
						<script type="text/javascript">
						var _tmr = window._tmr || (window._tmr = []);
						_tmr.push({id: "3065487", type: "pageView", start: (new Date()).getTime()});
						(function (d, w, id) {
						if (d.getElementById(id)) return;
						var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
						ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
						var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
						if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
						})(document, window, "topmailru-code");
						</script><noscript><div>
						<img src="//top-fwz1.mail.ru/counter?id=3065487;js=na" style="border:0;position:absolute;left:-9999px;" alt="" />
						</div></noscript>
					<!-- //Rating@Mail.ru counter -->

				</div>
			</div>

			<div class="text-center copyright"><p>&copy 2018 КГБУЗ "ЦРБ г.Змеиногорска" | Вопросы и комментарии link@zmncrb.ru. При использовании материалов с сайта ссылка обязательна.</p></div>
		</div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
