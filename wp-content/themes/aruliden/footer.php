			<footer class="footer">
			
				<div class="container-full instagram-feed">
				<h2>Instagram</h2>
					<div class="row">
						<div class="img">
							<img src="<?php echo get_template_directory_uri(); ?>/images/insta1.jpg" alt="#" />
						</div>
						<div class="img">
							<img src="<?php echo get_template_directory_uri(); ?>/images/insta2.jpg" alt="#" />
						</div>
						<div class="img">
							<img src="<?php echo get_template_directory_uri(); ?>/images/insta3.jpg" alt="#" />
						</div>
						<div class="img">
							<img src="<?php echo get_template_directory_uri(); ?>/images/insta4.jpg" alt="#" />
						</div>
						<div class="img">
							<img src="<?php echo get_template_directory_uri(); ?>/images/insta5.jpg" alt="#" />
						</div>
					</div>

				</div>

				<div class="container-full footer-bottom">
				<div class="row">
					<div class="col-sm-2">
						<ul class="footer-social">
							<?php include (TEMPLATEPATH . '/_inc/socialmedialinks.php' ); ?>
						</ul>
					</div>
					<div class="col-sm-4 form">
						<h4>Newsletter</h4>
						<form>
							<input type="text" placeholder="Enter your email">
							<input type="submit" value="Subscribe"/>
						</form>
					</div>
					<div class="col-sm-6 copyright">
							<a href="#">&copy; 2017 aruliden</a>
					</div>
				</div>
				</div>
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
				
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>


		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-viewport-checker/1.8.7/jquery.viewportchecker.min.js"></script> 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
		<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
		<?php if(!is_single()){?>
		<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
		<?php } ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.4.2/parallax.min.js"></script>
		<script src="http://www.jqueryscript.net/demo/Smooth-Mouse-Wheel-Scrolling-Plugin-With-jQuery-easeScroll/jquery.easeScroll.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			// hide our element on page load
			

			window.sr1 = ScrollReveal({ duration: 1500, scale: 1, distance: '100px', });

			sr1.reveal('.banner-text');

			sr1.reveal('.news-content', { duration: 2000 });
			sr1.reveal('.news-img');
			
			
			sr1.reveal('.text', { duration: 2000 });
			sr1.reveal('.img-animate', {easing: 'ease'});
			
			sr1.reveal('.lead-img', 200);
			sr1.reveal('.img', 200);
			sr1.reveal('.news-grid', 300, {easing: 'ease'});
			sr1.reveal($(this).find('.seq-heading'), 500);
			
			//----Parallax Slider---//
			$('.parallax-window').parallax({
				imageSrc: "<?php echo get_template_directory_uri(); ?>/images/bg-1.jpg",
			
			});
			//----Accordion---//			
			$( ".acc" ).each(function( index ) {
				if (!$(this).hasClass('active'))
				sr1.reveal($(this).find('.seq-text'), 200, { distance: 0 });
			});
			
			$(".acc").click(function(){
				sr1.reveal($(this).find('.seq-text'), 200, { distance: 0 });
			})
			//----Ease Scroll---//
			$("html").easeScroll({
				frameRate: 60,
				animationTime: 1000,
				stepSize: 60,
				pulseAlgorithm: 1,
				pulseScale: 8,
				pulseNormalize: 1,
				accelerationDelta: 20,
				accelerationMax: 1,
				keyboardSupport: true,
				arrowScroll: 50,
				touchpadSupport: true,
				fixedBackground: true
			});
			$('.navbar').removeClass('expand');
			$(window).on('scroll', function () {
				$(".parallax-window").css({
					'opacity': 1 - (($(this).scrollTop()) / 200)
				});
				if ($(this).scrollTop() > 200) {
					if (!$('.navbar').hasClass('expand')) {
						$('.navbar').addClass('expand');
					}
				} else {
					if ($('.navbar').hasClass('expand')) {
						$('.navbar').removeClass('expand');
					}
				}
			});   
		});    
		</script>	


	</body>

</html>