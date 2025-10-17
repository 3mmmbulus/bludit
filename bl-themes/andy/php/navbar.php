<nav id="site-navigation" class="main-navigation" itemtype="https://schema.org/SiteNavigationElement" itemscope>
  <div class="inside-navigation grid-container grid-parent">

    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
      <span class="mobile-menu"><?php echo $L->get('Menu') ?></span>
    </button>

    <div id="primary-menu" class="main-nav menu-wrapper">
        

          <ul class="menu sf-menu">
          <!-- Static pages -->
          <?php
            $current_page = $_SERVER['REQUEST_URI'];
            foreach ($staticContent as $staticPage) : ?>

            <li <?php if ($current_page == '/' . $staticPage->slug()) echo 'class="current-menu-item"'; ?>>
              <a href="<?php echo $staticPage->permalink(); ?>"><?php echo $staticPage->title(); ?></a>
            </li>

          <?php endforeach ?>
        </ul>


        <!-- Social Networks -->
        <ul class="menu sf-menu social">
          <?php foreach (Theme::socialNetworks() as $key => $label) : ?>
            <li>
              <a class="social-link" href="<?php echo $site->{$key}(); ?>" target="_blank">
                <img class="social-img" src="<?php echo DOMAIN_THEME . 'img/' . $key . '.svg' ?>" alt="<?php echo $label ?>" />
                <span class="social-title"><?php echo $label; ?></span>
              </a>
            </li>
          <?php endforeach; ?>
          </ul>
      
    </div>
  </div>
</nav>