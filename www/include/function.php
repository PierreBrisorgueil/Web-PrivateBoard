<?php

// ***************************************************************************************
// ***************************************************************************************
// *************************** Détection Suppléments *************************************
// ***************************************************************************************
// ***************************************************************************************

// ------------------------------
// detection mobile
// ------------------------------
function detect_mobile($plateforme)
{	
	if($plateforme == "iPhone" || $plateforme == "Android" )
	{
		return true;
	}
}

function detect_ipad($plateforme)
{	
	if($plateforme == "iPad")
	{
		return true;
	}
}

// ------------------------------
// detection streaming
// ------------------------------
function detect_stream($file,$path)
{	
	if(preg_match("/\.avi/", $file) || preg_match("/\.mp4/", $file) || preg_match("/\.mkv/", $file))
	{
		$stream = '<a href="stream.php?file='.$path.'" > <img class="icon" src="./img/iPhone/iPhone_stream_all.png" width="16px" style="border:0px;vertical-align:top;"/>';
		return $stream;
	}
	else
	{
		$dl = '<img class="icon" src="./img/iPhone/iPhone_stream_all_deny.png" width="16px" style="border:0px;vertical-align:top;"/>';
		return $dl;
	}	
}

function Phone_detect_stream($file)
{	
	if(preg_match("/\.mp4/", $file))
	{
		$stream = '<img class="icon" src="./img/iPhone/iPhone_stream_all.png" width="35px" style="border:0px;vertical-align:top;"/>';
		return $stream;
	}
	else
	{
		$dl = '<img class="icon" src="./img/iPhone/iPhone_stream_all_deny.png" width="35px" style="border:0px;vertical-align:top;"/>';
		return $dl;
	}	
}

// ------------------------------
// detection info 
// ------------------------------
function detect_info($name_file, $code, $compteur)
{	
	$allocine = ""; // initialisation
	$result ="";

	$table_film = array("100", "120", "104", "124", "200", "220", "024", "004", "014");
	$table_serie = array("111", "121", "011", "021", "001", "201");

	if(in_array($code, $table_film))
	{			
		$file = explode(' ',$name_file);
		for($i=0;$i<sizeof($file)-1;$i++)
		{ 
			if(!preg_match("#\(#i", $file[$i])
			&& !preg_match("#21#i", $file[$i])
			&& !preg_match("#20#i", $file[$i])
			&& !preg_match("#19#i", $file[$i])
			&& !preg_match("#18#i", $file[$i])
			&& !preg_match("#french#i", $file[$i])
			&& !preg_match("#dvd#i", $file[$i])
			&& !preg_match("#vost#i", $file[$i])
			&& !preg_match("#tmb#i", $file[$i])
			&& !preg_match("#avi#i", $file[$i])
			&& !preg_match("#mkv#i", $file[$i])
			&& !preg_match("#mp4#i", $file[$i]))
			{
				$allocine .= $file[$i] . " ";
			}
			else
			{
				break;	
			}
		}
		$result = '<img id="expand'.$compteur.'" width="16" height="16" onclick="tginfo('.$compteur.', \''.$allocine.'\', \'movie\')" alt="+" src="./img/cross.png" style="border:0px;vertical-align:top;"></img>'; 	
	}
	elseif(in_array($code, $table_serie))
	{
		$file = explode(' ',$name_file);
		for($i=0;$i<sizeof($file)-1;$i++)
		{ 
			if(!preg_match("#s0#i", $file[$i])
			&& !preg_match("#s1#i", $file[$i])
			&& !preg_match("#s2#i", $file[$i]))
			{
				$allocine .= $file[$i] . " ";
			}
			else
			{
				break;	
			}
		}
		$result = '<img id="expand'.$compteur.'" width="16" height="16" onclick="tginfo('.$compteur.', \''.$allocine.'\', \'tvseries\')" alt="+" src="./img/cross.png" style="border:0px;vertical-align:top;"></img>'; 		
	}
	return $result;
}
// ***************************************************************************************
// ***************************************************************************************
// *************************** Gestion des affichages ************************************
// ***************************************************************************************
// ***************************************************************************************


