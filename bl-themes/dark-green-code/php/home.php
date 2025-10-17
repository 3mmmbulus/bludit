<?php  defined('BLUDIT') or die('Bludit CMS');

		if( !empty($content) ) #$str.=Msg('error no content', 'none-content-to-appear');             		
		{
			 $str='';
			 $htmlStick='';
			 $arStickyFeatured=array();
		 
			 $preq=null;
			 if(isset($_GET['page']))
				 $preq=($_GET['page']);			 
			 
				if( $preq==null || $preq==1)
				{
						$htmlStick.='
						<section class="featured-content">
						<h2>'.$L->get('featured content header').'</h2>
		';			

					 foreach ($content as $stkContent)
					{
							if($stkContent->type()=='sticky')
							{
								$arStickyFeatured[]=$stkContent->key();
								
								$p_desc= limitText( $stkContent->description(), 350);
								$p_title=$stkContent->title();
								$p_link=$stkContent->permalink();
				
								if(!$p_desc) $p_desc='<strong class="no-set-desc">'.$L->get('no description set in this article').'</strong>';
								
								$htmlStick.='
									<p><a href="'.$p_link.'">'.$p_title.'</a> - <span>'.$p_desc.'</span></p>
					';

							}
							
							if(count($arStickyFeatured)==$NUMBER_STICKY_PAGES_HOME_PAGE) break;
				   }		
						
					$htmlStick.='
						</section>
		';	
					if( count($arStickyFeatured)<=0 ) $htmlStick=''; #prevent echo featured content if it doesn't have any sticky
				
				}
				
				$str.=$htmlStick;	
				
				$str.='
					<section class="home">';
				foreach ($content as $page)
				{
					if(!in_array($page->key(), $arStickyFeatured)) 
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
				}
				
$str.='
					</section>
';				
			}
			
			echo $str.$nl.Paginator();			
?>
