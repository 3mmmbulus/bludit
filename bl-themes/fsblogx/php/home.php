<?php if (empty($content)){ ?>
	<div class="mt-4 notfound">	
	<?php $language->p('No pages found') ?>
	</div>
<?php } else { 

if($WHERE_AM_I=='category')
	echo '<h2 class="lpagesbycat">'. $L->get('list-categories-text').' '. GetCategoryInfo().'</h2>';

if($WHERE_AM_I=='search')
	echo '<h2 class="lpagesbysearch">'. $L->get('list-search-text').' "'. GetSearchTerm().'"</h2>';

if($WHERE_AM_I=='tag')
	echo '<h2 class="lpagesbytags">'. $L->get('list-tags-text').' "'. GetTagsInfo().'"</h2>';?>

<?php

foreach($content as $page)
{
	$reffeatured=''; if($page->type()=='sticky' and $WHERE_AM_I=='home') $reffeatured=' featured';
?>

<div class="card my-5 border-0 articles<?php echo $reffeatured;?>">
	
	<?php Theme::plugins('pageBegin'); ?>

	<div class="row">
		<div class="col">
			<img src="<?php echo fsGetImageURL($_DEFAULT_THUMB_IMAGE); ?>" alt="Cover Image" class="card-img-top mb-3 rounded-0" />
		</div>
		
		<div class="col">
			<div class="card-body p-0">

				<a class="text-dark artlink" href="<?php echo $page->permalink(); ?>"><h2 class="title"><?php echo $page->title(); ?></h2></a>
																																										<?php 
																																										$ni='';
																																										if($_ENABLE_AUTHORS_LINK_ON_HOME)
																																										{
																																											$ni = getNickName($page->username());
																																											$ni=' | <a class="authrs" href="/authors/'.strtolower($ni).'">'.ucfirst($ni).'</a>';
																																										}
																																										?>
				<p class="card-subtitle mb-3 text-muted rtime"><time datetime="<?php echo $page->dateRaw('c') ?>"><?php echo $page->date().'</time> | '. $L->get('Reading time') . ': ' . $page->readingTime() .$ni; ?> </p>

				<div class="contbreak">
					<?php if($page->description()) 
							echo limitText($page->description(),$_LIMIT_TEXT_ON_HOME); 
						  else
							echo limitText($page->contentBreak(),$_LIMIT_TEXT_ON_HOME);
					?>
				</div>

				<?php if ($page->readMore()): ?><a class="readmore" href="<?php echo $page->permalink(); ?>"><?php echo $L->get('Read more'); ?></a><?php endif ?>
				
			</div>		
		</div>
	</div>
	
	<?php Theme::plugins('pageEnd'); ?>
	<hr>
</div>
<?php 
}

echo Paginator().'<br><br>';

}
?>		
