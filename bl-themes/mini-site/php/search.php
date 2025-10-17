<?php  
		 $str='';		
		if( !empty($content) ) #$str.=Msg('error no content', 'none-content-to-appear');             		
		{
				foreach ($content as $page)
				{
						$p_desc=$page->description();
						$p_title=$page->title();
						$p_link=$page->permalink();
						$p_CImage=$page->coverImage();
						
						$str.='

						<article>
						  <header>
								<h2><a href="'.$p_link.'">'.$p_title.'</a></h2>
				';

								if($IS_DESC_BEFORE_COVER_IMAGE and $p_desc and !$IS_DESC_AFTER_COVER_IMAGE)
									$str.='					<p>'.limitText( $p_desc , 350).'</p>
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
									$str.='					<figcaption><p>'.limitText( $p_desc , 350).'</p></figcaption>
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
				
				echo $str.$nl.Paginator();
			}
			else echo Msg('search-result-text','none-search-result');
			
?>
