<section class="page">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto">
				<?php Theme::plugins('pageBegin'); ?>

				<h1 class="title"><?php echo $page->title(); ?></h1>

				<?php if (!$page->isStatic() && !$url->notFound() && $themePlugin->showPostInformation()) : ?>
					<div class="form-text mb-2">
						<span class="pr-3"><i class="bi bi-calendar"></i><?php echo $page->date() ?></span>

						<span class="pr-3"><i class="bi bi-clock"></i><?php echo $page->readingTime() . ' ' . $L->get('minutes') . ' ' . $L->g('read') ?></span>

						<span><i class="bi bi-person"></i><?php echo $page->user('nickname') ?></span>
					</div>
				<?php endif ?>

				<?php if ($page->description()) : ?>
					<p class="page-description"><?php echo $page->description(); ?></p>
				<?php endif ?>

				<?php if ($page->coverImage()) : ?>
					<div class="page-cover-image py-6 mb-4" style="background-image: url('<?php echo $page->coverImage(); ?>');">
						<div style="height: 300px;"></div>
					</div>
				<?php endif ?>

				<div class="page-content">
					<?php echo $page->content(); ?>
				</div>

				<?php Theme::plugins('pageEnd'); ?>
			</div>
		</div>
	</div>
</section>
