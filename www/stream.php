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

$file ="";
$file = $_GET['file'];

if(isset($_SESSION['login']))
{
	$username = $connexion->quote($_SESSION['login']); 
	$resultats=$connexion->query("SELECT userstream FROM users WHERE username = $username"); 
	$resultats->setFetchMode(PDO::FETCH_OBJ);
	$ligne = $resultats->fetch(); 
	$stream_choice = $ligne->userstream;
	$resultats->closeCursor();
}

	
$url = $_SERVER['REQUEST_URI'];
$url_egal = explode('=',$url);
$nb_egal = sizeof($url_egal)-1;
$url_slash = explode('/',$url);
$nb_slash = sizeof($url_slash)-1;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr"> 
<!-- initialisation habituelle d'une page xhtml -->
	<head>
		<!-- declaration du titre la page -->
		<title>Private Board</title>
		<!-- précision d l'encodage du type de page  -->
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/>
		<!-- mise en place du lien avec le fichier css -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<!-- Lecteur VLC-->
		<script language="javascript" src="./script/vlc.js"></script> 


		
		<script type="text/javascript">
			function supports_video() {
			  return !!document.createElement('video').canPlayType;
			}
			function supports_mp41() {
			  if (!supports_video()) { return false; }
			  var v = document.createElement("video");
			  return v.canPlayType('video/mp4; codecs="avc1.42E01E, mp4a.40.2"');
			}
			function supports_mp42() {
			  if (!supports_video()) { return false; }
			  var v = document.createElement("video");
			  return v.canPlayType('video/mp4; codecs="avc1.58A01E, mp4a.40.2"');
			}
			function supports_mp43() {
			  if (!supports_video()) { return false; }
			  var v = document.createElement("video");
			  return v.canPlayType('video/mp4; codecs="avc1.4D401E, mp4a.40.2"');
			}
			function supports_mp44() {
			  if (!supports_video()) { return false; }
			  var v = document.createElement("video");
			  return v.canPlayType('video/mp4; codecs="avc1.64001E, mp4a.40.2"');
			}
			function supports_mkv() {
			  if (!supports_video()) { return false; }
			  var v = document.createElement("video");
			  return v.canPlayType('video/x-matroska; codecs="theora, vorbis"');
			}				
		</script>
	
	<?php
		// détection du streaming 

		if(preg_match("/\.mp4/", $file))
		{
			echo '
				<script type="text/javascript">
				$(document).ready(function(){
					$("#content-stream").show();
					
					if (!supports_video())
					{ 
						$("#stream").load("./include/stream_plugin.php?file='.$file.'&choice='.$stream_choice.'", function() { });
					}
					else
					{
						if ((supports_mp41() == "probably") && (supports_mp42() == "probably") && (supports_mp43() == "probably") && (supports_mp44() == "probably"))
						{ 
							$("#stream").load("./include/stream_html5.php?file='.$file.'&type=mp4", function() { });
						}
						else
						{
							$("#stream").load("./include/stream_plugin.php?file='.$file.'&choice='.$stream_choice.'", function() { });
						}
					}
					
				});
				</script>
			';
		}elseif(preg_match("/\.mkv/", $file))
		{
			echo '
				<script type="text/javascript">
				$(document).ready(function(){
					$("#content-stream").show();
					
					if (!supports_video())
					{ 
						$("#stream").load("./include/stream_plugin.php?file='.$file.'&choice='.$stream_choice.'", function() { });
					}
					else
					{
						if (supports_mkv() == "probably")
						{ 
							$("#stream").load("./include/stream_html5.php?file='.$file.'&type=mkv", function() { });
						}
						else
						{
							$("#stream").load("./include/stream_plugin.php?file='.$file.'&choice='.$stream_choice.'", function() { });
						}
					}
					
				});
				</script>
			';
		}elseif(preg_match("/\.avi/", $file))
		{
			echo '
				<script type="text/javascript">
				$(document).ready(function(){
					$("#content-stream").show();
					$("#stream").load("./include/stream_plugin.php?file='.$file.'&choice='.$stream_choice.'", function() { });
				});
				</script>
			';
		}

			
		if(isset($_SESSION['login']))
		{
			$username = $connexion->quote($_SESSION['login']); 
			$resultats=$connexion->query("SELECT userstyle FROM users WHERE username = $username"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			$ligne = $resultats->fetch(); 
			echo '<link rel="stylesheet" href="./style/'.$ligne->userstyle.'" type="text/css"/>';
			$resultats->closeCursor();
		}
		else
		{
			echo '<link rel="stylesheet" href="./style/style3.css" type="text/css"/>';
		}
		
	
	echo '	
		</head>
		<body>
			<div id="top">
	';

		if(isset($_SESSION['login']))
		{
			echo '
			<div class="left">
				<ul> 
			';	
			if($url_slash[$nb_slash] == "index.php"){echo '<li><a href="index.php" class="current">Accueil</a></li>';}else{echo '<li><a href="index.php">Accueil</a></li>';}
			if($url_slash[$nb_slash] == "requete.php"){echo '<li><a href="requete.php" class="current">Requêtes</a></li>';}else{echo '<li><a href="requete.php">Requêtes</a></li>';}
			echo '	
				</ul>		
			</div>	
			<div class="right">
				<ul>
			';
			
			if($url_slash[$nb_slash] == "option.php"){echo '<li><a href="option.php" class="current">User</a></li>';}else{echo '<li><a href="option.php">User</a></li>';}
			if($_SESSION['lvl']==0)
			{
				if($url_slash[$nb_slash] == "administration.php"){echo '<li><a href="administration.php" class="current">Admin</a></li>';}else{echo '<li><a href="administration.php">Admin</a></li>';}
			}
			echo '
				<li><a href="connexion.php?action=logout">Déconnexion</a></li>
				</ul>
			</div>
			';
		}
	
	echo '
	</div>
		<div id="content-stream">
			<div id="stream"></div>
		</div>
	';

	include("./include/footer.php");
?>