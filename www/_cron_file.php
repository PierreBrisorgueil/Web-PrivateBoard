<?php 

/**********************************************
************* By YourCreation.fr **************
***********************************************
***********************************************
* Nous ne sommes par esponsables des fichiers *
**** que vous partagez via notre script PB ****
***********************************************/

include("./include/config.php");
include("./include/function.php");

for($j=0;$j<sizeof($name);$j++) 
{
	$folder = $way.$name[$j];
	tri_folderv4($folder, true);
}


$resultats=$connexion->query("SELECT * FROM files"); 
$resultats->setFetchMode(PDO::FETCH_OBJ);

while( $ligne = $resultats->fetch() ) 
{
	$size_way = strlen($way);
	$url_file = $ligne->path. DIRECTORY_SEPARATOR .$ligne->fichier;
	$url_file = substr($url_file,$size_way);
	$url_file = $path_absolu.$url_file;
	$url_file = str_replace(' ', '%20', $url_file);
	$test = url_exists($url_file);

	if($test==false)
	{
		$_id = $connexion->quote($ligne->id); 
		$connexion->exec("DELETE FROM files WHERE id = $_id") or die(print_r($connexion->errorInfo()));	
	}
}
$resultats->closeCursor();


echo "raffraichissement ok.";

?>