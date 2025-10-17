<?php if (empty($content)) : ?>
  <div class="mt-4">
    <?php $language->p('No pages found') ?>
  </div>
<?php endif ?>

<?php foreach ($content as $page) : ?>
  <div class="card my-5 border-0">

    <?php Theme::plugins('pageBegin'); ?>

    <?php if ($page->coverImage()) : ?>
      <img class="card-img-top mb-3 rounded-0" alt="Cover Image" src="<?php echo $page->coverImage(); ?>" />
    <?php endif ?>

    <div class="card-body p-0">
      <a class="text-dark" href="<?php echo $page->permalink(); ?>">
        <h2 class="title"><?php echo $page->title(); ?></h2>
      </a>

      <h6 class="card-subtitle mt-1 mb-4 text-muted">
        <i class="bi bi-calendar"></i><?php echo $page->date(); ?>
        <i class="ml-3 bi bi-clock-history"></i><?php echo $L->get('Reading time') . ': ' . $page->readingTime(); ?>
      </h6>

      <?php echo $page->contentBreak(); ?>

      <?php if ($page->readMore()) : ?>
        <a href="<?php echo $page->permalink(); ?>"><?php echo $L->get('Read more'); ?></a>
      <?php endif ?>

    </div>

    <?php Theme::plugins('pageEnd'); ?>

  </div>
  <hr>
<?php endforeach ?>

<?php if (Paginator::numberOfPages() > 1) : ?>
  <nav class="paginator">
    <ul class="pagination flex-wrap">

      <?php if (Paginator::showPrev()) : ?>
        <li class="page-item mr-2">
          <a class="page-link" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1">&#9664; <?php echo $L->get('Previous'); ?></a>
        </li>
      <?php endif; ?>

      <li class="page-item <?php if (Paginator::currentPage() == 1) echo 'disabled' ?>">
        <a class="page-link" href="<?php echo Theme::siteUrl() ?>">Home</a>
      </li>

      <?php if (Paginator::showNext()) : ?>
        <li class="page-item ml-2">
          <a class="page-link" href="<?php echo Paginator::nextPageUrl() ?>"><?php echo $L->get('Next'); ?> &#9658;</a>
        </li>
      <?php endif; ?>

    </ul>
  </nav>
<?php endif ?>
