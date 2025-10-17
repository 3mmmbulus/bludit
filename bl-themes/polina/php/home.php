<header class="p-3">
	<div class="container text-center">

		<!-- Site logo -->
		<div class="site-logo">
			<img class="logo-img mx-auto d-block"  src="<?php echo ($site->logo() ? $site->logo() : HTML_PATH_THEME_IMG . 'profile.png') ?>" alt="">
			<h1 class="text-intro"><?php echo $site->title() ?></h1>
			<h2 class="slogan"><?php echo $site->slogan(); ?></h2>
		</div>
		<!-- End Site logo -->

	</div>
</header>

<!-- Print all the content -->
<div style="background-color:#F8F9FA; padding: 100px;">
			<p class="text-center text-muted latest-posts">Latest From The Blog</p>
			<?php foreach ($content as $page): ?>
			<!-- Post -->
			<div class="col-lg-8 mx-auto my-5 border-0">

				<!-- Load Bludit Plugins: Page Begin -->
				<?php execPluginsByHook('pageBegin'); ?>

				<div class=" p-0 text-center">
					<!-- Title -->
					<a class="text-dark" href="<?php echo $page->permalink(); ?>">
						<h2 class="entry-title"><?php echo $page->title(); ?></h2>
					</a>

					<!-- Creation date -->
					<span class=" mb-4 text-muted date-time">
						<i class="bi bi-calendar"></i><?php echo $page->date(); ?>
						<i class="ms-3 bi bi-clock-history"></i><?php echo $L->get('Reading time') . ': ' . $page->readingTime(); ?>
					</span>

				</div>

				<!-- Load Bludit Plugins: Page End -->
				<?php execPluginsByHook('pageEnd'); ?>

			</div>
			<hr>
			<?php endforeach ?>
<!-- Pagination -->
<?php if (Paginator::numberOfPages()>1): ?>

<nav class="navigation pagination" role="navigation" aria-label="Page navigation">
	<div class="nav-links">

		<?php if (Paginator::showPrev()):?>
		<a class="prev page-numbers" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1">
			<?php echo $L->get('Previous'); ?>
		</a>
		<?php endif ?>

		<?php
							//max 9 pages with move
							$pmax = max(Paginator::currentPage() + 4, 9);
							$pmin = min(Paginator::currentPage() - 4, Paginator::numberOfPages()-8);
						?>
		<?php for ($i = max(1, $pmin); $i <= min($pmax,Paginator::numberOfPages()); $i++): ?>
		<?php if(Paginator::currentPage() == $i): ?>
		<span class="page-numbers current">
			<?php echo $i ?>
		</span>
		<?php else: ?>
		<a class="page-numbers" href="<?php echo Paginator::numberUrl($i) ?>">
			<?php echo $i ?>
		</a>
		<?php endif; ?>
		<?php endfor; ?>

		<?php if (Paginator::showNext()):?>
		<a class="next page-numbers" href="<?php echo Paginator::nextPageUrl() ?>">
			<?php echo $L->get('Next'); ?>
		</a>
		<?php endif ?>

	</div>
</nav>
<?php endif ?>
</div>
