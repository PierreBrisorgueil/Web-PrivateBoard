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
?>


<div id="title">
	<div class="r-center">
		<img src="./img/ico/nuage.png" />
		 Effectuer une requête
	</div>
</div>

<div id="content">

	<div class="text">
	 	<b>Effectuer une requête (fichier que vous recherchez, qualité ..):</b><br /><br /> 
	
		 <form method="post" action="requete_action.php?action=add">
		   	<label for="name"> Nom : </label><input type="text" name="name" id="name" />
		   	<label for="type"> Type : </label>
			  <select name="type">
			    <option>autre</option>
			    <option>Film</option>
			    <option>Docu</option>
			    <option>Série</option>
			    <option>Musique</option>
			    <option>Livre</option>
			  </select>
		   	<label for="quality"> Qualité : </label>
			  <select name="quality">
			    <option>autre</option>
			    <option>divx</option>
			    <option>720p</option>
			    <option>1080p</option>
			  </select>
		   	<label for="language"> Langue : </label>
			  <select name="language">
			    <option>autre</option>
			    <option>Vo</option>
			    <option>Vostfr</option>
			    <option>fr</option>
			  </select>
	    	<input type="submit" value="Valider"   class="valide"/>
		</form>
	</div>
	
	<p>
		<center>
			<img src="./img/0.png" width="20px" style="vertical-align:middle;"/> : En cours 
			<img src="./img/1.png" width="20px" style="vertical-align:middle;"/> : Refusé
			<img src="./img/2.png" width="20px" style="vertical-align:middle;"/> : Ajouter
			<img src="./img/3.png" width="20px" style="vertical-align:middle;"/> : Pas encore disponible
		</center>
	</p>
	
	<table>
		<?php
		
			
			$resultats=$connexion->query("SELECT * FROM requetes ORDER BY id DESC"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
					echo '
						<tr>
						<td width="150px"><b><span>'.$ligne->nom.'</span></b></td>
						<td class="name">'.$ligne->requete.'</td>				
						<td width="50px"><img src="./img/'.$ligne->status.'.png" width="20px"/></td>
						
					';
					
					if($_SESSION['lvl']==0)
					{
						echo '
						<td width="200px">
							<form method="post" action="requete_action.php?action=edit">
								  <input type="hidden" name="idreq"  value="'.$ligne->id.'" />
								  <select name="what">
								    <option value="0">En cours</option>
								    <option value="1">Refusé</option>
								    <option value="2">Ajouté</option>
								    <option value="3">Non dispo</option>
								    <option value="4">Supprimer</option>
								  </select>
						    	<input type="submit" value="Valider"  class="valide" />
							</form>
						</td>
						';
					}
						
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