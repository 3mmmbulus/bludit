<nav class="navbar navbar-expand-lg navbar-light" id="mainNav"> <!-- add fixed-top to the style for fun-->
    <div class="container">
        <a class="navbar-brand" href="<?php echo $site->url() ?>"><?php echo $site->title() ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <?php echo $language->get('Menu') ?><i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $site->url() ?>"><?php echo $language->get('Home') ?></a>
                </li>
                <?php
    foreach ($staticContent as $staticPage) {
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="'.$staticPage->permalink().'">'.$staticPage->title().'</a>';
        echo '</li>';
    }
                ?>
            </ul>
        </div>
    </div>
</nav>