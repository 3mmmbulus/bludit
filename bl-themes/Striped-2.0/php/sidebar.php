<!-- Sidebar -->
<div id="sidebar">

	<!-- Logo -->
	<h1 id="logo"><a href="<?php echo Theme::siteUrl() ?>"><?php echo $site->title() ?></a></h1>

	<!-- Current posts in the page -->
	<nav id="nav">
		<ul>
			<?php foreach ($content as $page): ?>
				<li><a href="<?php echo '#'.$page->slug() ?>"><?php echo $page->title() ?></a></li>
			<?php endforeach ?>
		</ul>
	</nav>

	<?php Theme::plugins('siteSidebar') ?>

	<!-- Copyright -->
	<ul id="copyright">
		<li><?php echo $site->footer() ?></li>
		<li>Powered by <a href="https://www.bludit.com">BLUDIT</a></li>
	</ul>

</div>