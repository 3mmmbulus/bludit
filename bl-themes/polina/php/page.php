<div class="row">
<!-- Cover image -->
	<?php if ($page->coverImage()): ?>
	<figure class="textcenter">
		<img class="cover-image" src="<?php echo $page->coverImage(); ?>"/>
	<?php endif ?>

	<!-- Page title -->
		<figcaption>
			<h1 class="entry-title text-center" style="padding-top:2rem"><?php echo $page->title(); ?></h1>
		</figcaption>
	</figure>
</div>



<section class="">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<!-- Load Bludit Plugins: Page Begin -->
				<?php execPluginsByHook('pageBegin'); ?>

				<!-- Page content -->
				<div class="page-content">
				<?php echo $page->content(); ?>
				</div>

				<div>
					<?php if (!empty($page->tags(true))): ?>
					<?php foreach ($page->tags(true) as $tagKey=>$tagName): ?>
							<a class="btn btn-violet btn-sm" href="<?php echo DOMAIN_TAGS.$tagKey ?>" role="button"><span class="text-white">&#10084;</span> <?php echo $tagName; ?></a>
					<?php endforeach ?>
					<?php endif; ?>
				</div>


				<hr style="margin-top:50px;margin-bottom:50px">
				<div class="text-center">
					<div class="form-text mb-2">
						<!-- Page creation time -->
						<span class="pe-3"><i class="bi bi-calendar"></i><?php echo $page->date() ?></span>

						<!-- Page author -->
						<span><i class="bi bi-person"></i><?php echo $page->user('nickname') ?>

						</span>
					</div>
				</div>


				<!-- Load Bludit Plugins: Page End -->
				<?php execPluginsByHook('pageEnd'); ?>
			</div>
		</div>
	</div>
</section>

<!-- Related pages -->
<?php
	$relatedPages = $page->related(true, 3);
?>
<?php if (!empty($relatedPages)): ?>
<section class="related mt-4 mb-4">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto p-4 bg-light">
				<h4><?php $L->p('Related pages') ?></h4>
				<div class="list-group list-group-flush">
					<?php foreach ($relatedPages as $pageKey) : ?>
						<?php $tmp = new Page($pageKey); ?>
						<div class="list-group-item pt-4 pb-4" aria-current="true">
							<div class="d-flex w-100 justify-content-between">

								<!-- Related page title -->
								<a href="<?php echo $tmp->url() ?>">
									<h5 class="mb-1 entry-title"><?php echo $tmp->title() ?></h5>
								</a>

								<!-- Related page date -->
								<small class="color-violet"><?php echo $tmp->relativeTime() ?></small>
							</div>

							<!-- Related page description -->
							<?php if ($tmp->description()): ?>
							<p class="mb-1 form-text"><?php echo $tmp->description(); ?></p>
							<?php endif ?>

						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
