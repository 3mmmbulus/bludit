<?php
$htmlArt=$nl.SearchResult();
$htmlArt.='			<section id="articles" arial-label="Continue reading other articles">';
		#printError($content);
		foreach ($content as $articles)
		{
				$title=$articles->title();
				$uri=$articles->permalink();
				$desc=limitText($articles->description(),350);
				$artText= $desc ? $desc : limitText($articles->contentBreak(),350);				
				$dta=$L->get('date-published'). $articles->date();				
				$btnReadMore= $articles->readMore() ? '<a href="'.$uri.'#cont-art" role="button">'.$L->get('Read more').'</a>' : '';
				$artText=$nl.'				  <p>'.$artText.$nl.$btnReadMore.'</p>';
				$coverIMG= $articles->coverImage() ? $articles->coverImage() : 'https://via.placeholder.com/'.$sizeThumb.'.png?text=Image%20'.$sizeThumb;

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
$htmlArt.='				</section>';

echo $htmlArt.Arara_Paginator();
?>
				
