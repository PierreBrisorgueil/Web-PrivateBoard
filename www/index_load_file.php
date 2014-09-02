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


// ------------------------------
// refresh file load
// ------------------------------
if($cron_file != 1)
{
	// on récupère l'heure de son dernier chargement de l'index
	$id = $connexion->quote($_SESSION['id']); 
	$resultats=$connexion->query("SELECT LastLoadFile FROM users WHERE id = $id"); 
	$resultats->setFetchMode(PDO::FETCH_OBJ);
	$ligne = $resultats->fetch(); 
	$LastLoadFile = $ligne->LastLoadFile;
	$time = time();

	//on met à jour l'heure du dernier chargement de l'index si celui ci date de plus de x temps et on lance le rechargement de la liste des fichiers si cron n'est pas activé
	if($time > ($LastLoadFile + $time_load))
	{
		for($j=0;$j<sizeof($name);$j++) 
		{
			$folder = $way.$name[$j];
			tri_folderv4($folder, true);
		}
		$id = $connexion->quote($_SESSION['id']); 
		$time = $connexion->quote(time());  
		$requete2 = $connexion->exec("UPDATE users SET LastLoadFile = $time WHERE id = $id");	
	}
}
	
$cat = "";
if (isset($_GET['cat'])) {$cat = $_GET['cat'];}
$tri_order= "";
if (isset($_GET['tri_order'])) {$tri_order = $_GET['tri_order'];}
$tri_type = "";
if (isset($_GET['tri_type'])) {$tri_type = $_GET['tri_type'];}
$LastLoad = "";
if (isset($_GET['LastLoad'])) {$LastLoad = $_GET['LastLoad'];}


if($_SESSION['lvl'] == 0 || $_SESSION['lvl'] == 1)
{
	switch($cat)
    {
	        case "Series":
	       			$resultats=$connexion->query("SELECT * FROM files WHERE cat = 'Series' ORDER BY temps DESC"); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	        case "Musiques":
	       			$resultats=$connexion->query("SELECT * FROM files WHERE cat = 'Musiques' ORDER BY temps DESC"); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	        case "Autre":
	       			$resultats=$connexion->query("SELECT * FROM files WHERE cat = 'Autre' ORDER BY propername ASC"); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	        case "":
	       			$resultats=$connexion->query("SELECT * FROM files ORDER BY temps DESC LIMIT 300"); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	        case "Films":
	       			$resultats=$connexion->query("SELECT * FROM files WHERE cat = 'Films' ORDER BY propername ASC"); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	        case "eBooks":
	       			$resultats=$connexion->query("SELECT * FROM files WHERE cat = 'eBooks' ORDER BY propername ASC"); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	        case "Emissions":
	       			$resultats=$connexion->query("SELECT * FROM files WHERE cat = 'Emissions' ORDER BY temps DESC"); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	        default:
			    	$_cat = $connexion->quote("%".$cat."%"); 
			       	$resultats=$connexion->query("SELECT * FROM files WHERE fichier LIKE $_cat ORDER BY propername DESC "); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	  }
} 
else
{
	switch($cat)
    {
	        case "":
		        	$array_to_match = array('0');

					$resultats=$connexion->query("SELECT `text_to_match` FROM `restrictions` WHERE `grade` = " . $_SESSION['lvl']); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
					while( $ligne = $resultats->fetch() ) 
					{
						$array_to_match[] =  "'%".$ligne->text_to_match."%'";
					}
					$resultats->closeCursor();	

					$string = implode(' OR fichier LIKE ', $array_to_match);

			        $resultats=$connexion->query("SELECT * FROM files WHERE fichier LIKE $string ORDER BY propername DESC "); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	        default:
			    	$_cat = $connexion->quote("%".$cat."%"); 
			       	$resultats=$connexion->query("SELECT * FROM files WHERE fichier LIKE $_cat ORDER BY propername DESC "); 
					$resultats->setFetchMode(PDO::FETCH_OBJ);
	            break;
	  }
}

$saison = "";
$compteur=0;
$Output = "";
$Output .= "<table class=\"full\">";



