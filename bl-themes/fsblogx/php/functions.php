<?php defined('BLUDIT') or die('Bludit CMS');

function getNickName($user)
{
	$user=strtolower($user);
	
	try
	{
		$user=new User($user);
		$nick=$user->nickname() ? $user->nickname() : $user->firstName();	
	
		if(empty($nick)) $nick=$user->username();
	}
	catch(Exception $e) { $nick = $user;}
	
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

function GetSearchTerm()
{
	global $url,$_URICHECK;
	
	if($_URICHECK[0]=='search')
		return ucfirst(strip_tags(filter_var($_URICHECK[1])));
}

function GetCategoryInfo()
{
	global $url;
	
	$categoryKey = $url->slug();	
	$category = new Category($categoryKey);

	$desc=$category->description();
	
	if($desc)	
		$category=$category->name().' <span>'.	$category->description() .'</span>';
	else	
		$category=$category->name();
	
	return $category;	
}

function GetTagsInfo()
{
	global $url;
	
	$tagKey = $url->slug();	
	$tag = new Tag($tagKey);
	
	return $tag->name();	
}

function GetAllPagesByUri()
{
	global $_URICHECK,$page,$pages;
	
	$content=array();
	
  // Page number of the paginator, the first page is 1
    $pageNumber = 1;

    // The value -1 tell to Bludit to returns all the pages on the system
    $numberOfItems = -1;

    // Only get the pages with the satus published
    $onlyPublished = true;

    // Get the list of keys of pages
    $items = $pages->getList($pageNumber, $numberOfItems, $onlyPublished);

    foreach ($items as $key)
	{
        // buildPage function returns a Page-Object
        $page = buildPage($key);
		
		if(strtolower(getNickName($page->username()))==strtolower($_URICHECK[1]))
        $content[]=$page;		
    }
	
	#array_shift($content);

	return $content;	
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

	// Returns the first image from the page content
	function fsGetImage($content)
	{
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/ii', $content, $matches);
		
		if (!empty($matches[1][0]))
			return $matches[1][0];

		return false;
	}
	
	// Return the image with fallback
	function fsGetImageURL($id)
	{
		global $page,$_DEFAULT_THUMB_IMAGE;
		
		$img='';
		
		if($page)
		{
			$img=$page->coverImage(true);
					
			if(empty($img))
			{				
				$img = fsGetImage($page->content());
			
				if(empty($img))
					$img=$id;
			}			
		}
		else
		{
			$img=$id;
		}
			
		return $img;
	}
					
# see pre formated arrays
function printError($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}
?>