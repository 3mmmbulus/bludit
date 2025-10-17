<!-- Post -->
<?php foreach ($content as $page) : ?>
  
  <!-- Load Bludit Plugins: Page Begin -->
  <?php Theme::plugins('pageBegin'); ?>
	
	<article class="blog-item">
		<!-- Cover image -->
		<?php if ($page->coverImage()) : ?>
		  <img alt="Cover Image" src="<?php echo $page->coverImage(); ?>" class="cover-image">
		<?php endif ?>
		
		<!-- Title -->
		<h2 class="post-link">
      <?php if ($page->sticky()) : ?>
        <span class="small" role="img" aria-label="pushpin icon">&#x1F4CC; </span>
      <?php endif ?>
      <a href="<?php echo $page->permalink(); ?>" title="<?php echo $page->title(); ?>"><?php echo $page->title(); ?></a>
    </h2>

		<!-- Creation date -->
    <p class="meta"><?php include(THEME_DIR_IMG . 'icons/calendar.svg'); ?> <time datetime="<?php echo $page->dateRaw(); ?>"><?php echo $page->date(); ?></time></p>
    
		<!-- Breaked content -->
		<?php echo $page->contentBreak(); ?>

		<!-- "Read more" button -->
		<?php if ($page->readMore()) : ?>
		<a class="button" href="<?php echo $page->permalink(); ?>"><?php echo $L->get('Read more'); ?></a>
		<?php endif ?>
  </article>

    <!-- Load Bludit Plugins: Page End -->
    <?php Theme::plugins('pageEnd'); ?>
	
<?php endforeach ?>

<!-- Pagination -->
<?php include(THEME_DIR_PHP.'pagination.php'); ?>