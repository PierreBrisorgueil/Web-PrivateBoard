<?php
require_once(__DIR__.'/allocine.class.php');
require_once(__DIR__.'/fonctions.php');
require_once(__DIR__.'/fonctions-affichage.php');


define('ALLOCINE_PARTNER_KEY', '100043982026');
define('ALLOCINE_SECRET_KEY', '29d185d98c984a359e6e6f26a0474269');

$allocine = new Allocine(ALLOCINE_PARTNER_KEY, ALLOCINE_SECRET_KEY);

$name = "";
$type = "";
if (isset($_GET['_name'])) {$name = clean_name($_GET['_name']);}
if (isset($_GET['_type'])) {$type = clean_name($_GET['_type']);}

?>

<html>
<head></head>
<body>
<?php

$result = $allocine->search($name, $type);

// on récupère les films
$phpArray = json_decode($result, true);
foreach ($phpArray as $key => $value) { 
    foreach ($value as $k => $v) { 
        if($k == $type){$list = $v;}
    }
}
$Similarite = 0;$Count = 0;$Number = 0;

foreach ($list as $key => $value)
{
	similar_text($name, $value["originalTitle"], $Pourcentage); 
	if($Pourcentage >= $Similarite)
	{
		$Similarite = $Pourcentage;
		$Number = $Count;
	}
	$Count++;
}

$result = json_decode($allocine->get($list[$Number]["code"], $type), true);

switch ($type) {
    case "movie":
        show_movie($result);
        break;
    case "tvseries":
        show_tvserie($result);
        break;
	default:
       echo "<p>Type of file not found ... Sorry.</p>";
}

?>

</body>
</html>

