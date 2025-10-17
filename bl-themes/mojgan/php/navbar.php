<nav class="navbar navbar-expand-md  text-uppercase">
    <div class="container">
        <a class="navbar-brand" href="<?php echo Theme::siteUrl(); ?>">
            <img src=" <?php echo $site->logo() ?>" alt="" class="logo-img">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <ul class="navbar-nav ml-auto">

                <!-- Static pages -->
                <?php foreach ($staticContent as $staticPage): ?>
                <li class="nav-item">
                    <a class="nav-link"
                        href="<?php echo $staticPage->permalink(); ?>"><?php echo $staticPage->title(); ?></a>
                </li>
                <?php endforeach ?>


            </ul>

        </div>
    </div>
</nav>