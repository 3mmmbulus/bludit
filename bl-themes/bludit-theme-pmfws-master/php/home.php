<?php foreach ($content as $page): ?>
<!-- A single blog post -->
<article>
  <?php Theme::plugins('pageBegin'); // Load Bludit Plugins: Page Begin ?>

  <h2>
    <a href="<?php echo $page->permalink(); ?>"><?php echo $page->title(); ?></a> <br/>
  </h2>
  <small><?php echo $page->date(); ?> &ndash; <?php echo $L->get('Reading time') . ': ' . $page->readingTime(); ?></small>
  <!-- Breaked content -->
  <?php echo $page->contentBreak(); ?>

  <?php if ($page->readMore()): // Read more" button ?>
  <a href="<?php echo $page->permalink(); ?>"><?php echo $L->get('Read more'); ?></a>
  <?php endif ?>

  <?php Theme::plugins('pageEnd'); // Load Bludit Plugins: Page End ?>
</article>
<hr />
<?php endforeach; ?>
