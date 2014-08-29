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

if(time()-($_SESSION['Date']) > $time_session )
{
	session_destroy();
	header ('Location: ./connexion.php');
	break;
}		
if (!isset($_SESSION['login']))
{
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

// on récupère l'heure de son dernier chargement de l'index
$id = $connexion->quote($_SESSION['id']); 
$resultats=$connexion->query("SELECT LastLoadIndex FROM users WHERE id = $id"); 
$resultats->setFetchMode(PDO::FETCH_OBJ);
$ligne = $resultats->fetch(); 
$LastLoad = $ligne->LastLoadIndex;


$cat = "";
if (isset($_GET['cat'])) {$cat = $_GET['cat'];}
$tri_order= "";
if (isset($_GET['tri_order'])) {$tri_order = $_GET['tri_order'];}
$tri_type = "";
if (isset($_GET['tri_type'])) {$tri_type = $_GET['tri_type'];}
?>


<div id="title">
	<div class="r-center">
		<img src="./img/ico/nuage.png" />
		<?php
		if($cat == ""){echo "Tous les fichiers";}
		else{echo clean_name($cat, "", "");}
		?>
	</div>
</div>
<?php
	
if($_SESSION['lvl'] == 0 || $_SESSION['lvl'] == 1)
{

		echo '<div id="menu"><ul>';
			if($url_slash[$nb_slash] == "index_iPhone.php"){echo '<li><div id="content_list" class="cat-current"><a href="index_iPhone.php" class="url">Accueil</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index_iPhone.php" class="url">Accueil</a></div></li>';}		
			if($url_egal[$nb_egal] == "Films"){echo '<li><div id="content_list" class="cat-current"><a href="index_iPhone.php?cat=Films" class="url">Films</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index_iPhone.php?cat=Films" class="url">Films</a></div></li>';}		
			if($url_egal[$nb_egal] == "Series"){echo '<li><div id="content_list" class="cat-current"><a href="index_iPhone.php?cat=Series" class="url">Séries</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index_iPhone.php?cat=Series" class="url">Séries</a></div></li>';}		
			if($url_egal[$nb_egal] == "Musiques"){echo '<li><div id="content_list" class="cat-current"><a href="index_iPhone.php?cat=Musiques" class="url">Musiques</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index_iPhone.php?cat=Musiques" class="url">Musiques</a></div></li>';}		
			if($url_egal[$nb_egal] == "eBooks"){echo '<li><div id="content_list" class="cat-current"><a href="index_iPhone.php?cat=eBooks" class="url">eBooks</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index_iPhone.php?cat=eBooks" class="url">eBooks</a></div></li>';}		
			if($url_egal[$nb_egal] == "Autre"){echo '<li><div id="content_list" class="cat-current"><a href="index_iPhone.php?cat=Autre" class="url">Autre</a></div></li>';}
			else{echo '<li><div id="content_list" class="cat"><a href="index_iPhone.php?cat=Autre" class="url">Autre</a></div></li>';}					
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
			url: "index_load_file_iPhone.php",
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

$time = time();
//on met à jour l'heure du dernier chargement de l'index si celui ci date de plus d'une heure
if($time > ($LastLoad + $time_session))
{
	$id = $connexion->quote($_SESSION['id']); 
	$time = $connexion->quote(time());  
	$requete2 = $connexion->exec("UPDATE users SET LastLoadIndex = $time WHERE id = $id");	
}

include("./include/footer.php");
?>