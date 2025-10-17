<!-- Welcome message -->
<header class="site-header text-center">
    <div class="text-center">
		<!-- Site title -->
        <h1 class="page-title blog-title">
            <a href="<?php echo Theme::siteUrl(); ?>"><?php echo $site->slogan(); ?></a>
        </h1>

		<!-- Site description -->
		<?php if ($site->description()): ?>
		<div class="blog-description faded"><?php echo $site->description(); ?></div>
		<?php endif ?>

		<!-- Custom search form if the plugin "search" is enabled -->
		<?php if (pluginActivated('pluginSearch')): ?>
		<div class="form-inline d-block">
			<input id="search-input" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-primary my-2 my-sm-0" type="button" onClick="searchNow()">Search</button>
			<script>
				function searchNow() {
					var searchURL = "<?php echo Theme::siteUrl(); ?>search/";
					window.open(searchURL + document.getElementById("search-input").value, "_self");
				}
			</script>
		</div>
		<?php endif ?>

        <!-- Static pages -->
        <nav class="main-nav">
            <?php foreach ($staticContent as $staticPage): ?>
            <a class="" href="<?php echo $staticPage->permalink(); ?>">
                <?php echo $staticPage->title(); ?>
            </a>
            <?php endforeach ?>
        </nav>

    </div>
</header>


