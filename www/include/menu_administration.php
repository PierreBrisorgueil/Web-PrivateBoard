

<div id="title-left">
	<div class="titre-left">
		Tableau de bord
	</div>
</div>

<div id="title-right">
	<div class="titre-right">
		Administration
	</div>
</div>


<div id="menu">

	<?php
	if($_SESSION['lvl'] == 0 || $_SESSION['lvl'] == 1)
	{
		echo '<ul>';
			if($url_slash[$nb_slash] == "administration.php"){echo '<li><div id="content_list" class="admin-current"><a href="administration.php" class="url">Membres</a></div></li>';}
			else{echo '<li><div id="content_list" class="admin"><a href="administration.php" class="url">Membres</a></div></li>';}		
			if($url_slash[$nb_slash] == "administration_cat.php"){echo '<li><div id="content_list" class="admin-current"><a href="administration_cat.php" class="url">Catégories</a></div></li>';}
			else{echo '<li><div id="content_list" class="admin"><a href="administration_cat.php" class="url">Catégories</a></div></li>';}		
			if($url_slash[$nb_slash] == "administration_link.php"){echo '<li><div id="content_list" class="admin-current"><a href="administration_link.php" class="url">Liens</a></div></li>';}
			else{echo '<li><div id="content_list" class="admin"><a href="administration_link.php" class="url">Liens</a></div></li>';}		
			if($url_slash[$nb_slash] == "administration_log.php"){echo '<li><div id="content_list" class="admin-current"><a href="administration_log.php" class="url">Logs</a></div></li>';}
			else{echo '<li><div id="content_list" class="admin"><a href="administration_log.php" class="url">Logs</a></div></li>';}					
		echo '</ul>';

	}
	?>
</div>