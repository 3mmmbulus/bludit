<?php #authors - some functionality in init.php	
if (empty($content)){ ?>
	<div class="mt-4">
	<?php $language->p('No pages found') ?>
	</div>
<?php }
else {
$author = getNickName(strip_tags(filter_var(ucfirst($_URICHECK[1])))); ?>		
 <h2 class="lpagesbyadm"><?php echo $L->get('list-pages-written-by').' '. ucfirst($author); ?></h2>

<?php } foreach ($content as $page): ?>
<div class="card my-5 border-0 articles">
	
	<?php Theme::plugins('pageBegin'); ?>

	<div class="row">
		<div class="col">
			<img src="<?php echo fsGetImageURL($_DEFAULT_THUMB_IMAGE); ?>" alt="Cover Image" class="card-img-top mb-3 rounded-0" />
		</div>
		
		<div class="col">
			<div class="card-body p-0">

				<a class="text-dark artlink" href="<?php echo $page->permalink(); ?>"><h2 class="title"><?php echo $page->title(); ?></h2></a>
																									
				<p class="card-subtitle mb-3 text-muted rtime"><time datetime="<?php echo $page->dateRaw('c') ?>"><?php echo $page->date().'</time> - '. $L->get('Reading time') . ': ' . $page->readingTime(); ?> </p>

				<div class="contbreak">
					<?php echo limitText($page->contentBreak(),$_LIMIT_TEXT_ON_HOME); ?>
				</div>

				<?php if ($page->readMore()): ?>
				<a class="readmore" href="<?php echo $page->permalink(); ?>"><?php echo $L->get('Read more'); ?></a>
				<?php endif ?>

			</div>		
		</div>
	</div>
 
	<?php Theme::plugins('pageEnd'); ?>
	<hr>
</div>
<?php endforeach ;
echo '<br><br>';
# echo Paginator();	 TODO in future
?>