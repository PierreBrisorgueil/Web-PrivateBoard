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
// Récupération de la variable action
// ------------------------------
$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

switch($action)
{
    case "add":
		try {
			$prenom = $connexion->quote($_SESSION['login']); 
			$name = $connexion->quote($_POST['name']);
			$type = $connexion->quote($_POST['type']); 
			$quality = $connexion->quote($_POST['quality']); 
			$language = $connexion->quote($_POST['language']); 
			$count = $connexion->exec("INSERT INTO requetes(nom, requete, status, type, quality, language) VALUES ($prenom, $name, 0, $type, $quality, $language)");
			$connexion = null;
			if(detect_mobile($platform) == true){header('Location: requete_iPhone.php');}
			else{header('Location: requete.php');}
			break;
		}
		catch(PDOException $e){echo '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';}		
	break;
    case "edit":
		$what = $_POST['what'];
		if($what == 0 || $what == 1 || $what == 2 || $what == 3 )
		{
			$status = $connexion->quote($what); 
			$idreq = $connexion->quote($_POST['idreq']); 
			$count = $connexion->exec("UPDATE requetes SET status = $status WHERE id = $idreq");		
		}
		elseif($what == 4)
		{    	
			$idreq = $connexion->quote($_POST['idreq']); 
			$count = $connexion->exec("DELETE FROM requetes WHERE id = $idreq");		
		}
		$connexion = null;
		if(detect_mobile($platform) == true){header('Location: requete_iPhone.php');}
		else{header('Location: requete.php');}
	break;
    default;
}


?>