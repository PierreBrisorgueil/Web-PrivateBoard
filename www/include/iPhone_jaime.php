<?php
//on se connecte à notre base de données 
include("./config.php");


//si on a bien notre parramètre 
if(isset($_GET["fileid"]) && isset($_GET["userid"]) && isset($_GET["note"])) 
{ 
	$userid = html_entity_decode($_GET["userid"], ENT_QUOTES);
	$fileid = html_entity_decode($_GET["fileid"], ENT_QUOTES);;
	$resultats=$connexion->query("SELECT count(note) as cnote FROM note WHERE fileid = $fileid and userid = $userid "); 
	$resultats->setFetchMode(PDO::FETCH_OBJ);
	$ligne = $resultats->fetch(); 
	$detection_vote = $ligne->cnote;	
	$resultats->closeCursor();
						
	if($detection_vote == 0)
	{
		$fileid = html_entity_decode($_GET["fileid"], ENT_QUOTES);
		$userid = html_entity_decode($_GET["userid"], ENT_QUOTES);
		$note = html_entity_decode($_GET["note"], ENT_QUOTES);
		$requete = $connexion->exec("INSERT INTO note(userid, note, fileid) VALUES ($userid, $note, $fileid)");	
		
		if($note == 1) echo '<a href="#"><img src="./img/iPhone/iPhone_vote_plus_full.png" width="50px"/></a>'; 
		else echo '<a href="#"><img src="./img/iPhone/iPhone_vote_moin_full.png" width="50px"/></a>';
	}
	else
	{
		if($detection_vote == 1) echo '<a href="#"><img src="./img/iPhone/iPhone_vote_plus_full.png" width="50px"/></a>'; 
		else echo '<a href="#"><img src="./img/iPhone/iPhone_vote_moin_full.png" width="50px"/></a>';
	}
}


?>