// ------------------------------
// reformuler le nom, le choisir entre le nom de dossier et celui du fichier ... 
// ------------------------------
function clean_name($namefile, $pathfile)
{
	// size du nom
	$size_name = strlen($namefile); 
	$analyse_path_file = explode('/', $pathfile);
	$namepath_file = $analyse_path_file[sizeof($analyse_path_file)-1];
	$size_path = strlen($namepath_file);
	if($size_name > $size_path){$selection = $namefile;}
	else{$selection = $namepath_file;}	
	
	
	// on afine l'affichage de ce dernier
	$nb_point = mb_substr_count($selection, ".");
	$nb_tiret = mb_substr_count($selection, "-");
	$nb_tiret_ = mb_substr_count($selection, "_");
	$nb_space = mb_substr_count($selection, " ");

	$max = max(array($nb_space, $nb_tiret_, $nb_tiret, $nb_point));
	
	if($max == $nb_space){
		$selection = str_replace('.', ' ', $selection);  // on retire le . extension
		$selection = $selection; // inutile
	}
	elseif($max == $nb_tiret){$selection = str_replace('-', ' ', $selection);}
	elseif($max == $nb_tiret_){$selection = str_replace('_', ' ', $selection);}
	elseif($max == $nb_point){$selection = str_replace('.', ' ', $selection);}
	
	$name = "";
	$detect = 0;
	$selection = explode(' ', $selection);
	for($j=0;$j<sizeof($selection);$j++) 
	{
		if(preg_match("#vostfr#i", $selection[$j]) || 
		preg_match("#french#i", $selection[$j]) || 
		preg_match("#fastsub#i", $selection[$j]) ||
		preg_match("#mkv#i", $selection[$j]) ||
		preg_match("#avi#i", $selection[$j]) ||
		preg_match("#mp4#i", $selection[$j]) || 
		preg_match("#multi#i", $selection[$j]) ||
		preg_match("#proper#i", $selection[$j])) 
		{
			$detect = 1;
		}
		
		if($detect == 0 && $j<(sizeof($selection)-1))
		{
			$verif = strlen($selection[$j]); 
			$verif2 = strlen($selection[$j+1]); 

			if($verif == 1 && $verif2 == 1){$name .= $selection[$j] . ".";}
			else{$name .= $selection[$j] . " ";}
		}
		elseif(preg_match("#cd#i", $selection[$j])  || preg_match("#part#i", $selection[$j])){$name .= $selection[$j] . " ";}
	}
	$name =	strtolower($name);
	$name = ucfirst($name); 
	
	return $name;
}

// ------------------------------
// mise en forme de la note
// ------------------------------
function color_note($note)
{
	if($note >= 0){$note = "<font color='#5d7078'><b>".$note."</b></font>";}
	elseif($note >= 5 && $note <10){$note = "<font color='#3c87c0'><b>".$note."</b></font>";}
	elseif($note >= 10){$note = "<font color='#00ffe4'><b>".$note."</b></font>";}
	elseif($note < 0){$note = "<font color='#c0392b'><b>".$note."</b></font>";}
	
	return $note;
}

// ------------------------------
// detection telechargement
// ------------------------------
function detect_etat($namefile)
{
	$status = 0;
	if(preg_match("/\.part/", $namefile) && !preg_match("/\.part1/", $namefile) && !preg_match("/\.part2/", $namefile))
	{
		$status = 1;
	}
	return $status;
}

// ------------------------------
// Phrase à afficher en fonction de l'état
// ------------------------------
function give_etat($fichier)
{
	$status = "";
	if(preg_match("/\.part/", $fichier) && !preg_match("/\.part1/", $fichier) && !preg_match("/\.part2/", $fichier))
	{
		$status = '<font color="red">En ajout : </font>';
	}
	return $status;
}

// ------------------------------
// Détection de l'état NEW pour l'utilisateur
// ------------------------------
function detect_new($DateFile, $LastLoadUser)
{
	$status = "";
	if($DateFile >= $LastLoadUser )
	{
		$status = '<img src="./img/new_red.png" style="vertical-align:middle;margin-right:5px;"/> ';
	}
	return $status;
}

