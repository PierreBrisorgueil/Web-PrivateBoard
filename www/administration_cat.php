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

<!-- 
--------------------------------------------------
Categorie administration
--------------------------------------------------
-->	
	
<div class="text">
	 	<b><span>Ajouter une catégorie</span> (exemple : <i>(nom catégorie)</i> <b>Big Bang Theory -></b> <i>(text a identifier pour ranger le fichier) </i><b>the.big.bang.theory</b>):</b><br /><br /> 
	 
		 <form method="post" action="administration_action.php?action=add_cat">
		   	<label for="name"> Nom catégorie : </label><input type="text" name="name" id="name" />
		   	<label for="texttomatch"> Texte à identifier : </label><input type="text" name="texttomatch" id="texttomatch" />
		    <input type="submit" value="Valider" class="valide"/>
		</form>
	</div>
	
	<table>
		<tr>
			<th width="40px">id</th>
			<th width="250px">Name</th>
			<th>Texte à identifier</th>
			<th width='200px'>Administration</th>
		</tr>
		<?php
			$resultats=$connexion->query("SELECT * FROM categories ORDER BY id ASC"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
					
					echo '
						<tr>
						<td width="40px">'.$ligne->id.'</td>
						<td width="250px"><b><span>'.$ligne->name.'</span></b></td>
						<td>'.$ligne->text_to_match.'</td>		
						<td width="200px">
							<form method="post" action="administration_action.php?action=modif_cat">
								  <input type="hidden" name="idcat"  value="'.$ligne->id.'" />
								  <select name="what">
								    <option value="0">Supprimer</option>
								  </select>
						    	<input type="submit" value="Valider" class="valide" />
							</form>
						</td>
						</tr>
						';
			}
			$resultats->closeCursor();
		?>
	</table>

	
</div>

<?php
    $connexion = null;

	include("./include/footer.php");
?>