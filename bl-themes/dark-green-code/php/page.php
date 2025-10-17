<?php  defined('BLUDIT') or die('Bludit CMS');

	   $str='';
		 
		if( !empty($content) ) #$str.=Msg('error no content', 'none-content-to-appear');             		
		{		
		    $page=array_shift($content);
			
			$p_desc=$page->description();
			$p_title=$page->title();
			$p_link=$page->permalink();
			$p_CImage=$page->coverImage();
			
			$datainfo='';
			if($page->type()!=='static')
				  $datainfo='			  
				<p><span><time datetime="'.$page->dateModified('c').'">'.($page->dateModified()? $page->dateModified(): $page->date() ) .'</time> | '.getNickName( $page->username() ). ' | ' . $page->readingTime() .'</span></p>
			  ';			

			$linkp='';
			$class='';
			$footerart='';
			if ($page->previousKey()) {
				$previousPage = buildPage($page->previousKey());
				$class=' class="leftpos"';
				$linkp.='<span'.$class.'><a href="'.$previousPage->permalink().'">&larr; '.$previousPage->title().'</a></span>';
			}

			if ($page->nextKey()) {
				$nextPage = buildPage($page->nextKey());
				$class=' class="rightpos"';				
				$linkp.='<span'.$class.'><a href="'.$nextPage->permalink().'">'.$nextPage->title().' &rarr;</a></span>';
			}
		
			if($linkp)
			$footerart='
				<footer>
					<p>'.$linkp.'</p>
				</footer>
			';
			
			echo '			
		<section class="page">
		';
		Theme::plugins('pageBegin');
	echo '					
			<article>
			  <header>
					<h2><a href="'.$p_link.'">'.$p_title.'</a></h2>'.$datainfo.'
			  </header>		
			  '; 
			  
			  echo '
			  <div class="content-article">
					  '. $page->content() .'
			  </div>'.$footerart.' 
			</article>
';		
				
			Theme::plugins('pageEnd');
       echo '   			
		</section>
	'; 					
			
			}
			else
				echo Msg('nothing-to-show-here', 'none-content-to-appear','msginfo');
?>
