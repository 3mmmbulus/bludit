<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="Bludit CMS">

<!-- Dynamic title tag -->
<?php echo Theme::metaTags('title'); ?>

<!-- Dynamic description tag -->
<?php echo Theme::metaTags('description'); ?>

<!-- Include Favicon -->
<?php echo Theme::favicon('img/favicon.png'); ?>

<!-- Include CSS Styles from this theme -->
<?php echo Theme::css('css/moran.css'); ?>

<!-- Include JS from this theme -->
<?php echo Theme::js('js/moran-min.js'); ?>
<?php echo Theme::js('js/analytics.js'); ?>
<?php echo Theme::js('js/jquery-1.11.3.min.js'); ?>
<?php echo Theme::js('js/iqs3otp.js'); ?>

<!-- Load Bludit Plugins: Site head -->
<?php Theme::plugins('siteHead'); ?>
