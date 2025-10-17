<?php 
		# if page is home and on first page (it means home)
		$htmlStick='';	
		
		if(isset($_GET['page']))
		{
			if($_GET['page']==1)
				$getPageSet=true; 
			else 
				$getPageSet=false;
		}	
		else $getPageSet=true;
		
		$arStickyFeatured=array();
		
		if($WHERE_AM_I=='home' && $getPageSet)
		{
$htmlStick='
				<section id="featured-content" aria-label="featured content">
					<header>
						<h2>'.$L->get('featured-content-header').'</h2>
					</header>
';
			# if you want to use image cache visit https://images.weserv.nl/
			$fullURI='';
			 
			 foreach ($content as $stkContent)
			{
					if($stkContent->type()=='sticky')
					{
						$arStickyFeatured[]=$stkContent->key();
						$srcIMG=SrcImage($stkContent);
						
					$htmlStick.= '			
						<figure>
						  <a href="'.$stkContent->permalink().'"><img src="'.$srcIMG.'" alt="'. $stkContent->title().'" /></a>
						  <figcaption>'.$stkContent->title().' - '.limitText($stkContent->description(),150).'</figcaption>
						</figure>			
';
					}
					
					if(count($arStickyFeatured)==3) break;
				}		
				
			$htmlStick.='
				</section>
';	
		if( count($arStickyFeatured)<=0 ) $htmlStick=''; #prevent echo featured content if it doesn't have any sticky
		
		}#END FEATURED STICKY

$htmlArt=$nl;
		
$htmlArt.='			<div class="decor"><!-- this only has visual meaning --></div>'.$nl.$nl;
$htmlArt.='			<section id="articles" arial-label="Continue reading other articles">';
		
		foreach ($content as $articles)
		{
			if(!in_array($articles->key(), $arStickyFeatured))
			{
				$title=$articles->title();
				$uri=$articles->permalink();
				$desc=limitText($articles->description(),350);
				$artText= $desc ? $desc : limitText($articles->contentBreak(),350);				
				$dta=$L->get('date-published'). $articles->date();
				$btnReadMore= $articles->readMore() ? '<a href="'.$uri.'#cont-art" role="button">'.$L->get('Read more').'</a>' : '';
				$artText=$nl.'				  <p>'.$artText.$nl.$btnReadMore.'</p>';
				$coverIMG= $srcIMG=SrcImage($articles);

				$thumb='<img src="'.$coverIMG.'" alt="'.$title.'" class="thumb" />'.$nl;
$htmlArt.= '				
				  <article>
					  <header>
						<h2><a href="'.$uri.'">'.$title.'</a></h2>
						<p><span>'.$dta.'</span></p>
					  </header>
					  
					  <div class="data-entry">'.$thumb.$artText.'</div>					  
				  </article>
';				
			}
		}
$htmlArt.='				</section>';
echo $htmlStick.$htmlArt.$nl.Arara_Paginator();		
