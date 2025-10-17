<div id="primary" class="content-area grid-parent mobile-grid-100 grid-75 tablet-grid-75">
  <main id="main" class="site-main">
    <article id="post-1" class="post-1 post type-post status-publish format-standard hentry category-1" itemtype="https://schema.org/CreativeWork" itemscope>
      <div class="inside-article">

        <header class="entry-header">

          <!-- Load Bludit Plugins: Page Begin -->
          <?php Theme::plugins('pageBegin'); ?>
          
          <!-- Cover Image -->
          <?php if ($page->coverImage()) : ?>
            <figure class="cover-image size-large is-resized"><img src="<?php echo $page->coverImage(); ?>" alt="Cover Image" class="wp-image-9" width="100%" height="100%"></figure>
          <?php endif ?>
            
          <h2 class="entry-title" itemprop="headline">
              <a href="<?php echo $page->permalink(); ?>" rel="bookmark"><?php echo $page->title(); ?></a>
          </h2>
            
          <?php if (!$page->isStatic() && !$url->notFound()) : ?>
            <div class="entry-meta">
              <span class="posted-on">
                <time class="entry-date published" itemprop="datePublished">
                <?php echo $page->date(); ?> </time> - <?php echo $L->get('Reading time') . ': ' . $page->readingTime() ?>
              </span>
            </div>
          <?php endif ?>

          <!-- .entry-meta -->
        </header>
        <!-- .entry-header -->


        <div class="entry-summary" itemprop="text">
          <p>
              <!-- Full content -->
              <?php echo $page->content(); ?>
          </p>
        </div>
        <!-- .entry-summary -->

        <?php Theme::plugins('pageEnd'); ?>

        <!-- .entry-meta -->
      </div>
      <!-- .inside-article -->
    </article>
    <!-- #post-## -->
  </main>
  <!-- #main -->
</div>

