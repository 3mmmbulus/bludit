<header>
	<!-- Navbar -->
	<?php include(THEME_DIR_PHP.'navbar.php'); ?>
	<a href="<?php echo Theme::siteUrl() ?>">
		<h1>
			<!-- Site logo -->
			<?php if($site->logo()): ?>
				<img class="site-logo" src="<?php echo $site->logo() ?>" alt="Site logo">
			<?php endif ?>
			<!-- Site title -->
			<?php echo $site->title() ?>
		</h1>
	</a>
	<p><?php echo $site->slogan() ?></p>
</header>