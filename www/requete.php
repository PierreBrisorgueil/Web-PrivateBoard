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
?>


<div id="title-left">
	<div class="titre-left">
		Top des requêtes
	</div>
</div>

	
	
<div id="title-right">
	<div class="titre-right">
		Effectuer une requête
	</div>
</div>

<div id="content">
	<div class="text">
		A quoi sert une requete ? 
		<ul>
		<li>Elle permet de me demander d'essayer de vous trouver un film / un fichier</li>
		<li>J'y répondrais par oui ou non sur le fait que je l'ai trouvé</li>
		<li>Si je l'ai trouvé il sera ajouté rapidement sur le serveur, et disponible pour vous</li>
		</ul>
		En général, seul les film déjà sortie en DVD sont disponible. Afin d'assurer la qualité.
	</div>
	
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
		<tr>
			<th width="40px">id</th>
			<th width="150px">Prenom</th>
			<th>requete</th>
			<th width="60px">type</th>
			<th width="60px">quality</th>
			<th width="60px">language</th>
			<th width="50px">status</th>
		<?php
		
		if($_SESSION['lvl']==0)
		{
			echo "<th width='200px'>Administration</th>";
		}
		
		echo "</tr>";
			
			$resultats=$connexion->query("SELECT * FROM requetes ORDER BY id DESC"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
					echo '
						<tr>
						<td width="40px">'.$ligne->id.'</td>
						<td width="150px"><b><span>'.$ligne->nom.'</span></b></td>
						<td class="name">'.$ligne->requete.'</td>
						<td width="60px">'.$ligne->type.'</td>			
						<td width="60px">'.$ligne->quality.'</td>			
						<td width="60px">'.$ligne->language.'</td>					
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