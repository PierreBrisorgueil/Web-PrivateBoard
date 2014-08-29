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

if ($_SESSION['lvl'] != 0)
{
	header ('Location: ./index');
	break;
}

$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

switch($action)
{
    case "clean_db":
		try {
			$count = $connexion->exec("DELETE FROM log_connexion");
			$connexion = null;
			header('Location: administration_log.php');  
			break;
		}
		catch(PDOException $e){echo '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';}
	break;
    case "add_user":
		try {
			$userstyle = $connexion->quote($_POST['userstyle']); 
			$username = $connexion->quote($_POST['username']); 
			$usermdp = $connexion->quote(md5($_POST['usermdp']));
			$userlevel = $connexion->quote($_POST['userlevel']); 
			$count = $connexion->exec("INSERT INTO users(username, userpass, userlevel, lastconexion, userstyle) VALUES ($username, $usermdp, $userlevel, 0, $userstyle)");
			$connexion = null;
			
			header('Location: administration.php');  
			break;
		}catch(PDOException $e){echo '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';}
	break;
    case "modif_user":
		$what = $_POST['what'];
		if($what == 0)
		{    	
			$iduser = $connexion->quote($_POST['iduser']); 
			$count = $connexion->exec("DELETE FROM users WHERE id = $iduser");		
		}
		$connexion = null;
		header('Location: administration.php');  
		break;
    case "add_cat":
		try {
			$name = $connexion->quote($_POST['name']); 
			$texttomatch = $connexion->quote($_POST['texttomatch']); 
			$count = $connexion->exec("INSERT INTO categories (name, text_to_match) VALUES ($name, $texttomatch)");
			$connexion = null;
			header('Location: administration_cat.php');  
			break;
		}catch(PDOException $e){echo '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';}
	break;
    case "modif_cat":
		$what = $_POST['what'];
		if($what == 0) //delete
		{    	
			$idcat = $connexion->quote($_POST['idcat']); 
			$count = $connexion->exec("DELETE FROM categories WHERE id = $idcat");		
		}
		$connexion = null;
		header('Location: administration_cat.php');  
	break; 
    case "add_link":
		try {
			$name = $connexion->quote($_POST['name']); 
			$url = $connexion->quote($_POST['url']); 
			$count = $connexion->exec("INSERT INTO url(name, url) VALUES ($name, $url)");
			$connexion = null;
			header('Location: administration_link.php');  
			break;
		}
		catch(PDOException $e){echo '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';}
	break;
    case "modif_link":
		$what = $_POST['what'];
		if($what == 0)
		{    	
			$idurl = $connexion->quote($_POST['idurl']); 
			$count = $connexion->exec("DELETE FROM url WHERE id = $idurl");		
		}
		$connexion = null;
		header('Location: administration_link.php');
    default;
    case "add_restrict":
		try {
			$grade = $connexion->quote($_POST['grade']); 
			$name = $connexion->quote($_POST['name']); 
			$texttomatch = $connexion->quote($_POST['texttomatch']); 
			$count = $connexion->exec("INSERT INTO restrictions (grade, name, text_to_match) VALUES ($grade, $name, $texttomatch)");
			$connexion = null;
			header('Location: administration.php');  
			break;
		}
		catch(PDOException $e){echo '<p>Erreur lors de l\'insertion : '.$e->getMessage().'</p>';}
	break;
    case "modif_restrict":
		$what = $_POST['what'];
		if($what == 0)
		{    	
			$idrestrict = $connexion->quote($_POST['idrestrict']); 
			$count = $connexion->exec("DELETE FROM restrictions WHERE id = $idrestrict");		
		}
		$connexion = null;
		header('Location: administration.php');  
	break;
    default;
}


?>