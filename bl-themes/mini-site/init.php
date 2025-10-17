<?php 
	## GLOBALS	
	$authorName='Mini Site';	 # Change site's author name 
	
	#default lang
	$lowerLang = strtolower(Theme::lang());	
		
	#for home page
	$PAGINATOR_NUMBERS=false;
	$IS_DESC_BEFORE_COVER_IMAGE=false;
	$IS_DESC_AFTER_COVER_IMAGE=true;	
	$NUMBER_STICKY_PAGES_HOME_PAGE=5; // limit the number of STICKY PAGES - '-1' is the same as all pages
	
	#for static page (only one is permited if two is true none of them show)
	$IS_DESC_BEFORE_COVER_IMAGE_STATIC=true; 
	$IS_DESC_AFTER_COVER_IMAGE_STATIC=true;
	
	# for all pages - set default image if it is not uploaded 
	$IS_COVER_IMAGE_FALLBACK_SET=true;
	
	#DEFAULT IMAGE CALLBACK
	$_DEFAULT_COVER_IMAGE='https://via.placeholder.com/744x160.png?text=Image%20744x160';
	
	$nl="\n\t";
	
	#FUNCTIONS
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
			  echo '<h1 style="text-align:center;background-color:#ff0">Adm Message: Plugin "FS Essential Blocks" or "Search" is not active ! Enable one of them to search in this site.<h1>';
			}
		}
	}
	else
		if( $url->notfound()) {	echo page_info('ERROR', 'ERROR 404', 'Page Not Found'); exit; }	
?>