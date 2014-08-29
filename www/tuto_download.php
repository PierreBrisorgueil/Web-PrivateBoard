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

?>


<div id="content">

	<div class="text">
	<h2><span>Comment Télécharger un fichier ?</span> </h2>
		Afin de télécharger un fichier, il suffit d'éffectuer un clique droit sur le titre de ce dernier dans la liste, puis de cliquer sur :
		<br />
		<br />
		<ul>
		<li>Sous Safari : <span><i>"Télécharger le fichier lié"</i></span></li>
		<li>Sous Mozilla Firefox : <span><i>"Enregistrer la cible du lien sous"</span></i></li>
		<li>Sous Google Chrome : <span><i>"Enregistrer le lien sous"</i></span></li>
		</ul>
		<br />
		<br />
		Bon téléchargement ;).
	</div>
</div>

<?php
    $connexion = null;

	include("./include/footer.php");
?>