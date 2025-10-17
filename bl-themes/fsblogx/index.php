<!DOCTYPE html>
<html lang="<?php echo Theme::lang() ?>">
<head>
<?php include(THEME_DIR_PHP.'head.php'); ?>
</head>
<body>

	<?php 
	echo '<div class="bodybegin">';
	Theme::plugins('siteBodyBegin');
	echo '</div>';
	?>

	<?php include(THEME_DIR_PHP.'navbar.php'); ?>

	<div class="container">	
	
	<?php if($_ENABLE_DEFAULT_ENTRY_BANNER and $WHERE_AM_I =='home') echo '<img src="'. $_DEFAULT_ENTRYBANNER_IMAGE .'" alt="'.$site->slogan().'" class="banner-entry">'; ?>
	
		<div class="row">

			<div class="col-md-9 content">
			<?php
				if ($WHERE_AM_I == 'page') 				
					include(THEME_DIR_PHP.'page.php');
				
				else if ($WHERE_AM_I == 'authors')
						include(THEME_DIR_PHP.'authors.php');
					
				else
					include(THEME_DIR_PHP.'home.php');								
			?>
			</div>

			<div class="col-md-3 csidebar">
			<?php Theme::plugins('siteSidebar') ?>
			</div>

		</div>
	</div>

	<?php include(THEME_DIR_PHP.'footer.php'); ?>

	<?php
		echo Theme::jquery();		
		echo Theme::jsBootstrap();
	
		echo '<div class="bodyend">';
		Theme::plugins('siteBodyEnd'); 
		echo '</div>';
	?>
</body>
</html>