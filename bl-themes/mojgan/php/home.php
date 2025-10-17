<?php if (empty($content)): ?>
<div class="text-center p-4">
    <?php $language->p('No pages found') ?>
</div>
<?php endif ?>

<!-- Print all the content -->
<?php foreach ($content as $page): ?>
<section class="home-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Load Bludit Plugins: Page Begin -->
                <?php Theme::plugins('pageBegin'); ?>

                <div class="content-card">

                    <!-- Page title -->
                    <a href="<?php echo $page->permalink(); ?>">
                        <h2 class="title"><?php echo $page->title(); ?></h2>
                    </a>

                    <!-- Page description -->
                    <?php if ($page->description()): ?>
                    <p class="page-description"><?php echo $page->description(); ?></p>
                    <?php endif ?>

                    <!-- Page content until the pagebreak -->
                    <div>
                        <?php echo $page->contentBreak(); ?>
                    </div>

                    <!-- Creation date -->
                    <h6 class="my-4 text-date">

                        <span class="fa fa-clock clock"> </span><?php echo $page->date(); ?>

                        <!-- Tags  -->
                        <?php if ($page->category()):?>
                        <span class="text-category ml-2">
                            <i class="fa fa-folder-open"></i>
                            <a href="<?php echo DOMAIN_CATEGORIES.$page->categoryKey() ?>" rel="tag">
                                <?php echo $page->category() ?>
                            </a>
                        </span>
                        <?php endif?>
                    </h6>

                    <!-- Shows "read more" button if necessary -->
                    <?php if ($page->readMore()): ?>
                    <div>
                        <a class="read-more" href="<?php echo $page->permalink(); ?>"
                            role="button"><?php echo $L->get('Read more'); ?>
                            <span class="fa  fa-angle-double-right "></span>
                        </a>

                    </div>
                    <?php endif ?>


                </div>
                <!-- Load Bludit Plugins: Page End -->
                <?php Theme::plugins('pageEnd'); ?>
            </div>
        </div>
    </div>
</section>
<?php endforeach ?>

<!-- Back to top button -->
<a id="gtu_button">
    <i class="fa fa-chevron-up" aria-hidden="true"></i>

</a>
<!-- Pagination -->
<?php if (Paginator::numberOfPages()>1): ?>
<nav class="paginator container">
    <div class="col-8 mx-auto">

        <ul class="pagination flex-wrap justify-content-center">

            <!-- Previous button -->
            <?php if (Paginator::showPrev()): ?>
            <li class="mr-auto text-left">
                <a class="pagination-link" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1">
                    <i class="fa fa-angle-double-left"></i>
                    <?php echo $L->get('Newer'); ?>
                </a>
            </li>
            <?php endif; ?>

            <!-- Next button -->
            <?php if (Paginator::showNext()): ?>
            <li class="ml-auto text-right">
                <a class="pagination-link" href="<?php echo Paginator::nextPageUrl() ?>"><?php echo $L->get('Older'); ?>
                    <i class="fa fa-angle-double-right"></i>
                </a>
            </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>


<?php endif ?>