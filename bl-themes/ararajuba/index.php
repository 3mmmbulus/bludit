<!DOCTYPE html>
<?php 
		require_once(THEME_DIR_PHP.'head.php');
?>
   <body>      <?php Theme::plugins('siteBodyBegin'); ?>
   
		<div id="container">
		
			<header id="top">			
				<div id="header-logo">
					<img src="<?php if($site->logo()) 
													echo $site->logo();
												else
												   echo 'https://via.placeholder.com/200x100.png?text=Logo-200x100'; ?>" id="logo"  alt="Logotipo do site <?php echo $site->title(); ?>" />
					<h1><a href="<?php echo Theme::siteUrl(); ?>"><?php echo Theme::Title(); ?></a></h1>
				</div>
				
				<div id="header-desc">
				  <?php 
						if ( $site->slogan() )  echo '<h2>'.$site->slogan().'</h2>'.$nl."\t\t\t  ";
						if ( $site->description() ) echo '<p class="sitedesc">'.$site->description().'</p>'.$nl;
				?>
			 </div>
			</header>
	
			<aside>
				<?php 
				           Theme::plugins('siteSidebar');
				?>
			</aside>

			<main id="content">
<?php
			switch($WHERE_AM_I)
			{
				case 'home':
								if($url->notfound())
										ErrorNotFound();
								elseif (empty($content))  EmptyContent();
								else	
									require_once(THEME_DIR_PHP.'home.php');								
				break;

				case 'page':
								if($url->notfound())
										ErrorNotFound();
								elseif (empty($content))  EmptyContent();
								else				
									require_once(THEME_DIR_PHP.'page.php');
				break;
				
				case 'search':				
								if($url->notfound())
										ErrorNotFound();
								elseif (empty($content))  NoContent('search result text', 'none search result');
								else	
									require_once(THEME_DIR_PHP.'search.php');
				break;					
				
				case 'category':
								if($url->notfound())
										ErrorNotFound(); 
								elseif (empty($content))  NoContent('category result text', 'nothing-to-show-here');
								else	
									require_once(THEME_DIR_PHP.'category.php');
				break;		

				case 'tag': 
								if($url->notfound())
										ErrorNotFound();
								elseif (empty($content))  NoContent('tag result text', 'nothing-to-show-here');
								else	
									require_once(THEME_DIR_PHP.'tag.php');
				break;						
			}			
			
			echo '			</main>'.$nl.$nl;
		
			require_once(THEME_DIR_PHP.'footer.php');

			Theme::plugins('siteBodyEnd'); 
			
?>
		</div>
   </body>
</html>