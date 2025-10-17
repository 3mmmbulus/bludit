
<p style="float: right;">
  <a href="https://www.uberspace.de" target="_blank">hosted on asteroids</a>
  &ndash;
  <a href="http://www.adfreeblog.org" target="_blank">ad free blog</a>
  &ndash;
  <a href="http://www.bludit.com" target="_blank">made with bludit</a>
  &ndash;
  <a href="https://paypal.me/cblte" target="_blank">say thanks</a>
  &ndash;
<?php
    // Class name of the plugin
    $className = 'pluginRSS';

    if (pluginActivated($className)) {
        echo '<a href="'. DOMAIN .'/rss.xml" target="_blank">rss</a> &ndash;';
    }
?>
  <a href="/impressum" target="_blank">impressum</a>
</p>

<!-- Pagination -->
<?php if (($url->whereAmI() == 'home') && Paginator::numberOfPages() > 1): ?>
<nav style="float:left;">
    <!-- Previous button -->
    <?php if (Paginator::showPrev()): ?>
      <a href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1"><?php echo $Language->get('Previous'); ?></a>
    <?php endif; // Paginator::showPrev() ?>

    <?php if (Paginator::showPrev() && Paginator::showNext()): ?>
      &mdash;
    <?php endif; // Paginator::showPrev() ?>

    <!-- Next button -->
    <?php if (Paginator::showNext()): ?>
      <a href="<?php echo Paginator::nextPageUrl() ?>" tabindex="-1"><?php echo $Language->get('Next'); ?></a>
    <?php endif; // Paginator::showPrev() ?>
</nav>
<?php endif ?>
