<?php defined('BLUDIT') or die('Bludit CMS');

function getNickName($user)
{
	$user=new User($user);
	$nick=$user->nickname() ? $user->nickname() : $user->firstName();	
	return $nick;
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


function Msg($title, $text, $class='')
{
	global $L;
	
return '
<section class="'.$class.'">
	<h2>'.$L->get($title).'</h2>
	<p>'.$L->get($text).'</p>
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

function page_info($titleSite, $titleH1, $titleINFO)
{
	$uri='javascript:history.back()';
	$textlink='Go Back';
	
	$html=
	'<!DOCTYPE html><html lang="en" dir="ltr"> <head> <meta http-equiv="X-UA-Compatible" content="IE=Edge"> <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes"> <meta charset="utf-8">'.	
	'<title>'.$titleSite.'</title><meta name="robots" content="noydir,noindex,noarchive,nofollow"> <style>div{width:60%; padding:20px;margin:auto;background-color:#f5f5f5;text-align:center;font-family:arial}div h1{font-size:5rem;margin:0}div p{font-size:3rem}</style> </head> <body>'.
	'<div class="info"><h1>'.$titleH1.'</h1><p>'.$titleINFO.'</p><p><a href="'.$uri.'">'.$textlink.'</a></p></div></body></html>';
	
	return $html;
}

function Paginator()
{
	global $L, $IS_PAGINATOR_BY_NUMBERS;	
	$pagn='';
	
	if (Paginator::numberOfPages()>1)
	{
		$pagn='
				<nav class="paginator">
';
		
		if(!$IS_PAGINATOR_BY_NUMBERS)
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
		global $_DEFAULT_COVER_IMAGE;
		
		if(!empty( $itemContent->coverImage() ) )
		   $srcIMG= $uri.$itemContent->coverImage();
		else
		{   
			if(empty( get_thumb($itemContent) ) )
				$srcIMG=$_DEFAULT_COVER_IMAGE;
			else
				$srcIMG=$uri.get_thumb($itemContent);
		}
		
		return $srcIMG;
	}
	
    function CustomPlugins($type, $limit=3, $IGNORECLASSPLUGIN='')
	{
		global $plugins;
		
		$plg='';		
		$i=0;
				
		foreach ( $plugins[$type] as $plugin )
		{
			if($i >= $limit) break;
			
			if( strtolower(get_class($plugin)) !== strtolower($IGNORECLASSPLUGIN))
			{	
				$plg.= call_user_func( array($plugin, $type) );
				$i++;
			}
		}
		
		return $plg;
	}
					
# see pre formated arrays
function printError($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}
?>