<footer class="site-footer text-center">
    <!-- Social Networks -->
    <div class="copyright">
        <?php foreach (Theme::socialNetworks() as $key=>$label): ?>
            <a href="<?php echo $site->{$key}(); ?>" target="_blank"><?php echo $label ?>
        </a>
        <?php endforeach; ?>
    </div>
    <div class="copyright">
        <?php echo $site->footer(); ?>
        Powered by <a target="_blank" class="" href="https://www.bludit.com">Bludit</a>
    </div>
</footer>