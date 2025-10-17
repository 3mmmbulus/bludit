<nav class="pb-4 navbar text-uppercase fixed-top navbar-light bg-light justify-content-center align-items-start">
    <button class="navbar-toggler ml-auto mt-1" type="button" data-toggle="collapse" data-target="#navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand position-absolute mx-0" href="<?php echo Theme::siteUrl() ?>">
    <span class="text-yellow align-middle"><?php echo $site->title() ?></span>
  </a>
    </span>
    <div class="navbar-collapse collapse" id="navbar">
    <ul class="navbar-nav mr-auto text-center mt-4">
    <li class="nav-item">
            <a class="nav-link" href="/about">about</a>
          </li>
      <?php foreach ($categories->db as $key => $fields) :
        if ($fields['list']) :  ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo DOMAIN_CATEGORIES . $key; ?>"><?php echo $fields['name']; ?></a>
          </li>
      <?php
        endif;
      endforeach; ?>
    </ul>
    
    <!-- Search Plugin -->
    <?php if (pluginActivated('pluginSearch')) : ?>
      <div class="d-flex">
        <div class="input-group">
          <input type="search" class="form-control mt-1" id="search-input" placeholder="">
          <div class="input-group-append">
            <button class="btn btn-secondary mt-1" type="submit" onClick="searchNow()">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
        <script>
          function searchNow() {
            var searchURL = "<?php echo Theme::siteUrl(); ?>search/";
            window.open(searchURL + document.getElementById("search-input").value, "_self");
          }
          var elem = document.getElementById('search-input');
          elem.addEventListener('keypress', function(e) {
            if (e.keyCode == 13) {
              searchNow();
            }
          });
        </script>
      </div>
    <?php endif ?>
    </div>
</nav>