<footer>
	<ul class="social">
		<?php if (Theme::socialNetworks()): ?>
			<!-- Social Networks -->
			<?php foreach (Theme::socialNetworks() as $key => $label) : ?>
				<li class="social-<?php echo $key ?>">
					<a href="<?php echo $site->{$key}(); ?>" target="_blank" title="<?php echo $label; ?>">				
						<span class="sr-only"><?php echo $label; ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>		
		<?php if (Theme::rssUrl()): ?>
			<!-- RSS -->
            <li class="social-rss">
                <a href="<?php echo Theme::rssUrl() ?>" title="RSS">
					<span class="sr-only">RSS</span>
                </a>
            </li>
        <?php endif; ?>
	</ul>	
	<p><?php echo $site->footer(); ?></p>
</footer>