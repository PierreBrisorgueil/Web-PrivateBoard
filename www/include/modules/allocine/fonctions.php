<?php
function get_genre($result)
{
	foreach ($result as $key => $value) {$genre .= $value["$"] . ", ";}
	$genre = substr($genre,0,-2);
	return $genre;
}

function clean_name($name)
{
	$name =	strtolower($name);
	$last = substr($name, -1);
	if($last == " ")
	{
		$name = substr($name, 0, -1);
	}
	return $name;
}

?>