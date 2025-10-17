<!-- Load Bludit Plugins: Page Begin -->
<?php Theme::plugins('pageBegin'); ?>

<?php if ($page->coverImage()): ?>
<!-- Cover image -->
<img alt="Cover Image" src="<?php echo $page->coverImage(); ?>" class="cover-image">
<?php endif ?>

<!-- Title -->
<h2><?php echo $page->title(); ?></h2>
	
<?php if (!$page->isStatic() && !$url->notFound()): ?>
<!-- Page metadata -->
<p class="meta">
    <?php include(THEME_DIR_IMG . 'icons/calendar.svg'); ?> <time datetime="<?php echo $page->dateRaw(); ?>"><?php echo $page->date(); ?></time>
    <?php include(THEME_DIR_IMG . 'icons/user.svg'); ?> <?php echo $page->username(); ?>
    <?php if ($page->category()): ?>
        <?php $category = new Category($page->categoryKey()); ?>
        <?php include(THEME_DIR_IMG . 'icons/category.svg'); ?> <a href="<?php echo $category->permalink(); ?>" title="<?php echo $page->category(); ?>"><?php echo $page->category(); ?></a>
    <?php endif ?>
    <?php include(THEME_DIR_IMG . 'icons/clock.svg'); ?> <?php echo $page->readingTime(); ?>
</p>
<?php endif ?>

<!-- Full content -->
<?php echo $page->content(); ?>

<?php if ($page->tags()): ?>
<!-- Page tags -->
<hr>
<p class="meta">
    <?php include(THEME_DIR_IMG . 'icons/tag.svg'); ?>
    <?php $returnsArray = true;
          $items = $page->tags($returnsArray);
          foreach ($items as $tagKey=>$tagName) {
            $tag = new Tag($tagKey);
            echo '<a href="' . $tag->permalink() . '" class="button meta-tag">' . $tag->name() . '</a>';
          }
    ?>
</p>
<?php endif ?>

<!-- Load Bludit Plugins: Page End -->
<?php Theme::plugins('pageEnd'); ?>