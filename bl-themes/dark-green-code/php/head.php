<?php defined('BLUDIT') or die('Bludit CMS');

	$_head='<!DOCTYPE html>
<html lang="'. $lowerLang .'">

  <head>
  
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">  
    '.Theme::charset('utf-8');
	
	$_head .= $__TAB.Theme::viewport("width=device-width, initial-scale=1").$nl.
			  Theme::metaTagTitle().$nl;							
  
	if($plugin = getPlugin('pluginHeaderContent'))
	{
		if(!@$plugin->db['descriptionEnabled'])
			$_head .= Theme::metaTagDescription(). $__TAB;
	
		if(!@$plugin->db['authorNameEnabled'])
			$_head .= '<meta name="author" content="'.$authorName.'">'.$nl.$nl;
	}
	else
	{
		$_head .= Theme::metaTagDescription(). $__TAB;
		$_head .= '<meta name="author" content="'.$authorName.'">'.$nl.$nl;
	}
	
		$_head .= Theme::favicon('img/favicon.png'). $__TAB.
				  Theme::css('css/style.css'); 
				
	echo $_head.$nl;
	
	Theme::plugins('siteHead');
	
	echo $nl.'<script src="'. HTML_PATH_THEME_JS.'scripts.js"'.' defer></script>'.$nl.'
    <script type="application/ld+json">
     {
       "@context": "http://schema.org",
       "@type": "WebSite",
       "name": "'.$site->title().'",
      "alternateName": "'. $site->description().'",
      "url": "'. $site->url().'"
    }
   </script>   
'.$nl;
?>
   </head>  
  