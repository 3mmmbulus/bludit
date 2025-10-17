<!DOCTYPE html>
<html lang="<?php echo Theme::lang() ?>">
<head>
	<?php include(THEME_DIR_PHP.'head.php'); ?>
</head>

<body>
	<!-- Load Bludit Plugins: Site Body Begin -->
	<?php Theme::plugins('siteBodyBegin'); ?>

	<!-- Header -->
	<?php include(THEME_DIR_PHP.'header.php'); ?>

	<div class="wrapper">
		<!-- Content -->
		<main>
			<?php
				if ($WHERE_AM_I == 'page') {
					include(THEME_DIR_PHP.'page.php');
				} else {	
					if ($WHERE_AM_I == 'category') {
						$categoryKey = $url->slug();
						$category = new Category($categoryKey);
						echo '<h2>';
						include(THEME_DIR_IMG . 'icons/category_big.svg');
						echo ' ' . $category->name() . '</h2>';
					}
					else if ($WHERE_AM_I == 'tag') {
						$tagKey = $url->slug();
						$tag = new Tag($tagKey);
						echo '<h2>';
						include(THEME_DIR_IMG . 'icons/tag_big.svg');
						echo ' ' . $tag->name() . '</h2>';
					}
					include(THEME_DIR_PHP.'home.php');			
				}
			?>
		</main>
		
		<?php if($plugins['siteSidebar']): ?>	
			<!-- Sidebar -->
			<aside>
				<?php include(THEME_DIR_PHP.'sidebar.php'); ?>
			</aside>
		<?php endif ?>
	</div>

	<!-- Footer -->
	<?php include(THEME_DIR_PHP.'footer.php'); ?>

	<!-- Load Bludit Plugins: Site Body End -->
	<?php Theme::plugins('siteBodyEnd'); ?>	
</body>
</html>