function Phone_detect_new($DateFile, $LastLoadUser)
{
	$status = "";
	if($DateFile >= $LastLoadUser )
	{
		$status = '<img src="./img/new_red.png" style="vertical-align:middle;margin-right:5px;" width="40px" /> ';
	}
	return $status;
}

// ------------------------------
// Phrase à afficher en fonction de l'état
// ------------------------------
function give_etat_vote($detection_vote, $id, $user)
{
		if($detection_vote == 0)
		{
			$vote='
				<td class="classement" width="70px" >
						<a class="jaime1" fileid="'.$id.'" userid="'.$user.'" note="1"  style="cursor:pointer;">
							<img src="./img/vote_plus.png"/>
						</a>
						 
						<a class="jaime1" fileid="'.$id.'" userid="'.$user.'" note="-1"  style="cursor:pointer;">
							<img src="./img/vote_moin.png"/>
						</a>
				</td>
				';
		}
		else{$vote='<td width="70px"><center>Merci</center></td>';}	
	
	return $vote;
}

function Phone_give_etat_vote($detection_vote, $id, $user)
{
		if($detection_vote == 0)
		{
			$vote='
				<td class="classement" width="115px" >
						<a class="jaime2" fileid="'.$id.'" userid="'.$user.'" note="1"  style="cursor:pointer;">
							<img src="./img/iPhone/iPhone_vote_plus.png" width="50px"/>
						</a>
						 
						<a class="jaime2" fileid="'.$id.'" userid="'.$user.'" note="-1"  style="cursor:pointer;">
							<img src="./img/iPhone/iPhone_vote_moin.png" width="50px"/>
						</a>
				</td>
				';
		}
		else{$vote='<td width="115px"><center>Merci</center></td>';}
	
	return $vote;
}
// ***************************************************************************************
// ***************************************************************************************
// *************************** Détection des catégories **********************************
// ***************************************************************************************
// ***************************************************************************************

// ------------------------------
// detection hD
// ------------------------------
function detectHD($namefile)
{
	$HD=0;
	if(preg_match("#720p#i", $namefile)){$HD = 1;}
	elseif(preg_match("#1080p#i", $namefile)){$HD = 2;}
	return $HD;
}

// ------------------------------
// detection vost vf
// ------------------------------
function detectV($namefile)
{
	$v=0;
	if(preg_match("#vostfr#i", $namefile)){$v = 1;}
	elseif(preg_match("#french#i", $namefile) || preg_match("#truefrench#i", $namefile)){$v = 2;}
	return $v;
}

// ------------------------------
// detection série et film
// ------------------------------
function detectType($namefile)
{
	$T=0;
	$analyse_cat = explode('.', $namefile);
	for($j=0;$j<sizeof($analyse_cat);$j++) 
	{
		$string = mb_strtolower($analyse_cat[$j]);
		if(
			(
				(preg_match("#S0#i", $namefile) || preg_match("#S1#i", $namefile)) 
				&& 
				(preg_match("#E0#i", $namefile) || preg_match("#E1#i", $namefile) || preg_match("#E2#i", $namefile) || preg_match("#E3#i", $namefile) || preg_match("#E4#i", $namefile) || preg_match("#E5#i", $namefile) 
				|| preg_match("#E6#i", $namefile) || preg_match("#E7#i", $namefile) || preg_match("#E8#i", $namefile) || preg_match("#E9#i", $namefile) || preg_match("#E10#i", $namefile))
			)
		 	|| preg_match("#epz#i", $namefile)
		 ){$T = 1;}
		elseif($string == "flac"){$T = 2;}
		elseif($string == "doc" || $string == "DOC" ){$T = 3;}
		elseif($string == "dvdrip" || $string == "bdrip" || $string == "brrip"){$T = 4;}
		elseif($string == "pdf" || $string == "epub"  || $string == "ebook" || $string == "pour les nuls"){$T = 5;}
	} 
	if($T==0)
	{
		if(preg_match("#flac#i", $namefile) || preg_match("#cd#i", $namefile) || preg_match("#mp3#i", $namefile)){$T = 2;}
		if(preg_match("#mac#i", $namefile) || preg_match("#apple#i", $namefile) || preg_match("#dmg#i", $namefile)){$T = 6;}
		if(preg_match("#window#i", $namefile) || preg_match("#windows#i", $namefile)){$T = 7;}
		if(preg_match("/\.avi/", $namefile) || preg_match("#dvdrip#i", $namefile) || preg_match("#bdrip#i", $namefile) || preg_match("#brrip#i", $namefile)  || preg_match("#.mkv#i", $namefile)){$T = 4;}
		if(preg_match("#doc#i", $namefile) || preg_match("#Ushuaia#i", $namefile) || preg_match("#DOC#i", $namefile) ){$T = 3;}
		if(preg_match('/(\d{2}).(\d{2}).(\d{2})/', $namefile)){$T = 8;}
	}
	return $T;
}

