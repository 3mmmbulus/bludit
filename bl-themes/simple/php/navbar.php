<nav>
	<ul>
		<?php foreach ($staticContent as $staticPage) : ?>	
		<li><a href="<?php echo $staticPage->permalink(); ?>" class="<?php if($page) { echo $staticPage->permalink() == $page->permalink() ? 'current' : false; }?>" title="<?php echo $staticPage->title(); ?>"><?php echo $staticPage->title() ?></a></li>	
		<?php endforeach ?>
	</ul>
</nav>