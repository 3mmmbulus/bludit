<footer class="footer bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white text-uppercase"><?php echo $site->footer(); ?><?php if($site->primaryKeyword()): ?> | 专业<?php echo $site->primaryKeyword(); ?>提供商<?php endif; ?><span class="ml-5 text-warning"><img class="mini-logo" src="<?php echo DOMAIN_THEME_IMG.'favicon.png'; ?>"/> 由 <a target="_blank" class="text-white" href="https://www.maigewan.com">Maigewan</a> 驱动</span></p>
    </div>
</footer>