// ------------------------------
//detection catégorie final
// ------------------------------
function defineCat($code)
{
    switch($code)
    {
        case '111':$cat = "cat-tv-hd-vostfr";return $cat;
            break;
        case '121':$cat = "cat-tv-hd-vostfr";return $cat;
            break;
        case '011':$cat = "cat-tv-vostfr";return $cat;
            break;
        case '021':$cat = "cat-tv-vf";return $cat;
            break;
        case '001':$cat = "cat-tv-vo";return $cat;
            break;
        case '201':$cat = "cat-tv-hd-vf";return $cat;
            break;
        case '100':$cat = "cat-hd-720p";return $cat;
            break;
        case '120':$cat = "cat-hd-720p";return $cat;
            break;
        case '104':$cat = "cat-hd-720p";return $cat;
            break;
        case '124':$cat = "cat-hd-720p";return $cat;
            break;
        case '200':$cat = "cat-hd-1080p";return $cat;
            break;
        case '220':$cat = "cat-hd-1080p";return $cat;
            break;
        case '024':$cat = "cat-dvdrip";return $cat;
            break;
        case '004':$cat = "cat-dvdrip";return $cat;
            break;
        case '014':$cat = "cat-dvdrip-vostfr";return $cat;
            break;
        case '005':$cat = "cat-ebook";return $cat;
            break;
        case '025':$cat = "cat-ebook";return $cat;
            break;
        case '002':$cat = "cat-flac";return $cat;
            break;
        case '006':$cat = "cat-apple";return $cat;
            break;
        case '026':$cat = "cat-apple";return $cat;
            break;
        case '007':$cat = "cat-window";return $cat;
            break;
        case '027':$cat = "cat-window";return $cat;
            break;
        case '003':$cat = "cat-doc";return $cat;
            break;
        case '203':$cat = "cat-doc-hd";return $cat;
            break;
        case '103':$cat = "cat-doc-hd";return $cat;
            break;
        case '023':$cat = "cat-doc";return $cat;
            break;
        case '223':$cat = "cat-doc-hd";return $cat;
            break;
        case '123':$cat = "cat-doc-hd";return $cat;
            break;
        case '028':$cat = "cat-emissions";return $cat;
            break;
    	default: $cat = "cat-divers"; return $cat;
    }
}




// ***************************************************************************************
// ***************************************************************************************
// ****************************** Fonctions bonus ****************************************
// ***************************************************************************************
// ***************************************************************************************

// ------------------------------
// affiche les octets en go / mo / ko
// ------------------------------
function convertFileSize($bytes)
{
	if ($bytes >= 1024*1024*1024)
	return round(($bytes / 1024)/1024/1024, 2) ." Go";
	
	elseif ($bytes >= 1024*1024)
	return round(($bytes / 1024)/1024, 2) ." Mo";
	
	
	elseif ($bytes >= 1024)
	return round(($bytes / 1024), 2) ." ko";
	
	else
	return $bytes ." octets";
}

// ------------------------------
// tri un tableau
// ------------------------------
function sort_tableau($array,$sortkey,$sortFlag)
{
	$arraysize = count($array);
	

		foreach(array_keys($array) as $key)
		{
			$temp_array[$key] = $array[$key][$sortkey];
		}
	
		natsort($temp_array);
		if ($sortFlag == 'desc')
		{
			$temp_array = array_reverse($temp_array,TRUE);
		}
	
		foreach(array_keys($temp_array) as $key)
		{
			$return_array[] = $array[$key]; 
		}		
	
	return $return_array;
}

