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
		<h2><span>Comment fonctionne le Streaming ?</span> </h2>
			Voici une petite aide pour vous expliquer comment optimiser au maximum le fonctionnement du streaming sur votre ordinateur. Pour accéder au Streaming sur notre site, vous devez cliquer sur le bouton suivant : <img src="./img/stream_all_divx.png" /><br /><i>(Cela permettra de faire appel à un algorithme optimisant la lecture des fichiers, plus efficacement qu'en cliquant simplement sur le nom du fichier.)</i><br /><br />
			<ul>
			<li>
			<span>Dans un premier temps</span>, nous vous conseillons d'utiliser le navigateur web <a href="https://www.google.com/intl/fr/chrome/browser/?hl=fr&brand=CHMA&utm_campaign=fr&utm_source=fr-ha-emea-fr-bk&utm_medium=ha">Google Chrome</a> pour visiter Private Board. Cela devrait déjà vous permettre de lire un certain nombre de fichiers, et plus particulièrement les .mp4. 
			<br/><br/><br/>
			</li>
			
			<li>
			<span>Dans un second temps</span>, si google chrome ne permet pas de lire le fichier ( souvent les .mkv, ou .avi), notre algorithme fait appel à un plugin de lecture. Nous en mettons deux à votre disposition (VLC, et DIVX). Vous effectuez le choix de l'un d'entre eux dans la partie <i>"Option"</i> du menu <i>"User"</i>. Comment choisir ? et comment l'installer ? <br/><br />
			<ul>
				<li><span>Vlc Plugin </span>: Fonctionnant pour le moment sous <b>Windows</b> uniquement, il permettra de lire tous les fichiers sans exception. Nous le conseillons pour les connexions les plus stable et puissante.<br/> Pour l'installer, fermer vos navigateurs, puis désintallez et réinstallez simplement vlc sous windows, en faisant attention de cocher l'option d'installation du plugin VLC pour mozilla. Vlc est disponible <a href="http://www.videolan.org/vlc/">ici</a>. N'oubliez pas d'aller le sélectionner dans vos Options Users sur Private Board.<br /><br /></li>
				<li><span>Divx Web Player </span>: Fonctionnant sous <b>Mac Osx</b> et <b>Windows</b>, il permettra de lire 90% des fichiers. Nous le conseillons pour les connexions moyennes et faibles.<br/>
				Pour l'installer, téléchargez Divx Web player <a href="http://www.divx.com/fr/software/web-player">ici</a>, fermez simplement vos navigateurs puis installez le. N'oubliez pas d'aller le sélectionner dans vos Options Users sur Private Board. </li>
			</ul>
			</ul>
			
			
	</div>
</div>

<?php
    $connexion = null;

	include("./include/footer.php");
?>