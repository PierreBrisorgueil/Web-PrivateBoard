<?php 

/**********************************************
************* By YourCreation.fr **************
***********************************************
***********************************************
* Nous ne sommes par esponsables des fichiers *
**** que vous partagez via notre script PB ****
***********************************************/

include("../include/config.php");
include("../include/function.php");


/******* V4.0.1 *******/
$connexion->exec("ALTER TABLE  users ADD  test TINYINT( 4 ) NOT NULL DEFAULT  0");	
$error = $connexion->errorInfo();
if(isset($error[2])){echo "v4 to V4.0.1 already ok.<br />";}
else{echo "<font color='green'>Update v4 to v4.0.1 ok.</font><br />";};


/******* Clean Forbidden File *******/
$count = 0;
$resultats=$connexion->query("SELECT fichier, id FROM files"); 
$resultats->setFetchMode(PDO::FETCH_OBJ);
while( $ligne = $resultats->fetch() ) 
{
	if(detect_chaine($ligne->fichier, "file_forbiden") == true)
	{
		$_id = $connexion->quote($ligne->id); 
		$connexion->exec("DELETE FROM files WHERE id = $_id") or die(print_r($connexion->errorInfo()));
		$count ++;	
	}
}
echo "<font color='green'>Clean forbidden file Ok. (".$count.")</font><br />";



?>