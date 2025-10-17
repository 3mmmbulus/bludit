<?php defined('BLUDIT') or die('Bludit CMS');

	require_once(THEME_DIR_PHP.'head.php');			
?>  
    <body> 
    <div id="container">
		<?php Theme::plugins('siteBodyBegin'); ?>
		
		<section id="sharelinks">
<?php
$lnks='				
				<ul class="socialnet minor">
';
				if( count(Theme::socialNetworks())>0 )
				{
					foreach (Theme::socialNetworks() as $key=>$label)		
					{
						$lnks.="					<li><a href=\"".$site->{$key}()."\">$label</a></li>\n";
					}
				}		

				if(pluginActivated('pluginRSS'))  
					$lnks.='<li><a href="'. Theme::rssUrl().'" target="_blank">RSS</a></li>'."\n";
			
				else if($plugin = getPlugin('pluginHeaderContent'))
				{
					if(@$plugin->db['rssEnabled'])
					   $lnks.='<li><a href="'. DOMAIN_BASE.'rss.xml" target="_blank">RSS</a></li>'."\n";	
				}
						
$lnks.='				</ul>
';		

echo $lnks;
?>	
		</section>		
		
		<header id="logo">
<?php 					
				$sitelogo='			';
				
				if($site->logo()) 					
				   $sitelogo.= '<h1 class="image"><a href="'. $site->url() .'"><img src="'.$site->logo().'" id="sitelogo"  alt="Logotipo do site '.$site->title().'" ></a></h1>';
			   else
				   $sitelogo.= '<h1 class="link"><a href="'. $site->url() .'">'.$site->title().'</a></h1>';
			   
			   echo $sitelogo;
			   
			   $siteSlogan = $site->slogan()? limitText($site->slogan(),140) : '';
			   $siteDesc= $site->description() ? limitText( $site->description(),200): '';			   
?>


			<section id="about-site">
				<p class="slogan"><?php echo $siteSlogan; ?></p>
				<p class="description"><?php echo $siteDesc ?></p>
			</section>
		</header>
			
		<nav class="primary">	
			<div class="plugin plugin-search">
				<div class="plugin-content">
					<form action="/search" id="searchform">
						<input type="text" placeholder="<?php echo $L->get('searchbox-placeholder'); ?>" name="s" id="s" required>
						<input type="hidden" name="d" id="d" value="<?php echo DOMAIN_BASE; ?>">
						<input type="submit" value="<?php echo $L->get('search'); ?>" >
					</form>
				</div>
			</div>				
			<section id="toplinks">
				<?php 
$lnks='				
				<ul>
';				
$lnks.="					<li><a href=\"".$site->url()."\">".$L->get('home')."</a></li>\n";

			if(!empty($staticContent))
			{   
				foreach ($staticContent as $sttkpg)		
				{
					$lnks.="					<li><a href=\"".$sttkpg->permalink()."\">".$sttkpg->title()."</a></li>\n";
				}
			}	
$lnks.='				</ul>
';		
echo $lnks;					
				
				?>
			</section>
		</nav>
					
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
				
				case 'category':																				
							require_once(THEME_DIR_PHP.'category.php');
				break;				
				
				case 'tag':																				
							require_once(THEME_DIR_PHP.'tag.php');
				break;							
			}	
			
			#ignore pluginsearch
			$widgetContent=CustomPlugins('siteSidebar',3,'pluginsearch');
			
			$var='widget0';
			
			$countWidget=substr_count($widgetContent, 'plugin-content');				
			
			if($countWidget==3)
				$var='widgets';		
			else if($countWidget==2)				
				$var='widgets widgets2';	
			else if($countWidget==1)				
				$var='widgets widgets1';

echo '
			<footer class="'.$var.'">
				'. $widgetContent .'
			</footer>

		</main>'.$nl.'
		<footer id="bottom">       
			<p>'.$site->footer().' | <a href="https://themes.bludit.com">Dark Green Code Template</a> powered <img src="'.HTML_PATH_THEME_IMG.'/bluditicon.png" alt="BLUDIT MINI LOGO"> <a href="https://www.bludit.com">BLUDIT</a></p>
		</footer>
';
			Theme::plugins('siteBodyEnd'); 				
?> 
    </div>
  </body>
</html>