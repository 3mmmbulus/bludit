<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="generator" content="Bludit">

<!-- Dynamic <title> -->
<?php echo Theme::metaTags('title') ?>

<!-- Dynamic <meta name="description" ...> -->
<?php echo Theme::metaTags('description') ?>

<!-- Include Favicon -->
<?php echo Theme::favicon('img/favicon.png') ?>

<!-- Include Bootstrap CSS file bootstrap.css, this is part of Bludit core -->
<?php echo Theme::cssBootstrap() ?>
<?php echo Theme::cssLineAwesome() ?>

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

<!-- Include CSS Styles from the theme -->
<?php echo Theme::css('css/clean-blog.min.css') ?>
<?php echo Theme::css('css/bludit.css') ?>

<!-- Load plugins siteHead -->
<?php Theme::plugins('siteHead') ?>
