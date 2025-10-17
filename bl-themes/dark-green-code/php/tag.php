<?php  defined('BLUDIT') or die('Bludit CMS');

		 $str='';		
		if( !empty($content) ) #$str.=Msg('error no content', 'none-content-to-appear');             		
		{
				foreach ($content as $page)
				{ 
						
					$p_desc=limitText( $page->description() , 350);
					$data= $p_desc ? '<div class="desc">' . $p_desc . '</div>' : limitText( $page->contentBreak(), 600) ;
					$p_title=$page->title();						
					$p_link=$page->permalink();						
					$p_CImage=$page->coverImage();
					
					$str.='

					<article>
					  <header>
							<h2><a href="'.$p_link.'">'.$p_title.'</a></h2>
			';

							if( $IS_COVER_IMAGE_FALLBACK_SET ) 									
								if(empty( $p_CImage )) $p_CImage=$_DEFAULT_COVER_IMAGE;				
							
							if($p_CImage)
							{
								$str.='
							<figure class="cover">
								<img src="'.$p_CImage.'" alt="Cover image for [ '. $p_title .' ]">
							</figure>
			';
							} 
							
							$btnReadMore= $page->readMore() ? '<span class="readmore"><a href="'.$p_link.'">'.$L->get('Read more').'</a></span>' : '';
							
					$str.='

					  </header>					
						 <div>'.$data.'
								   
								  
								  '. $btnReadMore.'
						 </div> 
					  <footer>
						<p><small>'.($page->dateModified()? $page->dateModified(): $page->date() ) .' | '.getNickName( $page->username() ). ' | ' . $page->readingTime() .'</small></p>
					  </footer>
					</article>			
			';					
					
				}
				
				if( strlen($str)>0 )
				{
					echo Msg('tag-result-text', '','msginfo')	;
				}
				
				echo $str.$nl.Paginator();
				
			}
			else
				echo Msg('tag-result-text', 'none-content-to-appear','msginfo')	;

?>
