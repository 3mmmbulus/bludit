
<!-- A single blog post -->
<article>
  <!-- Load Bludit Plugins: Page Begin -->
  <?php Theme::plugins('pageBegin'); ?>

  <a href="<?php echo $page->permalink(); ?>">
    <h2><?php echo $page->title(); ?></h2>
  </a>

  <?php if (!$page->isStatic() && !$url->notFound()):  ?>
  <small><?php echo $page->date(); ?> - <?php echo $L->get('Reading time') . ': ' . $page->readingTime() ?></small>
  <?php endif ?>

  <!-- Full content -->
  <?php echo $page->content(); ?>


  <!-- Load Bludit Plugins: Page End -->
  <?php Theme::plugins('pageEnd'); ?>
</article>

<hr />
