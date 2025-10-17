<?php defined('BLUDIT') or die('Bludit CMS');

	## GLOBALS	
	$authorName = $site->footer();	 # Change site's author name 
	
	#default lang
	$lowerLang = strtolower(Theme::lang());	
		
	#for home page
	$IS_PAGINATOR_BY_NUMBERS=false;	
	$NUMBER_STICKY_PAGES_HOME_PAGE=5; // limit the number of STICKY PAGES - '-1' is the same as all pages
	
	# for all pages - set default image if it is not uploaded 
	$IS_COVER_IMAGE_FALLBACK_SET=true;
	
	#DEFAULT IMAGE FALLBACK	- you can change here
	$_w='200';
	$_h='100';
	#remove '#' below if you want to control thumbs size with control panel
	#$_w=$site->thumbnailWidth();$_h=$site->thumbnailHeight();
	$_DEFAULT_COVER_IMAGE='https://via.placeholder.com/'.$_w.'x'.$_h.'/555/bbb/cover.png?text=Image%20'.$_w.'x'.$_h;
	
	$nl="\n\t";
	$__TAB="\t";
	
	#FUNCTIONS - NOT CHANGE CODE FROM HERE TO BELOW
	require_once(THEME_DIR_PHP.'functions.php');	

	#DEFAULT PAGE NOT FOUND	
	$firstURI=strtolower($url->explodeSlug()[0]);

	if( $firstURI === 'search')
	{	
		$className='pluginFS_EssentialBlocks';
		$plugin = getPlugin($className);
		
		if(!@$plugin->db['fs_SearchEnabled'])
		{				
			if(!@pluginActivated('pluginSearch') )
			{
			  $url->setWhereAmI($firstURI);
			  $content=null;			  
			  $plgNotActive=Msg('plugin-need-activate-message-err', 'plugin-search-required', 'msgerror');
			}
		}		
	}
	else
		if( $url->notfound()) {	echo page_info('ERROR', 'ERROR 404', 'Page Not Found'); exit; }					
?>