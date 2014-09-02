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



$connexion->exec("ALTER TABLE users ADD userfilename INT NOT NULL DEFAULT 0") or die(print_r("Files user option already OK. <br />"));	

echo "Update v4 to v4.0.1 ok.";

?>