// ------------------------------
// détection de chaine
// ------------------------------
function detect_chaine($chaine, $type)
{	
	switch($type)
    {
        case 'file_forbiden': 
        		$bool = false;
        		$forbiden = array("/\.jpg/",
        							"/\.jpeg/", 
        							"/\.txt/",
        							"/\.md5/",
        							"/\.ini/", 
        							"/\.png/", 
        							"/\.php/", 
        							"/\.svf/", 
        							"/\.m3u/", 
        							"/\thumbs/", 
        							"/\.nfo/", 
        							"/\.log/", 
        							"/\.cue/", 
									"/\.sub/",
        							"/\.idx/", 
        							"/\.sessions/", 
        							"/\.htpasswd/", 
        							"/\.htgroup/", 
        							"/\.htaccess/",
									"/\.aif/",
									"/\.nib/",
									"/\.dylib/",
									"/\.xm/",
									"/\.icns/",
									"/\APEInject/",
									"/\.NFO/",
									"/\.plist/",
									"/\.sample/",
									"/\.samples/",
									"/\.Sample/",
									"/\.Samples/");  
        		foreach($forbiden as $value)
				{        
					if(preg_match($value, $chaine)) $bool = true;
				}
				return $bool;
            break;
    }
}


// ***************************************************************************************
// ***************************************************************************************
// ****************************** Parser de dossier **************************************
// ***************************************************************************************
// ***************************************************************************************

