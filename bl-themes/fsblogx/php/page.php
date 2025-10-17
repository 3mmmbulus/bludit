<div class="card my-5 border-0 page<?php if($page->isStatic()) echo ' static';?>">

	<?php Theme::plugins('pageBegin'); ?>
	
	<a href="<?php echo $page->permalink(); ?>"><h2 class="title"><?php echo $page->title(); ?></h2></a>
	<?php 
	
		if(!$page->isStatic() && !$url->notFound())
		{
			echo '<p class="card-subtitle mb-3 text-muted rtime">'. $page->date().' - '. $L->get('Reading time') . ': ' . $page->readingTime() . '</p>';
			
			if($_ENABLE_DESCRIPTION_ON_PAGE) if($page->description()) echo '<p class="description">'.$page->description().'</p>';
			
			if($_ENABLE_DEFAULT_COVER_IMAGE)
			{	
				if(!$page->coverImage()) 
				{					
					if($_ENABLE_COVER_IMAGE_ON_PAGE_WHEN_NOT_EXIST)
						echo '<img src="'.fsGetImageURL($_DEFAULT_COVER_IMAGE).'" alt="Cover Image" class="card-img-top mb-3 rounded-0 cover" />'; 	
				}
				else 
					echo '<img src="'.fsGetImageURL($_DEFAULT_COVER_IMAGE).'" alt="Cover Image" class="card-img-top mb-3 rounded-0 cover" />'; 	
			}
		}
	?>
	
	<div class="card-body p-0">				
		<div class="pcontent">					
			<?php echo $page->content(); ?>
		</div>

	</div>

	<?php Theme::plugins('pageEnd'); ?>

</div>
