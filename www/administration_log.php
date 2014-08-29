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

include("./include/function.php");
include("./include/header.php");
include("./include/menu_administration.php");
?>


<div id="content">

	<div class="text">
	 	<center>
	 	<b><span class="bull"> Clean : </span> <a href="./administration_action.php?action=clean_db">logs connexion </a></b>
	 	</center>
	</div>
	
<!-- 
--------------------------------------------------
Control iP administration
--------------------------------------------------
-->		
	
	<div class="text">
	 	<b>Liste des 30 dernières connexion</b>
	</div>
	
	<table>
		<tr>
			<th>Nom</th>
			<th>ip</th>
			<th>Date & Heure</th>
		<?php
		
		echo "</tr>";
			
			$resultats=$connexion->query("SELECT * FROM log_connexion ORDER BY timestamp DESC LIMIT 50"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
					echo '
						<tr>
						<td><span><b>'.$ligne->nom.'</b></span></td>
						<td>'.$ligne->Ip.'</td>
						<td>'.date('d/m à H:i', $ligne->timestamp).'</td>						
					';
					
					echo "</tr>";
			}
			$resultats->closeCursor();
		?>
	</table>
	
	
</div>

<?php
    $connexion = null;

	include("./include/footer.php");
?>