<?php
	## GLOBALS
	
    #FULL DOMAIN AND LOCALPAGE
    $ARARA_FULLDOMAIN_PAGE=DOMAIN.$url->uri();	
	
	#IF YOU WOULD NOT LIKE TO PRINT SOCIAL NETWORKER at FOOTER set false
	$ARARA_PRINT_FOOTER_NETWORKER=true;
	
	$ARARUBA_PAGINATOR_NUMBERS=false;
	
	$ARARAJUBA_REMOVE_DESCRIPTION_ON_PAGE=false;
	
	$ARARAJUBA_REMOVE_COVER_ON_PAGE=false;
	
	#default lang
	$ararajuba_lowerLang = strtolower(Theme::lang());
	
	$sizeThumb='226x120'; #set size of thumb ( show article if it hadn't any image  )
	#remove '#' below if you want to control thumbs with control panel
	#$sizeThumb=$site->thumbnailWidth().'x'. $site->thumbnailHeight();
	
	$sizeCover='717x300';

	$nl="\n\t";
	
	#FUNCTIONS
	require_once(THEME_DIR_PHP.'functions.php');	
?>