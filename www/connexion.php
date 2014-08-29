<?php session_start();

/**********************************************
************* By YourCreation.fr **************
***********************************************
***********************************************
* Nous ne sommes par esponsables des fichiers *
**** que vous partagez via notre script PB ****
***********************************************/

if($_GET['action']=="logout")
{
	session_destroy();
	header ('Location: connexion.php');
}

include("./include/config.php");
include("./include/function.php");
include("./include/header.php");


// gestion des erreurs possibles
$error ="";
if(isset($_GET['error']))
{
	if($_GET['error'] == 1 || $_GET['error'] == 0)
	{
		switch ($_GET['error']) 
		{
	    	case 0:
	        	$error = "<br />Mauvais identifiants ou mot de pass.";
	        	break;
	    	case 1:
	        	$error = "<br />Vous vous êtes connecté avec trop d'ip différentes durant les dernières 24H, c'est interdit, patientez …";
	        	break;
		}
	}
	else
	{
		$error = "<br />Fail.";
	}
}
?>



<div id="content-form-zone">
	<center>
		<font color="#6a6a6e"><?php echo $error; ?></font>
	</center>
	<div id="content-form">
			<br />
			<center><span><b>Identification</b></span></center>
			<br />
			<form method="post" action="connexion_work.php">
			<center>
				<input type="text" name="login" id="login" class="un" value="Username" onclick="if(this.value=='Username')this.value='';"/><br />
				<input type="password" name="pass" id="pass" class="deux" value="Password" onclick="if(this.value=='Password')this.value='';"/><br /><br />
				<input type="submit" id="submit" name="submit" value="Connexion" class="trois"/><br />
			</center>
			</form>
	</div>
</div>


	</body>
</html>