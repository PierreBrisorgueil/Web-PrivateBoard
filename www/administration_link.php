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
link administration
--------------------------------------------------
-->			
			
	<div class="text">
	 	<b><span>Ajouter un lien</span></b><br /><br /> 
	 
		 <form method="post" action="administration_action.php?action=add_link">
		   	<label for="name"> Nom : </label><input type="text" name="name" id="name" />
		   	<label for="url"> Url : </label><input type="text" name="url" id="url" />
		    <input type="submit" value="Valider" class="valide"/>
		</form>
	</div>
	
	<table>
		<tr>
			<th width="40px">id</th>
			<th width="240px">Nom</th>
			<th>Url</th>
			<th width='200px'>Administration</th>
		</tr>
			<?php
			$resultats=$connexion->query("SELECT name, url, id FROM url ORDER BY id ASC"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
					echo '
						<tr>
						<td width="40px">'.$ligne->id.'</td>
						<td width="240px"><b><span>'.$ligne->name.'</span></b></td>
						<td>'.$ligne->url.'</td>			
						<td width="200px">
							<form method="post" action="administration_action.php?action=modif_link">
								  <input type="hidden" name="idurl"  value="'.$ligne->id.'" />
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