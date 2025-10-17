<?php
$arb_head='
  <html lang="'. $ararajuba_lowerLang .'">
   <head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">  
	<meta charset="utf-8">
'.$nl;
	
	    $arb_head .= Theme::viewport("width=device-width, initial-scale=1, shrink-to-fit=no").$nl.
					Theme::metaTagTitle().$nl;
					
					if($plugin = getPlugin('pluginHeaderContent'))
					{
						if(!$plugin->db['descriptionEnabled'])
							$arb_head .= Theme::metaTagDescription(). $nl;
					}
					else
						$arb_head .= Theme::metaTagDescription(). $nl;
					
	    $arb_head .= Theme::favicon('img/favicon.png').$nl.
					Theme::css('css/style.css'); 
					
					echo $arb_head.$nl;

		Theme::plugins('siteHead');					
		
		echo $nl.'<script src="'. HTML_PATH_THEME_JS.'scripts.js"'.' defer></script>'.$nl.'
    <script type="application/ld+json">
     {
       "@context": "http://schema.org",
       "@type": "WebSite",
       "name": "'.$site->title().'",
      "alternateName": "'. $site->description().'",
      "url": "'. $site->url().'",
      "potentialAction": { "@type": "SearchAction", "target": "'. $site->url().'/search/{search_term_string}", "query-input": "required name=search_term_string" }	  
    }
   </script>   
'.$nl;
?>
   </head>

