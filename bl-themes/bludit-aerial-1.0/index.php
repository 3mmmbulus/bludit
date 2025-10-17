<!-- Header -->
<?php include(THEME_DIR_PHP.'header.php'); ?>

					<header id="header">
						<h1><?php echo $page->title(); ?></h1>
						<p><?php echo $page->content(); ?></p>
					<nav>
							<ul>
								<li><a target="_blank" href="<?php echo $site->twitter() ?>" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
								<li><a target="_blank" href="<?php echo $site->facebook() ?>" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
								<li><a target="_blank" href="<?php echo $site->github() ?>" class="icon brands fa-github"><span class="label">Github</span></a></li>
							</ul>
						</nav>
					</header>

<!-- Footer -->
<?php include(THEME_DIR_PHP.'footer.php'); ?>