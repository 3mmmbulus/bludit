<?php

	#BEFORE EDIT THIS FILE MAKE A COPY
	
	#GLOBALS
	$nl="\n\t";
	$__TAB="\t";
	
	#limit the number of chars in the description of an article on home page
	$_LIMIT_TEXT_ON_HOME=300;
	
	# set the type of paginator you want - text (default false) or numbers (true)
	$IS_PAGINATOR_BY_NUMBERS=false;

	# MENU TOP - Enable 'true' (default) menu is fixed at the top when you scrolling down - set 'false' to disable it.
	$IS_MENU_TOP_FIXED=true;
	
	# ENTRY IMAGE - HOMEPAGE
	
		# Enable 'true' (default) or disable 'false' top image on home page
		$_ENABLE_DEFAULT_ENTRY_BANNER=true; 
	
		#set width/height dimensions
		$_w='1110';
		$_h='555';
		# if logo is set (by control panel) use it, otherwise use default placeholder
		$_DEFAULT_ENTRYBANNER_IMAGE= $site->logo() ? $site->logo() : 'https://via.placeholder.com/'.$_w.'x'.$_h.'/999/ddd/cover.png?text=Dimensions%20'.$_w.'x'.$_h.'%20-%20Entry%20Image';		
		#$_DEFAULT_ENTRYBANNER_IMAGE='bl-content/uploads/media/mountains.jpg'; #<=remove '#' comment and set your new source image 


	# THUMBS HOMEPAGE
	
		#DEFAULT IMAGE FALLBACK	- you can change here
		$_w='398';
		$_h='211';
		
		#remove '#' below if you want to control thumbs size with control panel
		#$_w=$site->thumbnailWidth();$_h=$site->thumbnailHeight();
		$_DEFAULT_THUMB_IMAGE='https://via.placeholder.com/'.$_w.'x'.$_h.'/999/ddd/cover.png?text=Image%20'.$_w.'x'.$_h;
		#$_DEFAULT_THUMB_IMAGE=''; #<=remove '#' comment and set your new default source image
	
	# Enable or disable (default 'false') link to show posts by author based on their nickname
	$_ENABLE_AUTHORS_LINK_ON_HOME=false;
	
	# INSIDE AN ARTICLE - COVER IMAGE TOP

		# Enable 'true' (default) or disable 'false' top image on page
		$_ENABLE_DEFAULT_COVER_IMAGE=true; 
		
		# Avoid duplicated image when there's only one image - default 'false' not show image / 'true' show image
		$_ENABLE_COVER_IMAGE_ON_PAGE_WHEN_NOT_EXIST=false; 
		
		#set width/height dimensions
		$_w='825';
		$_h='437';
		$_DEFAULT_COVER_IMAGE='https://via.placeholder.com/'.$_w.'x'.$_h.'/999/ddd/cover.png?text=Dimensions%20'.$_w.'x'.$_h.'%20-%20Cover%20Image';
		#$_DEFAULT_COVER_IMAGE=''; #<=remove '#' comment and set your new source image

		# Enable 'true' description on article/page otherwise 'false' (default) to disable it
		$_ENABLE_DESCRIPTION_ON_PAGE=true;
	
	
	# FUNCTIONS - NOT CHANGE CODE FROM HERE TO BELOW
	require_once(THEME_DIR_PHP.'functions.php');	
	
	$_URICHECK[]='';
	$_NOINDEXDATA=false;
	if(isset($url))
	{
		$_URICHECK=explode('/',$url->slug());
		if($_URICHECK[0]=='authors')
		{
			$content = GetAllPagesByUri();
			
			if(@count($content)>0)  $url->setWhereAmI('authors');			
			$_NOINDEXDATA='<meta name="robots" content="noindex,noarchive,follow" />';
		}
	}	
?>