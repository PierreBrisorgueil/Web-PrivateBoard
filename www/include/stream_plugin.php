<?php
//on se connecte à notre base de données 
include("./config.php");


//si on a bien notre parramètre 
if(isset($_GET["file"]) && isset($_GET["choice"])) 
{ 
	$file = $_GET["file"];
	$stream_choice = $_GET["choice"];
	
	if( $stream_choice == 0)
	{
		echo '
				 <center>
						<embed type="application/x-vlc-plugin" name="video1" autoplay="no" loop="yes" width="640px" height="360px" target="'.$file .'" />
				 </center>
		';
	}
	elseif($stream_choice == 1)
	{
		echo '
				 <center>
				 <object classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616" width="640px" height="360px" codebase="http://go.divx.com/plugin/DivXBrowserPlugin.cab">
							<param name="src" value="'.$file .'" />
							<embed type="video/divx" src="'.$file .'" width="640" height="360" pluginspage="http://go.divx.com/plugin/download/">
							</embed>
					</object>
				 </center>
		';
	}
}


?>
