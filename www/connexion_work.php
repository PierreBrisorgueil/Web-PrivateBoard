<?php session_start();			

/**********************************************
************* By YourCreation.fr **************
***********************************************
***********************************************
* Nous ne sommes par esponsables des fichiers *
**** que vous partagez via notre script PB ****
***********************************************/

// code error 
// 0 -> bad login or mdp
// 1 -> to many ip

include("./include/config.php");

// si l'utilisateur clique sur submit

if (isset($_POST['submit']))
{ 
	// on recupere les logs
	$login = $_POST['login'];
	$pass = $_POST['pass'];
	
	// on check les logs dans la db
	$matches = false;
	$resultats=$connexion->query("SELECT id, username, userpass, userlevel, userlastip FROM users"); 
	$resultats->setFetchMode(PDO::FETCH_OBJ);
	while( $ligne = $resultats->fetch() ) 
	{
		if($ligne->username == $login && $ligne->userpass == md5($pass) ) // on verifis l'exitence du user
		{
			// on regarde si l'ip de ce dernier est différente de celle de sa dernière connexion
			if($ligne->userlastip != $_SERVER['REMOTE_ADDR'])
			{
				// alors on vérifie son nombre d'ip différente en plus de celle ci lors des dernières 24h
				$times24 = time() - (24 * 60 * 60);
				$log = $connexion->quote($login); 
				$_times = $connexion->quote($times24);
				$testip=$connexion->query("SELECT COUNT(DISTINCT(ip)) as nb_ip FROM log_connexion WHERE nom = $log and timestamp >= $_times"); 
				$nb_ip = $testip->fetch(PDO::FETCH_OBJ);
				
				// si ce nombre plus celle lors de la connexion depasse la limité fixé, on refuse la connexion
				if( ($nb_ip->nb_ip ) > $nb_ip_day )
				{
					$connexion = null;
					header ('Location: connexion.php?error=1');
					exit();	
				}
				else
				{
					$lvl = $ligne->userlevel;
					$id = $ligne->id;
					$matches = true;					
				}				
			}
			else
			{
				$lvl = $ligne->userlevel;
				$id = $ligne->id;
				$matches = true;	 
			}
		}
	}
	$resultats->closeCursor();
	// si oui
	if($matches == true)
	{
			// on initialise la session
			$_SESSION['login']= $login;
			$_SESSION['Date']= time();
			$_SESSION['lvl']= $lvl;
			$_SESSION['id']= $id;
			
			
			// si la session est bien active on le redirige vers la page privé et on insert un log dans la db
			if($_SESSION['login'])
			{	
				// on effectu l'insertion dans les log
				$log = $connexion->quote($login); 
   				$time = $connexion->quote(time()); 
   				$ip = $connexion->quote($_SERVER['REMOTE_ADDR']); 
				$requete = $connexion->exec("INSERT INTO log_connexion(nom, timestamp, ip) VALUES ($log, $time, $ip)");

				//on met à jour l'ip et la last connexion
	    		$id = $connexion->quote($id); 
   				$time = $connexion->quote(time()); 
   				$ip = $connexion->quote($_SERVER['REMOTE_ADDR']); 
				$requete2 = $connexion->exec("UPDATE users SET lastconexion = $time, userlastip = $ip WHERE id = $id");				

				$connexion = null;
				/*if($_SESSION['login']=="marion" ) //|| $_SESSION['login']=="pierre"
				{
					header ('Location: _jeu.php');
				}
				else
				{ */
					header ('Location: index.php');
				// }
				exit();
			}
			else
			{
				$connexion = null;
				header ('Location: connexion.php');
				exit();				
			}
		
		
		}
		// si jamais l'utilisateur se trompe dans les logs
		else
		{
				$connexion = null;
				header ('Location: connexion.php?error=0');
				exit();
		}
}
else
{
	header ('Location: connexion.php');
}		
		
$connexion = null;


?>