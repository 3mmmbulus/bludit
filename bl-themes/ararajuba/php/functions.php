<?php
function baseMSG($msgH, $msgT)
{
	return '
					<section class="msginfo">	
						<h1>'.$msgH.'</h1>	
						<p>'.$msgT.'</p>
					</section>
					
';
}

function EmptyContent()
{
	global $L;
	echo baseMSG( $L->get('error-no-content') , $L->get('none content to appear') );	
}

function ErrorNotFound()
{
	global $L;
	echo baseMSG( 'ERROR 404' , $L->get('No pages found') );
}

function NoContent($title, $msg)
{
	global $L;
	echo baseMSG( $L->get($title) , $L->get($msg) );	
}

function SearchResult()
{
	global $L;
	echo baseMSG( $L->get('search result text') , '');	
}

function CategoryResult($name,$desc)
{
	global $L;
	echo baseMSG( $L->get('category result text'). ' "'.$name.'"' , $desc);	
}

function TagResult($name)
{
	global $L;
	echo baseMSG( $L->get('tag result text'). ' "'.$name.'"' , '');	
}

function Arara_Paginator()
{
	global $L, $ARARUBA_PAGINATOR_NUMBERS;	
	$pagn='';
	
	if (Paginator::numberOfPages()>1)
	{
		$pagn='
				<nav class="paginator">
';
		
		if(!$ARARUBA_PAGINATOR_NUMBERS)
		{
			$pagn.='				<ul>';
			if (Paginator::showPrev())
			$pagn.='	
						<li>
							<a href="'.Paginator::previousPageUrl().'" tabindex="-1">'. $L->get('Previous') .'</a>
						</li>
						';

			$disb='';
			if (Paginator::currentPage()==1)  $disb=' class="disabled"';
			
			$pagn.='
						<li'.$disb.'>
							<a href="'.Theme::siteUrl().'">'.$L->get('Home').'</a>
						</li>
			';
					
			if (Paginator::showNext())		
				$pagn.='
						<li>
							<a href="'.Paginator::nextPageUrl().'">'.$L->get('Next').'</a>
						</li>';
						
			$pagn.='		 </ul>';
		}
		else
		{
				  #this code is copy from blekathlon theme file home.php 
                  //max 9 pages with move
                  $pmax = max(Paginator::currentPage() + 4, 9);
                  $pmin = min(Paginator::currentPage() - 4, Paginator::numberOfPages()-8);
				  $pagn.='<p class="numberpages">'.$L->get('pagination-text'). ' ';
				  
				for ($i = max(1, $pmin); $i <= min($pmax,Paginator::numberOfPages()); $i++)
				{
				   if(Paginator::currentPage() == $i)
						$pagn.='<span class="current">'.$i.'</span>';
					else
						$pagn.='<a class="page-numbers" href="'.Paginator::numberUrl($i).'">'.$i.'</a>';
				}		
				
				$pagn.='</p>';
		}
		
	$pagn.='
				</nav>
				
	';
	
	}
	
	return $pagn;
}
// strip tags to avoid breaking any html
#  https://stackoverflow.com/questions/4258557/limit-text-length-in-php-and-provide-read-more-link
function limitText($string,$size=150)
{
    $string = strip_tags($string,$size);
    if (strlen($string) > $size) {
    
        // truncate string
        $stringCut = substr($string, 0, $size);
        $endPoint = strrpos($stringCut, ' ');
    
        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
    }
    
    return $string;
}

    #modified get_thumb version of helper.php from blekathlon theme - callback of coverImage
    function get_thumb($pImg)
    {
        $first_img = $pImg->thumbCoverImage();
        
        if (empty($first_img)) {
            preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $pImg->content(), $matches);
            if (isset($matches[1][0])) {
                $first_img = $matches[1][0];
            }
        }
        return $first_img;
    }


	function SrcImage($itemContent, $uri='')
	{
		global $sizeThumb;
		
		if(!empty( $itemContent->coverImage() ) )
		   $srcIMG= $uri.$itemContent->coverImage();
		else
		{   
			if(empty( get_thumb($itemContent) ) )
				$srcIMG="https://via.placeholder.com/".$sizeThumb.".png?text=No%20Image"; 
			else
				$srcIMG=$uri.get_thumb($itemContent);
		}
		
		return $srcIMG;
	}
# see pre formated arrays
function printError($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}
?>