<?php  
	Theme::plugins('pageBegin');
	
	   $str='';
		 
		if( !empty($content) )     		
		{		
		    $page=array_shift($content);
			
			$p_desc=$page->description();
			$p_title=$page->title();
			$p_link=$page->permalink();
			$p_CImage=$page->coverImage();
			
			$str.='

			<article>
			  <header>
					<h2><a href="'.$p_link.'">'.$p_title.'</a></h2>
	';

					if($IS_DESC_BEFORE_COVER_IMAGE_STATIC and $p_desc and !$IS_DESC_AFTER_COVER_IMAGE_STATIC)
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
					 if($IS_DESC_AFTER_COVER_IMAGE_STATIC  and $p_desc and !$IS_DESC_BEFORE_COVER_IMAGE_STATIC)
						$str.='					<figcaption><p>'.limitText( $p_desc , 350).'</p></figcaption>
	';				
						$str.='
					</figure>
	';
					}
					
			$str.='

			  </header>					
				 <div>'.$p_desc.'
						  '. $page->content() .'
				 </div> 
			  ';
			  
/*			  
			  if($page->type()!=='static')
				  $str.='
			  <footer>
				<p><small>'.$page->date() .' | '.getNickName( $page->username() ). ' | ' . $page->readingTime() .'</small></p>
			  </footer>
			  ';
*/			  
			$str.='</article>			
	';
			
			echo $str;			
		}
		else
			echo Msg('error-no-content','none-content-to-appear');			
		
		Theme::plugins('pageEnd');		
?>
