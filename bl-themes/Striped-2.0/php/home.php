<!-- Content -->
<div id="content">
	<div class="inner">

		<?php if (empty($content)): ?>
			<?php echo '<h3>'.$language->g('No pages found').'</h3>' ?>
		<?php endif ?>

		<!-- Posts -->
		<?php foreach ($content as $page): ?>
			<article id="<?php echo $page->slug() ?>" class="box post post-excerpt">
				<header>
					<h2><a href="<?php echo $page->permalink() ?>"><?php echo $page->title() ?></a></h2>
					<?php if ($page->description()): ?>
						<p><?php echo $page->description() ?></p>
					<?php endif ?>
				</header>
				<div class="info">
					<span class="date"><span class="month"><?php echo $page->date('M') ?><span></span></span> <span class="day"><?php echo $page->date('d') ?></span><span class="year">, <?php echo $page->date('Y') ?></span></span>
				</div>
				<?php if ($page->coverImage()): ?>
					<a href="<?php echo $page->permalink() ?>" class="image featured"><img src="<?php echo $page->coverImage() ?>" alt="<?php echo $page->title() ?>" /></a>
				<?php endif ?>
				<?php echo $page->contentBreak() ?>
			</article>
		<?php endforeach ?>

		<!-- Pagination -->
		<?php if (Paginator::numberOfPages()>1): ?>
			<div class="pagination">
				<?php if (Paginator::showPrev()): ?>
					<a href="<?php echo Paginator::previousPageUrl() ?>" class="button previous">&#9664; <?php echo $L->get('Previous') ?></a>
				<?php endif ?>

				<?php if (Paginator::currentPage() > 1): ?>
					<a href="<?php echo Theme::siteUrl() ?>" class="button"><?php echo $L->get('Home') ?></a>
				<?php endif ?>

				<?php if (Paginator::showNext()): ?>
					<a href="<?php echo Paginator::nextPageUrl() ?>" class="button next"><?php echo $L->get('Next') ?> &#9658;</a>
				<?php endif ?>
			</div>
		<?php endif ?>

	</div>
</div>