// ------------------------------
// Récupère tous les fichiers autorisé dans un tableau
// ------------------------------
function tri_folderv4($directory, $recursive = true, $listDirs = false, $listFiles = true, $exclude = '') 
{ 		
	include("config.php");
    $platform = parse_user_agent();
	$platform = $platform["platform"];
	$arrayItems = array();
	$array_clear = array();
    $skipByExclude = false;
    $handle = opendir($directory);
    if ($handle) 
    {
        while (false !== ($file = readdir($handle))) 
        {
        	preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
        	if($exclude)
        	{
            	preg_match($exclude, $file, $skipByExclude);
        	}
        	if (!$skip && !$skipByExclude) 
        	{
            	if (is_dir($directory. DIRECTORY_SEPARATOR . $file)) 
            	{
               		if($recursive) 
               		{
                   		$arrayItems = array_merge($arrayItems, tri_folderv4($directory. DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
               		}
               		if($listDirs)
               		{
                    	$file = $directory . DIRECTORY_SEPARATOR . $file;
                    	$arrayItems[] = $file;
               		}
            	}
            	else 
            	{
                	if($listFiles)
                	{
	                  	if (detect_chaine($file, "file_forbiden") != true)
						{
							$code_cat = detectHD($file) . detectV($file) . detectType($file);
							$path = $directory . DIRECTORY_SEPARATOR . $file;
							$info = stat($path);
							$sub_taille = convertFileSize($info['size']);	
							if($info['size'] > 100000) // si le fichier fait plus de 1 mo
							{
								// on sélectionne le nom de fichier le plus approprié ( folder or file)
								$proper_name = clean_name($file, $directory);		
								
								$etat = detect_etat($file);
								// si il n'est pas en dl, on l'insert dans la db car il devient notable etc ... 
								if($etat == 0)
								{
									$detection_db = 0;
									$_name = $connexion->quote($file); 
									$resultats=$connexion->query("SELECT fichier, id FROM files WHERE fichier = $_name"); 
									$resultats->setFetchMode(PDO::FETCH_OBJ);
									while( $ligne = $resultats->fetch() ) 
									{
										if($ligne->fichier == $file){$detection_db = 1;$id = $ligne->id;$array_clear[]=$file;}
									}
									$resultats->closeCursor();
									if($detection_db == 0)
									{
		
										$_name = $connexion->quote($file); 
										$array_clear[]=$file;
										if(isset($proper_name)){$_propername = $connexion->quote($proper_name);}
										else{$_propername = $connexion->quote($file);}

										$_directory =  $connexion->quote($directory); 
										$time = $info['mtime']; 
										$_sub_taille = $connexion->quote($sub_taille); 
										$_cat = $connexion->quote(TriSectionv4($code_cat)); 
										$_code_cat = $connexion->quote($code_cat); 
										$connexion->exec("INSERT INTO files(fichier, propername, path, temps, taille, code_cat, cat) VALUES ($_name, $_propername, $_directory, $time, $_sub_taille, $code_cat, $_cat)")
											or die(print_r($connexion->errorInfo()));	 
									}
								}
							}
						}
					}
             	}
         	}
     	}
     	closedir($handle);
    }
    return $arrayItems;
 }
 


 // ------------------------------
 // tri les sections
 // ------------------------------
 function TriSectionv4($cat)
{
	$table_film = array("100", "120", "200", "220", "024", "014", "004", "104", "124");
    $table_musique = array("002");
	$table_ebooks = array("005", "025");
	$table_series = array("111", "121", "011", "021", "001", "011", "201");
	$table_emission = array("028");

	$table_autre_tous = array_merge($table_film, $table_musique, $table_ebooks, $table_series, $table_emission);
	
	if(in_array($cat, $table_film)){$categorie="Films";}
	elseif(in_array($cat, $table_musique)){$categorie="Musiques";}
	elseif(in_array($cat, $table_ebooks)){$categorie="eBooks";}
	elseif(in_array($cat, $table_series)){$categorie="Series";}
	elseif(in_array($cat, $table_emission)){$categorie="Emissions";}
	elseif(!in_array($cat, $table_autre_tous)){$categorie="Autre";}
	
	return $categorie;
}





// ***************************************************************************************
// ***************************************************************************************
// *************************************** Bonus *****************************************
// ***************************************************************************************
// ***************************************************************************************

// ------------------------------
// give space
// ------------------------------
function gives_pace($place)
{
	$result = '<font size="2">Espace : '.round(convertFileSize(disk_total_space($place)-disk_free_space($place))).' / '.round(convertFileSize(disk_total_space($place))). ' Go</font>';
	
	return $result;
}

// ------------------------------
// Test Url
// ------------------------------
function url_exists($url){
 
    if ((strpos($url, "http")) === false) $url = "http://" . $url;
 
    $headers = @get_headers($url);
 
    if (is_array($headers)){
 
        if(strripos($headers[0], '404 NOT FOUND') 
        	|| strripos($headers[0], '500 Internal Server Error')
        	|| ($headers[0] == 'HTTP/1.1 404 Not Found')
          )
 
            return false;
        else
            return true;    
    }         
    else
        return false;
}

// ------------------------------
// detection mobile
// ------------------------------
/**
 * Parses a user agent string into its important parts
 *
 * @author Jesse G. Donat <donatj@gmail.com>
 * @link https://github.com/donatj/PhpUserAgent
 * @link http://donatstudios.com/PHP-Parser-HTTP_USER_AGENT
 * @param string|null $u_agent User agent string to parse or null. Uses $_SERVER['HTTP_USER_AGENT'] on NULL
 * @throws InvalidArgumentException on not having a proper user agent to parse.
 * @return array an array with browser, version and platform keys
 */
function parse_user_agent( $u_agent = null ) {
	if( is_null($u_agent) ) {
		if( isset($_SERVER['HTTP_USER_AGENT']) ) {
			$u_agent = $_SERVER['HTTP_USER_AGENT'];
		} else {
			throw new \InvalidArgumentException('parse_user_agent requires a user agent');
		}
	}

	$platform = null;
	$browser  = null;
	$version  = null;

	$empty = array( 'platform' => $platform, 'browser' => $browser, 'version' => $version );

	if( !$u_agent ) return $empty;

	if( preg_match('/\((.*?)\)/im', $u_agent, $parent_matches) ) {

		preg_match_all('/(?P<platform>BB\d+;|Android|CrOS|iPhone|iPad|Linux|Macintosh|Windows(\ Phone)?|Silk|linux-gnu|BlackBerry|PlayBook|Nintendo\ (WiiU?|3DS)|Xbox(\ One)?)
				(?:\ [^;]*)?
				(?:;|$)/imx', $parent_matches[1], $result, PREG_PATTERN_ORDER);

		$priority           = array( 'Android', 'Xbox One', 'Xbox' );
		$result['platform'] = array_unique($result['platform']);
		if( count($result['platform']) > 1 ) {
			if( $keys = array_intersect($priority, $result['platform']) ) {
				$platform = reset($keys);
			} else {
				$platform = $result['platform'][0];
			}
		} elseif( isset($result['platform'][0]) ) {
			$platform = $result['platform'][0];
		}
	}

	if( $platform == 'linux-gnu' ) {
		$platform = 'Linux';
	} elseif( $platform == 'CrOS' ) {
		$platform = 'Chrome OS';
	}

	preg_match_all('%(?P<browser>Camino|Kindle(\ Fire\ Build)?|Firefox|Iceweasel|Safari|MSIE|Trident/.*rv|AppleWebKit|Chrome|IEMobile|Opera|OPR|Silk|Lynx|Midori|Version|Wget|curl|NintendoBrowser|PLAYSTATION\ (\d|Vita)+)
			(?:\)?;?)
			(?:(?:[:/ ])(?P<version>[0-9A-Z.]+)|/(?:[A-Z]*))%ix',
		$u_agent, $result, PREG_PATTERN_ORDER);


	// If nothing matched, return null (to avoid undefined index errors)
	if( !isset($result['browser'][0]) || !isset($result['version'][0]) ) {
		return $empty;
	}

	$browser = $result['browser'][0];
	$version = $result['version'][0];

	$find = function ( $search, &$key ) use ( $result ) {
		$xkey = array_search(strtolower($search), array_map('strtolower', $result['browser']));
		if( $xkey !== false ) {
			$key = $xkey;

			return true;
		}

		return false;
	};

	$key = 0;
	if( $browser == 'Iceweasel' ) {
		$browser = 'Firefox';
	} elseif( $find('Playstation Vita', $key) ) {
		$platform = 'PlayStation Vita';
		$browser  = 'Browser';
	} elseif( $find('Kindle Fire Build', $key) || $find('Silk', $key) ) {
		$browser  = $result['browser'][$key] == 'Silk' ? 'Silk' : 'Kindle';
		$platform = 'Kindle Fire';
		if( !($version = $result['version'][$key]) || !is_numeric($version[0]) ) {
			$version = $result['version'][array_search('Version', $result['browser'])];
		}
	} elseif( $find('NintendoBrowser', $key) || $platform == 'Nintendo 3DS' ) {
		$browser = 'NintendoBrowser';
		$version = $result['version'][$key];
	} elseif( $find('Kindle', $key) ) {
		$browser  = $result['browser'][$key];
		$platform = 'Kindle';
		$version  = $result['version'][$key];
	} elseif( $find('OPR', $key) ) {
		$browser = 'Opera Next';
		$version = $result['version'][$key];
	} elseif( $find('Opera', $key) ) {
		$browser = 'Opera';
		$find('Version', $key);
		$version = $result['version'][$key];
	} elseif( $find('Midori', $key) ) {
		$browser = 'Midori';
		$version = $result['version'][$key];
	} elseif( $browser == 'MSIE' || strpos($browser, 'Trident') !== false ) {
		if( $find('IEMobile', $key) ) {
			$browser = 'IEMobile';
		} else {
			$browser = 'MSIE';
			$key     = 0;
		}
		$version = $result['version'][$key];
	} elseif( $find('Chrome', $key) ) {
		$browser = 'Chrome';
		$version = $result['version'][$key];
	} elseif( $browser == 'AppleWebKit' ) {
		if( ($platform == 'Android' && !($key = 0)) ) {
			$browser = 'Android Browser';
		} elseif( strpos($platform, 'BB') === 0 ) {
			$browser  = 'BlackBerry Browser';
			$platform = 'BlackBerry';
		} elseif( $platform == 'BlackBerry' || $platform == 'PlayBook' ) {
			$browser = 'BlackBerry Browser';
		} elseif( $find('Safari', $key) ) {
			$browser = 'Safari';
		}

		$find('Version', $key);

		$version = $result['version'][$key];
	} elseif( $key = preg_grep('/playstation \d/i', array_map('strtolower', $result['browser'])) ) {
		$key = reset($key);

		$platform = 'PlayStation ' . preg_replace('/[^\d]/i', '', $key);
		$browser  = 'NetFront';
	}

	return array( 'platform' => $platform, 'browser' => $browser, 'version' => $version );

}



?>