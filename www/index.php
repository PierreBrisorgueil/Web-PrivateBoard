<?php session_start();	

/**********************************************
************* By YourCreation.fr **************
***********************************************
***********************************************
* Nous ne sommes par esponsables des fichiers *
**** que vous partagez via notre script PB ****
***********************************************/

// ------------------------------
// include configuration
// ------------------------------

include("./include/config.php");

// ------------------------------
// Vérif connexion
// ------------------------------

if (!isset($_SESSION['login']))
{
	header ('Location: ./connexion.php');
	break;
}

if(time()-($_SESSION['Date']) > $time_session )
{
	session_destroy();
	header ('Location: ./connexion.php');
	break;
}		

// ------------------------------
// include function
// ------------------------------

include("./include/function.php");

// ------------------------------
// include header
// ------------------------------

include("./include/header.php");



// ------------------------------
// Gestion icon new
// ------------------------------
// on récupère l'heure de son dernier chargement de l'index
$id = $connexion->quote($_SESSION['id']); 
$resultats=$connexion->query("SELECT LastLoadIndex FROM users WHERE id = $id"); 
$resultats->setFetchMode(PDO::FETCH_OBJ);
$ligne = $resultats->fetch(); 
$LastLoad = $ligne->LastLoadIndex;

// ------------------------------
// Récupération de la catégorie
// ------------------------------
$cat = "";
if (isset($_GET['cat'])) {$cat = $_GET['cat'];}
$tri_order= "";
if (isset($_GET['tri_order'])) {$tri_order = $_GET['tri_order'];}
$tri_type = "";
if (isset($_GET['tri_type'])) {$tri_type = $_GET['tri_type'];}
?>

<div id="title-left">
	<div class="titre-left">
		<img src="./img/ico/portfolio.png" />
		Bibliothèque
	</div>
</div>

	
	
<div id="title-right">
	<div class="titre-right">
		<div class="r-right">
		Name
		<a href="?cat=<?php echo $cat; ?>&tri_order=asc&tri_type=name"><</a> <a href="?cat=<?php echo $cat; ?>&tri_order=desc&tri_type=name">></a>
		Date
		<a href="?cat=<?php echo $cat; ?>&tri_order=asc&tri_type=temps"><</a> <a href="?cat=<?php echo $cat; ?>&tri_order=desc&tri_type=temps">></a>
		Note
		<a href="?cat=<?php echo $cat; ?>&tri_order=asc&tri_type=moyenne"><</a> <a href="?cat=<?php echo $cat; ?>&tri_order=desc&tri_type=moyenne">></a>
		
		</div>
		<div class="r-center">
			<img src="./img/ico/nuage.png" />
			<?php
			if($cat == ""){echo "Tous les fichiers";}
			else{echo clean_name($cat, "", "");}
			?>
		</div>
	</div>
</div>



<?php
// ------------------------------
// Affichage du menu
// ------------------------------	

