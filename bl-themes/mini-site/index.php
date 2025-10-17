<!DOCTYPE html>
<html dir="ltr" lang="<?php echo $lowerLang; ?>">
<head>

  <meta http-equiv="X-UA-Compatible" content="IE=Edge"> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">  
  <?php 
		echo Theme::metaTags('title').$nl;
  
	if($plugin = getPlugin('pluginHeaderContent'))
	{
		if(!$plugin->db['descriptionEnabled'])
			echo Theme::metaTags('description').$nl;
	
		if(!$plugin->db['authorNameEnabled'])
			echo '<meta name="author" content="'.$authorName.'">'.$nl;
	}
	else
	{
		echo Theme::metaTags('description').$nl;
		echo '<meta name="author" content="'.$authorName.'">'.$nl;
	}
	
   echo Theme::favicon('img/favicon.png'); 
   echo Theme::css('css/style.css');
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
    <body> 
    <div id="container">
		<?php Theme::plugins('siteBodyBegin'); ?>
		<header id="logo">
	  
			<h1><?php echo '<a href="'. $site->url() .'">'.$site->title().'</a>'; ?></h1>
	  
			<section id="about-site">
				<p class="slogan"><?php echo $site->slogan() ?></p>
				<p class="description"><?php echo $site->description() ?></p>
			</section>
		
		</header>
	
		<div class="decor"></div>
		
		<nav class="primary">
			<ul>
			<?php 
			    // Each static page is an Page-Object
				$li='';
				if( !empty( $staticContent) ) 
				{
					$li='<li><a href="'.$site->url().'">'.$L->get('home').'</a></li>';
					
					foreach ($staticContent as $page) 
					{
						$li.='<li><a href="'.$page->permalink().'">'.$page->title().'</a></li>';
					}
					
					if(strlen($li)>0) 
						echo $li; 
				}
			?>
			</ul>			
			
			<div class="plugin plugin-search">
				<div class="plugin-content">
					<form action="/search" id="searchform">
						<input type="text" name="s" id="s" required>
						<input type="hidden" name="d" id="d" value="<?php echo DOMAIN_BASE; ?>">
						<input type="submit" value="<?php echo $L->get('search'); ?>" >
					</form>
				</div>
			</div>							
		</nav>
		
		<div class="decor decor2"></div>
		
		<main> 
		<?php 
			switch($WHERE_AM_I)
			{
				case 'home':
									require_once(THEME_DIR_PHP.'home.php');								
				break;

				case 'page':				
									require_once(THEME_DIR_PHP.'page.php');
				break;

				case 'search':																				
									require_once(THEME_DIR_PHP.'search.php');
				break;					
				
			}			
		
			echo '			</main>'.$nl.$nl.'		<div class="decor"></div>'.$nl.'
					<footer>
								<p>'.$site->footer().' | <a href="https://themes.bludit.com">Mini Site Template</a> powered <img src="'.HTML_PATH_THEME_IMG.'/bluditicon.png" alt="BLUDIT MINI LOGO"> <a href="https://www.bludit.com">BLUDIT</a></p>
					</footer>
';
			Theme::plugins('siteBodyEnd'); 				
?>
    </div>
  </body>
</html>