while( $ligne = $resultats->fetch() ) 
{
	
	//gestion des votes 
	$fileid = $connexion->quote($ligne->id); 
	$resultats2=$connexion->query("SELECT SUM(note) as moyenne FROM note WHERE fileid = $fileid"); 
	$resultats2->setFetchMode(PDO::FETCH_OBJ);
	$ligne2 = $resultats2->fetch(); 
	if($ligne2->moyenne == ""){$moyenne = "<center>--</center>";}
	else{$moyenne = color_note($ligne2->moyenne);}
	$resultats2->closeCursor();
										
	$fileid = $connexion->quote($ligne->id); 
	$resultats2=$connexion->query("SELECT note.id as nid, note, u.username as name FROM `note` LEFT JOIN users u ON u.id = userid WHERE fileid = $fileid"); 
	$resultats2->setFetchMode(PDO::FETCH_OBJ);
	$infovote = "";
	while( $ligne2 = $resultats2->fetch() ) {$infovote .= $ligne2->name . " ( ".$ligne2->note." ) ; ";}
	$resultats2->closeCursor(); 
		
	$userid = $connexion->quote($_SESSION['id']); 
	$fileid = $connexion->quote($ligne->id);
	$resultats2=$connexion->query("SELECT count(note) as cnote FROM note WHERE fileid = $fileid and userid = $userid "); 
	$resultats2->setFetchMode(PDO::FETCH_OBJ);
	$ligne2 = $resultats2->fetch(); 
	$detection_vote = $ligne2->cnote;
	$resultats2->closeCursor();	
	
	$vote=give_etat_vote($detection_vote,$ligne->id,$_SESSION['id']);
	
	$compteur++;
	
	// recupération des préférences d'affichage
	$id = $connexion->quote($_SESSION['id']); 
	$pref=$connexion->query("SELECT userfilename FROM users WHERE id = $id"); 
	$pref->setFetchMode(PDO::FETCH_OBJ);
	$preferences = $pref->fetch(); 


	// tri des saisons
	$save_saison = $saison;
	if($cat != "Series" && $cat != "Musiques"  && $cat != "autre" && $cat != ""  && $cat != "Films" && $cat != "eBooks")
	{
		$explode = explode('.', $ligne->fichier);
		for($j=0;$j<sizeof($explode);$j++)
			if(preg_match("#S0#i", $explode[$j]) || preg_match("#S1#i", $explode[$j]))$saison = substr($explode[$j], 0, 3);

		if($saison != $save_saison) $Output .= "<tr></tr><tr><th colspan='8'>".$saison."</th></tr>";
	}
	
	// on affiche le tableau
	$size_way = strlen($way);
	$url_file = $ligne->path. DIRECTORY_SEPARATOR .$ligne->fichier;
	$url_file = substr($url_file,$size_way);
	$url_file = $path_absolu.$url_file;
	$stream = detect_stream($ligne->fichier,$url_file);
	
	$Output .= '
			<tr>
			<td alt="'.$ligne->code_cat.'" class="categorie '.defineCat($ligne->code_cat).'"></td>
			<td class="name">	
		';
		
	$Output .= detect_info($ligne->propername, $ligne->code_cat, $compteur);
		
	if($preferences->userfilename == 0)
	{
		$Output .= '<a href="'.$ligne->path. DIRECTORY_SEPARATOR .$ligne->fichier.'" title="'.$ligne->fichier.'">'.detect_new($ligne->temps,$LastLoad).give_etat($ligne->fichier).$ligne->propername.'</a>';
	}
	else
	{
		$Output .= '<a href="'.$ligne->path. DIRECTORY_SEPARATOR .$ligne->fichier.'" title="'.$ligne->fichier.'">'.detect_new($ligne->temps,$LastLoad).give_etat($ligne->fichier).$ligne->fichier.'</a>';
	}

	$Output .= '	
			</td>			
			<td width="25px">'.$stream.'</td>	
			<td width="70px" class="small">'.$ligne->taille.'</td>
			<td width="90px" class="small">'.date('d/m à H:i', $ligne->temps).'</td>
			<td width="25px"><a title="'.$infovote.'" style="cursor:help;">'.$moyenne.'</a></td>
		';
		// on récupère l'était de la colonne vote, suivant la présence en db, et le fichier en ajout ou non
	$Output .= $vote;
	$Output .= "</tr>";
	
	$Output .= '
			<tr style="display: none;" id="descr'.$compteur.'" >
				<td colspan="8" class="name">
					<div id="information'.$compteur.'" style="height:100%;">
						<div id="loader_information'.$compteur.'" style="margin-top:20px; margin-bottom:20px;" >
							<center><img src="./img/ajax-loader1.gif"></center>
						</div>
					</div>
				</td>			
			</tr>
			';
		
}
$resultats->closeCursor();



$Output .= "</table>";

echo $Output;

?>