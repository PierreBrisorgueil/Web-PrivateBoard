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


$file = array();
$result = array();
for($j=0;$j<sizeof($name);$j++) 
{
	$folder = $way.$name[$j];
	$result = tri_folderv4($folder, true);
	$file = array_merge($file, $result);	
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
	if($cat != "")
    {
        $file = TriSectionv4($cat, $file);
    }
	switch($cat)
    {
        case "serie":
        case "Musiques":
        case "autre":
        case "":
            if ($tri_order == "" || $tri_type == ""){ $tri_order = "desc";$tri_type = "temps"; } 
            $file = sort_tableau($file, $tri_type, $tri_order);
            break;
        case "Films":
        case "eBooks":
            if ($tri_order == "" || $tri_type == ""){ $tri_order = "asc";$tri_type = "fichier"; } 
            $file = sort_tableau($file, $tri_type, $tri_order);
            break;
        default:
            if ($tri_order == "" || $tri_type == ""){ $tri_order = "desc";$tri_type = "fichier"; } 
            $file = sort_tableau($file, $tri_type, $tri_order);
            break;
    }
} 


	
	$saison = "";
	$Output = "";
	$Output .= "<table class=\"full\">";
	
	foreach($file as $key => $value)
	{
		// tri des saisons
		$save_saison = $saison;
		
		if($cat != "Series" && $cat != "Musiques"  && $cat != "autre" && $cat != ""  && $cat != "Films" && $cat != "eBooks")
		{
			$explode = explode('.', $value['fichier']);
			
			for($j=0;$j<sizeof($explode);$j++)
				if(preg_match("#S0#i", $explode[$j]) || preg_match("#S1#i", $explode[$j]))$saison = substr($explode[$j], 0, 3);
	
			if($saison != $save_saison) $Output .= "<tr></tr><tr><th colspan='8'>".$saison."</th></tr>";
		}
		// on affiche le tableau
		$stream = Phone_detect_stream($value['fichier']);
		
		$Output .= '
				<tr>
				<td alt="'.$value['code_cat'].'" class="categorie '.$value['cat'].'"></td>
				<td class="name">'.$stream.' <a href="'.$value['Path']. DIRECTORY_SEPARATOR .$value['fichier'].'" title="'.$value['fichier'].'">'.Phone_detect_new($value['temps'],$LastLoad).give_etat($value['fichier']).clean_name($value['fichier'], $value['Path'], $way.$name).'</a>
				<br />
				<font size="4px">
					(
					'.$value['taille'].' - 
					'.date('d/m à H:i', $value['temps']).' )
				</font>
				</td>			
				<td width="50px"><a title="'.$value['infovote'].'" style="cursor:help;">'.$value['moyenne'].'</a></td>
			';
			// on récupère l'était de la colonne vote, suivant la présence en db, et le fichier en ajout ou non
			$Output .= $value['etat_vote'];
			$Output .= "</tr>";
	}
	$Output .= "</table>";
	
	echo $Output;	


?>