// si le user est connecté, et qu'il n'est pas un lvl de restriction 
if($_SESSION['lvl'] == 0 || $_SESSION['lvl'] == 1)
{
		echo '<div id="menu"><ul>';

		echo '<li><div id="title_list">Catégories</div></li>';

			if($url_slash[$nb_slash] == "index.php"){echo '<li><div id="content_list" class="cat-current"><a href="index.php" class="url">Accueil</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index.php" class="url">Accueil</a></div></li>';}		
			if($url_egal[$nb_egal] == "Films"){echo '<li><div id="content_list" class="cat-current"><a href="index.php?cat=Films" class="url">Films</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index.php?cat=Films" class="url">Films</a></div></li>';}		
			if($url_egal[$nb_egal] == "Series"){echo '<li><div id="content_list" class="cat-current"><a href="index.php?cat=Series" class="url">Séries</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index.php?cat=Series" class="url">Séries</a></div></li>';}		
			if($url_egal[$nb_egal] == "Musiques"){echo '<li><div id="content_list" class="cat-current"><a href="index.php?cat=Musiques" class="url">Musiques</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index.php?cat=Musiques" class="url">Musiques</a></div></li>';}		
			if($url_egal[$nb_egal] == "eBooks"){echo '<li><div id="content_list" class="cat-current"><a href="index.php?cat=eBooks" class="url">eBooks</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index.php?cat=eBooks" class="url">eBooks</a></div></li>';}	
			//if($url_egal[$nb_egal] == "Emissions"){echo '<li><div id="content_list" class="cat-current"><a href="index.php?cat=Emissions" class="url">Replay Tv</a></div></li>';}
			//else{echo '<li><div id="content_list" class="cat"><a href="index.php?cat=Emissions" class="url">Replay TV</a></div></li>';}
			if($url_egal[$nb_egal] == "Docs"){echo '<li><div id="content_list" class="cat-current"><a href="index.php?cat=Docs" class="url"><b>Docs</b><font color="red"><i> new :)</i></font></a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index.php?cat=Docs" class="url"><b>Docs</b><font color="red"><i> new :)</i></font></a></div></li>';}	
			if($url_egal[$nb_egal] == "Autre"){echo '<li><div id="content_list" class="cat-current"><a href="index.php?cat=Autre" class="url">Autre</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index.php?cat=Autre" class="url">Autre</a></div></li>';}					
		
		echo '<li><div id="title_list">Séries</div></li>';

		
			$resultats=$connexion->query("SELECT name, text_to_match FROM categories ORDER BY name ASC"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
				if($url_egal[$nb_egal] == $ligne->text_to_match){echo '<li><div id="content_list" class="personal-current"><a href="index.php?cat='.$ligne->text_to_match.'" class="url">'.$ligne->name.'</a></div></li>';}
				else{echo '<li><div id="content_list" class="personal"><a href="index.php?cat='.$ligne->text_to_match.'" class="url">'.$ligne->name.'</a></div></li>';}
			}
			$resultats->closeCursor();
			
		echo '<li><div id="title_list">Liens</div></li>';
		
			$resultats=$connexion->query("SELECT name, url FROM url ORDER BY id ASC"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
				echo '<li><div id="content_list" class="link"><a href="'.$ligne->url.'" class="url"  target=_blank>'.$ligne->name.'</a></div></li>';
			}
			$resultats->closeCursor();
		echo '</ul></div>';		
}
else
{
		echo '<div id="menu"><ul>';
		echo '<li><div id="title_list">Catégories</div></li>';

			$resultats=$connexion->query("SELECT `name`, `text_to_match` FROM `restrictions` WHERE `grade` = " . $_SESSION['lvl']); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
				if($url_egal[$nb_egal] == $ligne->text_to_match){echo '<li><div id="content_list" class="personal-current"><a href="index.php?cat='.$ligne->text_to_match.'" class="url">'.$ligne->name.'</a></div></li>';}
				else{echo '<li><div id="content_list" class="personal"><a href="index.php?cat='.$ligne->text_to_match.'" class="url">'.$ligne->name.'</a></div></li>';}
			}
			$resultats->closeCursor();	

		echo '</ul></div>';		
}
?>


<script>
	var cat_value = "<?php echo $cat; ?>";
	var tri_order_value = "<?php echo $tri_order; ?>";
	var tri_type_value = "<?php echo $tri_type; ?>";
	var LastLoad_value = "<?php echo $LastLoad; ?>";
	
	function ChargeContent(value, order, type, LastLoad)
	{
		var jContent = $("#content");
		var jLoad = $("#gif_loader");
		
		$.ajax(
		{
			url: "index_load_file.php",
			type: "GET",
			data:
			{
				cat : value,
				tri_order : order,
				tri_type : type,
				LastLoad : LastLoad
			},
			dataType: "html",
			error: function(){
				jContent.html( "<p>Reload</p>" );
			},
			beforeSend: function(){
				jLoad.show();
			},
			complete: function(){
			},
			success: function( strData ){
				jLoad.hide();
				jContent.html( strData );
			}
		});
		return( false );
	};

	$(document).ready(function(){
		ChargeContent(cat_value, tri_order_value, tri_type_value, LastLoad_value);
	});
</script>
<style>
#gif_loader
{
	position: relative;
	top: 50px;
	display : none;
	width : 100%;
	height : 100px;
	border : 1 px solid white;
	text-align: center;	
}
</style>

<div id="content">
	<div id="gif_loader" style="vertical-align:middle; display:inline-block;" ><img src="./img/ajax-loader1.gif"></div>
</div>


<?php

// ------------------------------
// gestion icone new
// ------------------------------
$time = time();
//on met à jour l'heure du dernier chargement de l'index si celui ci date de plus d'une heure
if($time > ($LastLoad + $time_session))
{
	$id = $connexion->quote($_SESSION['id']); 
	$time = $connexion->quote(time());  
	$requete2 = $connexion->exec("UPDATE users SET LastLoadIndex = $time WHERE id = $id");	
}

// ------------------------------
// include footer
// ------------------------------
include("./include/footer.php");
?>