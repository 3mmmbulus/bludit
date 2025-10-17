<?php
	Theme::plugins('pageBegin');
	
				$user=new User($page->username());				
				$author=$user->nickname() ? $user->nickname() : $user->firstName();	
				$author=" | ". $L->get('name-author').$author;
				$title=$page->title();
				#$uri=$page->permalink();
				if(!$ARARAJUBA_REMOVE_DESCRIPTION_ON_PAGE) $desc=$page->description(); else $desc='';
				
				$dta='<time datetime="'.$page->dateRaw('c').'">'.$L->get('date-published'). $page->date().'</time>';
				$rtm=$L->get('Reading Time').' '.$page->readingTime();								
				$coverIMG= $page->coverImage() ? $page->coverImage() : 'https://via.placeholder.com/'.$sizeCover.'.png?text=Image%20'.$sizeCover;

?>				<section id="page">
					<article>
						<header>
							<h2><?php echo $title; ?></h2><?php  				
							if($page->type() != 'static') { ?>
							<p title="data-entry"><?php echo $dta.' | '.$rtm .$author.' <br><span>'.$desc .'</span>'; ?></p>
							<?php if(!$ARARAJUBA_REMOVE_COVER_ON_PAGE) echo '<img src="'.$coverIMG.'" alt="Cover Image" />';?>
							<?php 
							} else echo '<br />';
							?>
						</header>
		
						<div id="cont-art">
						<?php
							echo $page->content();
						?>		
						</div>
		
						<footer>						
			<?php
				$tex='';
				if ($page->hasChildren()) 
				{
					// The variable $page is an Page-Object
					$children = $page->children();
						$tex.= '							<div class="pagechild">
												<p class="readmtitle">'.$L->get('Read more').': 
								';
					// Each child is a Page-Object
					foreach ($children as $child) 
					{
						$tex.= '				<a href="'.$child->permalink().'">'.$child->title().'</a>';
					}
					
					$tex.= '</p></div>';
				}
				
					#############
					if ($page->isChild()) 
					{
						$tex.= '						<p>'.$L->get('Read more'). ': <a href="'.$page->parentMethod('permalink').'">'.$page->parentMethod('title').'</a></p>'.$nl.'					  ';
					}
					
					#############
					if($page->type() != 'static')
					{
						$returnsArray = true;
						$items = $page->tags($returnsArray);
						$nl=" \n";
						$t='';
						$tex.= '				<div class="share">'.$nl;
						foreach ($items as $tagKey=>$tagName)
						{
							$tag = new Tag($tagKey);
							$t.='<a href="'.$tag->permalink().'">'.$tag->name().'</a> ';
						}        
						
						if(!empty($t))
							$tex.= '											<div class="taglist">Tags: '.$t.'</div>';				
			
					$tex.= $nl.$nl.'											<div class="sharelink">
					<p>'.$L->get('share-text').' 
												<a href="https://www.addtoany.com/share#url='.rawurlencode($ARARA_FULLDOMAIN_PAGE).'&amp;title='.rawurlencode('Choose the service to share').'" target="_blank" title="Share on Add to Any">Add to Any</a>
												<a href="https://twitter.com/share?url='.rawurlencode($ARARA_FULLDOMAIN_PAGE).'" target="_blank" title="Share on Twitter">Twitter</a>
												<a href="https://www.facebook.com/sharer.php?u='.rawurlencode($ARARA_FULLDOMAIN_PAGE).'" target="_blank" title="Share on Facebook">Facebook</a>
												<a href="https://api.whatsapp.com/send?text='.$L->get('share-whatsapp-text').rawurlencode($ARARA_FULLDOMAIN_PAGE).'" target="_blank" title="Share on WhatsApp">WhatsApp</a>
											   </p>
											</div>
										</div>
';
				 }
				
				echo $tex.'<br>';
				Theme::plugins('pageEnd');
			?>
   						</footer>
					</article>
				</section>
				
