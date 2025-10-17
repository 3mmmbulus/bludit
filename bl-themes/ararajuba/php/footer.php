<?php
$lnks='				
				<ul class="socialnet">
';
						foreach (Theme::socialNetworks() as $key=>$label)		
						{
							$lnks.="					<li><a href=\"".$site->{$key}()."\">$label</a></li>\n";
						}
						
						if(pluginActivated('pluginRSS'))  
							$lnks.='<li><a href="'. Theme::rssUrl().'" target="_blank">RSS</a></li>'."\n";
					
					    else if($plugin = getPlugin('pluginHeaderContent'))
						{
							if($plugin->db['rssEnabled'])
							   $lnks.='<li><a href="'. DOMAIN_BASE.'rss.xml" target="_blank">RSS</a></li>'."\n";	
						}
					
$lnks.='				</ul>
';

			if(!$ARARA_PRINT_FOOTER_NETWORKER) $lnks='';
				
?>			<footer id="bottom">
				<p><?php echo $site->footer(); ?> <span>| <a href="https://themes.bludit.com/">Ararajúba Template</a> | Powered by <a href="https://www.bludit.com"><img class="mini-logo" src="<?php echo DOMAIN_THEME_IMG.'bluditicon.png'; ?>" />BLUDIT CMS</a></span></p><?php echo $lnks; ?>
			</footer>
