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



include("./include/function.php");
include("./include/header.php");
include("./include/menu_option.php");


// on récupère l'heure de son dernier chargement de l'index
$id = $connexion->quote($_SESSION['id']); 
$resultats=$connexion->query("SELECT userstream, userstyle FROM users WHERE id = $id"); 
$resultats->setFetchMode(PDO::FETCH_OBJ);
$ligne = $resultats->fetch(); 

if($ligne->userstyle == "style3.css"){ $style = "This is a revolution - Shadow dark - Yourcreation.fr"; }
elseif($ligne->userstyle == "style4.css"){ $style = "Byte into an apple - Midnight blue - Yourcreation.fr"; }
elseif($ligne->userstyle == "style5.css"){ $style = "There will be 2 kinds of people - Platine - Yourcreation.fr"; }
elseif($ligne->userstyle == "style_noel.css"){ $style = "YourCreation Wish Merry Christmas"; }
else{ $style = "---"; }

if($ligne->userstream == "0"){ $stream = "Plugin web VLC media player"; }
elseif($ligne->userstream == "1"){ $stream = "Plugin web Divx web player"; }

?>


<div id="content">
	<div class="text">
		<span>Style</span> Private Board :  <span><b><i><?php echo $style; ?></i></b></span>
		<br /><br />
		 <form method="post" action="option_action.php?action=style">
		   	<label for="style"> Sélectionner votre Style : </label>
			  <select name="style">
			    <option value="3">This is a revolution - Shadow dark - Yourcreation.fr</option>
			    <option value="4">Byte into an apple - Midnight blue - Yourcreation.fr</option>			
				<option value="5">There will be 2 kinds of people - Platine - Yourcreation.fr</option>
			    <option value="11">YourCreation Wish Merry Christmas</option>
			  </select>
			  <input type="submit" value="Valider"  class="valide" />
			</form>
	</div>
	<div class="text">
		<span>Streaming</span> Private Board : <span><b><i><?php echo $stream; ?></i></b></span>
		<br /><br />
		 <form method="post" action="option_action.php?action=stream">
		   	<label for="stream"> Votre Type de Streaming : </label>
			  <select name="stream">
			    <option value="0">Plugin web VLC media player</option>
			    <option value="1">Plugin web Divx web player</option>
			  </select>
			  <input type="submit" value="Valider"  class="valide" />
			</form>
	</div>
</div>

<?php
    $connexion = null;

	include("./include/footer.php");
?>