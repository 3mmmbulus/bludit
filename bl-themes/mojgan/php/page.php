<section class="page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="content-card">

                    <!-- Load Bludit Plugins: Page Begin -->
                    <?php Theme::plugins('pageBegin'); ?>

                    <!-- Page cover image -->
                    <?php if ($page->coverImage()): ?>
                    <div class="page-cover-image mb-4"
                        style="background-image: url('<?php echo $page->coverImage(); ?>');">
                        <div style="height: 400px;"></div>
                    </div>
                    <?php endif ?>

                    <!-- Page title -->
                    <h1 class="title text-center"><?php echo $page->title(); ?></h1>

                    <!-- Creation date -->
                    <h6 class="my-4 text-date text-center">

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

                    <!-- Page description -->
                    <?php if ($page->description()): ?>
                    <p class="page-description"><?php echo $page->description(); ?></p>
                    <?php endif ?>


                    <!-- Page content -->
                    <div class="page-content">
                        <?php echo $page->content(); ?>
                    </div>

                    <!-- Back to top button -->
                    <a id="gtu_button">
                        <i class="fa fa-chevron-up" aria-hidden="true"></i>
                    </a>
                </div>


                <!-- Load Bludit Plugins: Page End -->
                <?php Theme::plugins('pageEnd'); ?>
            </div>
        </div>
    </div>

</section>