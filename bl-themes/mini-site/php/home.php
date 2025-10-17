<?php  
		 $str='';
		
		#https://github.com/bludit/bludit/blob/master/bl-kernel/pages.class.php
		#https://docs.bludit.com/en/dev-snippets/content-pages
		
		$pageNumber = 1;    
		$numberOfItems = $NUMBER_STICKY_PAGES_HOME_PAGE;
		$onlyPublished = false;
		$sticky = true;
		$static = false;
	
		// Get the list of keys sticky pages
		$items = $pages->getList($pageNumber, $numberOfItems, $onlyPublished, $static , $sticky );

		if( !isset($_GET['page']) )
		{
				$str.='
				<section class="featured-content">
				<h2>'.$L->get('featured content header').'</h2>
';			
			$p_link=null;
			foreach ($items as $key) 
			{
				$page = buildPage($key);
				$p_desc= limitText( $page->description() , 350);
				$p_title=$page->title();
				$p_link=$page->permalink();
				
				if(!$p_desc) $p_desc='<strong class="no-set-desc">'.$L->get('no description set in this article').'</strong>';
				
				$str.='
					<p><a href="'.$p_link.'">'.$p_title.'</a> - <span>'.$p_desc.'</span></p>
	';
			}
				$str.='			
				</section>			
';				
			if($p_link==null) $str='';
		
		}
		
		if( !empty($content) ) #$str.=Msg('error no content', 'none-content-to-appear');             		
		{
				foreach ($content as $page)
				{
					if( $page->type() !='sticky' ) 
					{
						$p_desc=limitText( $page->description() , 350);
						$p_title=$page->title();
						$p_link=$page->permalink();
						$p_CImage=$page->coverImage();
						
						$str.='

						<article>
						  <header>
								<h2><a href="'.$p_link.'">'.$p_title.'</a></h2>
				';

								if($IS_DESC_BEFORE_COVER_IMAGE and $p_desc and !$IS_DESC_AFTER_COVER_IMAGE)
									$str.='					<p>'. $p_desc .'</p>
				';					
				
								if( $IS_COVER_IMAGE_FALLBACK_SET ) 									
									if(empty( $p_CImage )) $p_CImage=$_DEFAULT_COVER_IMAGE;				
								
								if($p_CImage)
								{
									$str.='
								<figure>
									<img src="'.$p_CImage.'" alt="Cover image for [ '. $p_title .' ]" class="cover">
				';						
								if($IS_DESC_AFTER_COVER_IMAGE  and $p_desc and !$IS_DESC_BEFORE_COVER_IMAGE)
									$str.='					<figcaption><p>'.$p_desc.'</p></figcaption>
				';					
									$str.='
								</figure>
				';
								}
								
								$btnReadMore= $page->readMore() ? '<span class="readmore"><a href="'.$p_link.'">'.$L->get('Read more').'</a></span>' : '';
								
						$str.='

						  </header>					
							 <div>'.$p_desc.'
									  '. $page->contentBreak() .' 
									  
									  '. $btnReadMore.'
							 </div> 
						  <footer>
							<p><small>'.$page->date() .' | '.getNickName( $page->username() ). ' | ' . $page->readingTime() .'</small></p>
						  </footer>
						</article>			
				';				
					}
				}
				
				echo $str.$nl.Paginator();
			}
			else echo Msg('error-no-content','none-content-to-appear');			
?>
