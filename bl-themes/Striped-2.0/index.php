<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<meta name="author" content="Bludit CMS">

	<!-- Dynamic title tag -->
	<?php echo Theme::metaTags('title') ?>

	<!-- Dynamic description tag -->
	<?php echo Theme::metaTags('description') ?>

	<!-- Include Favicon -->
	<?php echo Theme::favicon('img/favicon.png') ?>

	<!-- Include CSS Styles from this theme -->
	<?php echo Theme::css('assets/css/main.css') ?>
	<?php echo Theme::css('assets/css/bludit.css') ?>

	<!-- Load plugins -->
	<?php Theme::plugins('siteHead') ?>
</head>
<body class="is-preload">

	<!-- Load plugins -->
	<?php Theme::plugins('siteBodyBegin') ?>

	<?php include(THEME_DIR_PHP.'sidebar.php') ?>

	<!-- Content -->
	<?php
		if ($WHERE_AM_I == 'page') {
			include(THEME_DIR_PHP.'page.php');
		} else {
			include(THEME_DIR_PHP.'home.php');
		}
	?>

	<!-- Javascript -->
	<?php echo Theme::jquery() ?>
	<?php echo Theme::js('assets/js/browser.min.js') ?>
	<?php echo Theme::js('assets/js/breakpoints.min.js') ?>
	<?php echo Theme::js('assets/js/util.js') ?>
	<?php echo Theme::js('assets/js/main.js') ?>

	<!-- Load plugins -->
	<?php Theme::plugins('siteBodyEnd') ?>

</body>
</html>