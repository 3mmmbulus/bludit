<nav class="navbar navbar-expand-md <?php if($IS_MENU_TOP_FIXED) echo 'fixed-top '; else echo 'nofixed '?>text-uppercase" id="navprin">
	<div class="container">
	<h1>
		<a class="navbar-brand" href="<?php echo Theme::siteUrl() ?>">
			<span class="stitle"><?php echo $site->title() ?></span>
		</a>
	</h1>	
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">

				<?php foreach ($staticContent as $staticPage): ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $staticPage->permalink() ?>"><?php echo $staticPage->title() ?></a>
				</li>
				<?php endforeach ?>

				<li class="dropdown">
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Social</span> <span class="caret"></span></a>
					 
					  <ul class="dropdown-menu">
						<?php foreach (Theme::socialNetworks() as $key=>$label): ?>
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $site->{$key}(); ?>" target="_blank">
								<img class="d-none d-sm-block nav-svg-icon" src="<?php echo DOMAIN_THEME.'img/'.$key.'.svg' ?>" alt="<?php echo $label ?>" />
								<span class="d-inline d-sm-none"><?php echo $label; ?></span>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
				</li>
				
			</ul>
		</div>		
	</div>		
</nav>
