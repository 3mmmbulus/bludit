<!-- Content -->
<div id="content">
	<div class="inner">
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
			<?php echo $page->content() ?>
		</article>
	</div>
</div>
