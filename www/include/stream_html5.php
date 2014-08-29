<?php

//si on a bien notre parramètre 
if(isset($_GET["file"]) && isset($_GET["type"])) 
{ 
	$file = $_GET["file"];
	$type = $_GET["type"];
	
	if( $type == "mp4" )
	{
		echo '
			 <center>
				<video width="640px" height="360px" controls="controls">
					<source src="'.$file .'" type="video/mp4" />
				</video>
			 </center>
		';
	}
	elseif( $type == "mkv" )
	{
		echo '				 
			<center>
				<video width="640px" height="360px" controls="controls">
					<source src="'.$file .'" type="video/x-matroska" codecs="theora, vorbis" />
				</video>
			 </center>
		';
	}
}


?>
