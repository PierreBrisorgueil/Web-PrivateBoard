

<div id="title-left">
	<div class="titre-left">
		Tableau de bord
	</div>
</div>

<div id="title-right">
	<div class="titre-right">
		Users
	</div>
</div>


<div id="menu">

	<?php
	if($_SESSION['lvl'] == 0 || $_SESSION['lvl'] == 1)
	{
		echo '<ul>';
		
			if($url_slash[$nb_slash] == "option.php"){echo '<li><div id="content_list" class="admin-current"><a href="option.php" class="url">Options</a></div></li>';}
			else{echo '<li><div id="content_list" class="admin"><a href="option" class="url">Options</a></div></li>';}		
			
			if($url_slash[$nb_slash] == "tuto_streaming.php"){echo '<li><div id="content_list" class="cat-current"><a href="tuto_streaming.php" class="url">Aide : Streaming</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="tuto_streaming.php" class="url">Aide : Streaming</a></div></li>';}		
			
			if($url_slash[$nb_slash] == "tuto_download.php"){echo '<li><div id="content_list" class="cat-current"><a href="tuto_download.php" class="url">Aide : Téléchargement</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="tuto_download.php" class="url">Aide : Téléchargement</a></div></li>';}
						
		echo '</ul>';

	}
	?>
</div>