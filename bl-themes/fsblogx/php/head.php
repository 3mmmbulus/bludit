  
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php 
  $nl="  ";
  
  $_head = "  ".Theme::metaTags('title').PHP_EOL.$nl;   
	
	if($plugin = getPlugin('pluginHeaderContent'))
	{
		if(!@$plugin->db['descriptionEnabled'])
			$_head .= Theme::metaTagDescription(). $nl;	
	}
	else	
		$_head .= Theme::metaTagDescription(). $nl;	
	
		$_head .= Theme::favicon('img/favicon.png'). $nl.
				  Theme::cssBootstrap(). $nl.
				  Theme::css('css/style.css'). $nl;
				  
		if($_NOINDEXDATA) $_head.=$_NOINDEXDATA."\n";
		
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