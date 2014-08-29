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
Membre administration
--------------------------------------------------
-->			
			
	<div class="text">
	 	<b><span>Ajouter un membre</span> (level -> 0 admin, level 1 -> normal user, level 2 & + -> special user):</b><br /><br /> 
	 
		 <form method="post" action="administration_action.php?action=add_user">
		   	<label for="username"> Pseudo : </label><input type="text" name="username" id="username" />
		   	<label for="usermdp"> Mdp : </label><input type="text" name="usermdp" id="usermdp" />
		   	<label for="userlevel"> level : </label><input type="text" name="userlevel" id="userlevel" />
			<label for="userstyle"> Style : </label>
			<select name="userstyle">
			    <option value="style3.css">This is a revolution - Shadow dark</option>
			    <option value="style4.css">Byte into an apple - Midnight blue</option>		
				<option value="style5.css">There will be 2 kinds of people - Platine</option>
			    <option value="style_noel.css">YourCreation Wish Merry Christmas</option>
			</select>
		    <input type="submit" value="Valider" class="valide"/>
		</form>
	</div>
	
	<table>
		<tr>
			<th width="40px">id</th>
			<th width="150px">username</th>
			<th>Style</th>
			<th width="100px">Level user</th>
			<th width="150px">Dernière connexion</th>
			<th width='200px'>Administration</th>
		</tr>
		<?php
			$resultats=$connexion->query("SELECT id, username, userlevel, lastconexion, userstyle FROM users ORDER BY id ASC"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
					if($ligne->userstyle == "style3.css"){ $style = "This is a revolution - Shadow dark - Yourcreation.fr"; }
					elseif($ligne->userstyle == "style4.css"){ $style = "Byte into an apple - Midnight blue - Yourcreation.fr"; }
					elseif($ligne->userstyle == "style5.css"){ $style = "There will be 2 kinds of people - Platine - Yourcreation.fr"; }
					elseif($ligne->userstyle == "style_noel.css"){ $style = "YourCreation Wish Merry Christmas"; }
					else{ $style = "---"; }
					echo '
						<tr>
						<td width="40px">'.$ligne->id.'</td>
						<td width="150px"><b><span>'.$ligne->username.'</span></b></td>
						<td>'.$style.'</td>
						<td width="60px">'.$ligne->userlevel.'</td>
						<td width="150px">'.date("Y-m-d H:i:s", $ligne->lastconexion).'</td>			
						<td width="200px">
							<form method="post" action="administration_action.php?action=modif_user">
								  <input type="hidden" name="iduser"  value="'.$ligne->id.'" />
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
	
	
<!-- 
--------------------------------------------------
Special User restriction administration
--------------------------------------------------
-->		

	<div class="text">
	 	<b><span>Accès des nouveaux grades</span>(exemple : <i>(Grade - level user)</i> <b>2 -></b> <i>(Nom de catégorie à laquelle il a accès) </i><b>The big bag theorie</b> <i>(text a identifier pour ranger le fichier) </i><b>the.big.bang.theory</b>):</b><br /><br /> 
	 
		 <form method="post" action="administration_action.php?action=add_restrict">
		   	<label for="grade"> Grade - level user : </label><input type="text" name="grade" id="grade" />
		   	<label for="name"> Nom catégorie : </label><input type="text" name="name" id="name" />
		   	<label for="texttomatch"> Texte à identifier : </label><input type="text" name="texttomatch" id="texttomatch" />
		    <input type="submit" value="Valider" class="valide"/>
		</form>
	</div>
	
	<table>
		<tr>
			<th width="40px">id</th>
			<th width="40px">grade</th>
			<th width="250px">Name</th>
			<th>Texte à identifier</th>
			<th width='200px'>Administration</th>
		</tr>
		<?php
			$resultats=$connexion->query("SELECT * FROM restrictions ORDER BY grade ASC"); 
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while( $ligne = $resultats->fetch() ) 
			{
					echo '
					<tr>
						<td width="40px">'.$ligne->id.'</td>
						<td width="40px"><b><span>'.$ligne->grade.'</span></b></td>
						<td width="250px"><b>'.$ligne->name.'</b></td>
						<td>'.$ligne->text_to_match.'</td>		
						<td width="200px">
							<form method="post" action="administration_action.php?action=modif_restrict">
								  <input type="hidden" name="idrestrict"  value="'.$ligne->id.'" />
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