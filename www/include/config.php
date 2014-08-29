<?php

//----------------------------------------------------
// lien vers le dossier comprenant les torrents
//----------------------------------------------------
// chemin entre le dossier private_board et votre / vos dossier(s) de torrent  
// ******************************************
// * --- exemple pour une architecture :    * 
// * folder : www/sites/private_board       *
// * folder : www/torrents1                 *
// * folder : www/torrents2                 *
// * --- la configuration sera :            *
// * $way="../..";                          *
// * $name=array("/torrents1","torrents2"); *
// ******************************************
// * --- exemple pour une architecture :    * 
// * folder : www/private_board             *
// * folder : www/torrent                   *
// * --- la configuration sera :            *
// * $way="..";                             *
// * $name=array("/torrents1");             *
// ******************************************
$way="..";
$name=array("/torrent", "/torrent_music");


//----------------------------------------------------
// url réel vers votre dossier de torrents
//----------------------------------------------------
$path_absolu="http://x.xxx.xxx.xxx";


//----------------------------------------------------
// Partition ou se situe les fichiers "/", "/home","/usr", "/var"
//----------------------------------------------------
$partition = "/home";


//----------------------------------------------------
// Connexion à la base de donnée
//----------------------------------------------------
$host = "localhost";
$dbname = "dbname";
$dbid = "dbuser";
$dbmdp = "mdp";
// on effectue la connexion
try
{
    $connexion = new PDO('mysql:host='.$host.';dbname='.$dbname, $dbid, $dbmdp);
}
catch(Exception $e)
{
    echo 'Erreur : '.$e->getMessage().'<br />';
    echo 'N° : '.$e->getCode();
} 


//----------------------------------------------------
// Autres configurations
//----------------------------------------------------
// durée des sessions en seconde
$time_session = 36000;
// Limitation d'ip (on limite le nombre d'ip différente par user au cours des dernière 24h à un nombre maximum)
$nb_ip_day = 3; 


//----------------------------------------------------
// Gestion des taches cron
//----------------------------------------------------
// rechargement de la liste des fichiers automatiquement ou non en cron 
// Exemple crontab : */5 * * * * wget -q --spider http://x.xxx.xxx.xxx/private_board/_cron_file.php (x.xxx.xxx.xxx = adresse serveur)
// 0 cron off 
// 1 cron on
$cron_file = 1;
// fréquence de rechargement de la liste des fichiers par les utilisateurs en seconde 
// (toutes les 5mins par défaut) si vous ne le faites pas en tache cron ($cron_file = 0;)
$time_load = 300;

?>