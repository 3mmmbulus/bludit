<?php if (empty($content)): ?>
<div>
    <?php $language->p('No pages found') ?>
</div>
<?php endif ?>

<!-- Print all the content -->
<main class="content inner cf" role="main">
    
<?php foreach ($content as $page): ?>
    <article class="post post-excerpt">
        <!-- Load Bludit Plugins: Page Begin -->
        <?php Theme::plugins('pageBegin'); ?>
        
        <!-- Page title -->
        <h2 class="post-title">
            <a class="" href="<?php echo $page->permalink(); ?>"><?php echo $page->title(); ?></a>
        </h2>        
        
        <!-- Page content until the pagebreak -->
        <div><?php echo $page->contentBreak(); ?></div>

        <!-- Shows "read more" button if necessary -->
        <?php if ($page->readMore()): ?>
        <div class="text-left">
            <a class="" href="<?php echo $page->permalink(); ?>" ><?php echo $L->get('Read more'); ?></a>
        </div>
        <?php endif ?>

        <!-- Load Bludit Plugins: Page End -->
        <?php Theme::plugins('pageEnd'); ?>
    </article>
<?php endforeach ?>

<!-- Pagination -->
<?php if (Paginator::numberOfPages()>1): ?>
<nav class="pagination" role="navigation">
    <span class="text-left <?php if (!Paginator::showPrev()) echo 'hidden' ?>">
        <a class="newer-posts" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1">&#9664; <?php echo $L->get('Previous'); ?></a>
    </span>
    
    <span class="page-number faded">
        Page <?php echo $currentPage?> of <?php echo $numberOfPages ?>  
    </span>
    
    <span class="text-right <?php if (!Paginator::showNext()) echo 'hidden' ?>">
        <a class="older-posts" href="<?php echo Paginator::nextPageUrl() ?>"><?php echo $L->get('Next'); ?> &#9658;</a>
    </span>
</nav>
<?php endif ?>

</main>