<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
	echo Theme::metaTags('title');
	echo Theme::metaTags('description');
	echo Theme::css(array(
		'assets/css/bootstrap.min.css',
		'assets/fonts/line-icons.css',
		'assets/css/slicknav.css',
		'assets/css/owl.carousel.min.css',
		'assets/css/owl.theme.css',
		'assets/css/slick.css',
		'assets/css/slick-theme.css',
		'assets/css/animate.css',
		'assets/css/main.css',
		'assets/css/responsive.css'
	));
	Theme::plugins('siteHead');
	?>
</head>
<body>
	<header id="header-wrap">
		<div id="hero-area" class="hero-area-bg">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="contents text-center">
							<h2 class="head-title wow fadeInUp"><?php echo $site->title(); ?></h2>
							<h6 class="head-slogan wow fadeInUp"><?php echo $site->slogan(); ?></h6>
							<div class="header-button wow fadeInUp" data-wow-delay="0.3s">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php
	if ($WHERE_AM_I == 'page') {
		?>
		<section><?php Theme::plugins('pageEnd') ?></section>
		<section class="section-padding">
			<div class="container">
				<div class="section-header text-center"><h2 class="section-title wow fadeInDown" data-wow-delay="0.3s"><?php echo $page->title(); ?></h2></div>
				<?php echo $page->content(); ?>
			</div>
		</section>
		<?php
	} else {
		foreach($content as $page){
			?>
			<section class="section-padding text-center">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="section-header text-center">
								<h2 class="section-title wow fadeInDown" data-wow-delay="0.3s"><?php echo $page->title(); ?></h2>
								<img src="<?php echo $page->coverImage(); ?>" alt="" /></a>
							</div>
						</div>
					</div>
					<p><?php echo $page->contentBreak(); ?></p>
				</div>
			</section>
			<hr>
			<?php
		}
	}
	?>
	<footer id="footer" class="footer-area section-padding">
		<div class="container">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
						<p><?php echo $site->description(); ?></p>
					</div>
					<div class="col-md-6 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.8s">
						<?php $socialNetworks = array('github'=>'Github','twitter'=>'Twitter','facebook'=>'Facebook','googleplus'=>'Google Plus','instagram'=>'Instagram','codepen'=>'Codepen','linkedin'=>'Linkedin'); ?>
						<h3 class="footer-titel">Links</h3>
						<ul>
							<?php
							foreach($socialNetworks as $key => $label){
								if ($site->{$key}()){
									?>
									<li><a href="<?php echo $site->{$key}(); ?>"><?php echo $label; ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>  
		</div> 
	</footer> 
	<section id="copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p><?php echo $site->footer(); ?></p>
					<p>Theme: <a href="https://philippdormann.de">Philipp Dormann</a></p>
				</div>
			</div>
		</div>
	</section>
	<!-- Go to Top Link --><a href="#" class="back-to-top"><i class="lni-arrow-up"></i></a>
	<!-- Preloader --><div id="preloader"><div class="loader" id="loader-1"></div></div>
	<?php
	echo Theme::javascript('assets/js/jquery-min.js');
	echo Theme::javascript('assets/js/popper.min.js');
	echo Theme::javascript('assets/js/bootstrap.min.js');
	echo Theme::javascript('assets/js/owl.carousel.min.js');
	echo Theme::javascript('assets/js/slick.min.js');
	echo Theme::javascript('assets/js/wow.js');
	echo Theme::javascript('assets/js/jquery.nav.js');
	echo Theme::javascript('assets/js/jquery.easing.min.js');
	echo Theme::javascript('assets/js/jquery.slicknav.js');
	echo Theme::javascript('assets/js/main.js');
	echo Theme::javascript('assets/js/form-validator.min.js');
	echo Theme::javascript('assets/js/contact-form-script.min.js');
	?>
	<?php Theme::plugins('siteBodyEnd'); ?>
</body>
</html>
