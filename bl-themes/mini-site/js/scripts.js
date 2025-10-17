window.onload=function() 
{
	document.getElementById("searchform").onsubmit=function()
	{
			pluginSearch();
			return false;
	}
	
	function pluginSearch() 
	{
		    var domain=document.getElementById("d").value;
			var text=document.getElementById("s").value;
			window.open(domain+'search/'+text, '_self');			
			return false;
	}

	document.getElementById("s").onkeypress = function(e) 
	{		
		if (!e) e = window.event;
		
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			pluginSearch();
			return false;
		}
	}	
}