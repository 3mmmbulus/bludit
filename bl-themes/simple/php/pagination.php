<?php if (Paginator::numberOfPages() > 1) : ?>
  <?php 
  $currentPage = Paginator::currentPage(); 
  $total_pages = Paginator::numberOfPages();
  $howMany = 2;  
  ?>

  <nav aria-label="pagination">
      <!-- Previous button -->
      <?php if (Paginator::showPrev()) : ?>
        <a class="button" href="<?php echo Paginator::previousPageUrl() ?>" tabindex="-1">&#8592; <?php echo $L->get('Previous'); ?></a>
      <?php endif; ?>      

      <a class="<?php echo $currentPage == 1 ? "active" : false; ?>" href="<?php echo Paginator::firstPageUrl() ?>">1</a>

      <?php if ($currentPage - 1 > $howMany){ ?>
        <span role="img" aria-label="...">&hellip;</span>
      <?php } ?>

      <?php if ($currentPage > $howMany && $currentPage <= $total_pages) { ?>
        <a href="<?php echo Paginator::numberUrl($currentPage - 1) ?>"><?php echo $currentPage - 1 ?></a>
      <?php } ?>

      <?php if ($currentPage > 1 && $currentPage < $total_pages) { ?>
        <a class ="active" href="<?php echo Paginator::numberUrl($currentPage) ?>"><?php echo $currentPage ?></a>
      <?php } ?>

      <?php if ($currentPage < $total_pages - 1) { ?>
        <a href="<?php echo Paginator::numberUrl($currentPage + 1) ?>"><?php echo $currentPage + 1 ?></a>
      <?php } ?>

      <?php if ($currentPage + 1 < $total_pages - 1){ ?>
        <span role="img" aria-label="...">&hellip;</span>
      <?php } ?>

      <?php if ($currentPage <= $total_pages) { ?>
        <a href="<?php echo Paginator::lastPageUrl() ?>" class="page <?php echo $currentPage == $total_pages ? "active" : false; ?>"><?php echo $total_pages ?></a>
      <?php } ?>

      <!-- Next button -->
      <?php if (Paginator::showNext()) : ?>
        <a class="button" href="<?php echo Paginator::nextPageUrl() ?>"><?php echo $L->get('Next'); ?> &#8594;</a>
	    <?php endif; ?>
  </nav>
<?php endif ?>