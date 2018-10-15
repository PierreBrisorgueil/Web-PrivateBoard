[![Blog](https://badges.weareopensource.me/badge/Read-On%20our%20Blog-1abc9c.svg?style=flat-square)](https://weareopensource.me) [![Slack](https://badges.weareopensource.me/badge/Chat-On%20Slack-d0355b.svg?style=flat-square)](mailto:weareopensource.me@gmail.com?subject=Join%20Slack&body=Hi,%20I%20found%20your%20community%20We%20Are%20Open%20Source.%20I%20would%20be%20interested%20to%20join%20the%20Slack%20to%20share%20and%20discuss,%20Thanks) [![Mail](https://badges.weareopensource.me/badge/Contact-By%20Mail-3498db.svg?style=flat-square)](mailto:weareopensource.me@gmail.com?subject=Contact)

[![Packagist](https://badges.weareopensource.me/packagist/l/doctrine/orm.svg?style=flat-square)](/LICENSE.md)


-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------

***** Requis : 

  1/ Un serveur web et mysql ok

  2/ que les fichiers que vous souhaitez affichés soit situés dans un dossier sur ce serveur web :
      - dans le www 
      - ou ailleurs en effectuant un lien symbolique ( ln -s /home/pseudo/folder1 /var/www/folder1 )

  3/ que le site web (situé dans le dossier www), une fois décompressé soit situé n'importe ou sur le même serveur web, dans le www du serveur (mettez le dans un dossier à part nommé comme vous le souhaitez)

  4/ créer une base de donné et y importer le fichier "database.sql"
    
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------

--------------------
--------------------
*** 1/ Installation : 
--------------------
--------------------


Une fois cela fait, éditez le fichier "./inlude/config.php" dans le site web que je viens de vous fournir. Vous devez impérativement éditer les trois variables $way $name $path_absolu

  // chemin entre le dossier private_board et votre / vos dossier(s) de fichiers , et nom du / des dossiers de fichiers
  // ******************************************
  // * --- exemple pour une architecture :    * 
  // * folder : www/sites/private_board       *
  // * folder : www/folder1                   *
  // * folder : www/folder2                   *
  // * --- la configuration sera :            *
  // * $way="../..";                          *
  // * $name=array("/folder1","folder2");     *
  // ******************************************
  // * --- exemple pour une architecture :    * 
  // * folder : www/private_board             *
  // * folder : www/folder1                   *
  // * --- la configuration sera :            *
  // * $way="..";                             *
  // * $name=array("/folder1");               *
  // ******************************************
  $way="..";
  $name=array("/folder1");


  //----------------------------------------------------
  // url réel vers votre dossier de torrents
  //----------------------------------------------------
  $path_absolu="http://x.x.x.x";


------------------------
------------------------
*** 2/ connexion à la bdd 
------------------------
------------------------


  Toujours dans le fichier "./inlude/config.php", éditez les variables de connexion à la bdd

  //----------------------------------------------------
  // Connexion à la base de donnée
  //----------------------------------------------------
  $host = "localhost"; // host
  $dbname = "private_board"; // nom de la base de donné
  $dbid = "user"; // user de connexion à la db
  $dbmdp = "mdp"; // mot de pass


------------------------
------------------------
*** 3/ parsage du dossier 
------------------------
------------------------

  Vous pouvez maintenant choisir si le parsage du dossier ce se fera via e un tache cron 
  (réduction du temps de chargement des pages par les utilisateurs) ou par les utilisateurs 
  en chargeant les  pages.

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


  Pour créer une crontab, connectez vous en ssh à votre serveur, entrez 
  "crontab -e"
  puis ajoutez cette ligne dans votre fichier
  */5 * * * * wget -q --spider http://x.xxx.xxx.xxx/private_board/_cron_file.php 
  ( en changeant l'adresse web par celle menant vers _con_file.php à la racine du www)

-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------

***** Rendez vous sur le site, connectez vous avec les id "admin" mdp "admin", Enjoy ;) ! pensez à créer un nouvel utilisateur admin et à supprimer celui par defaut.






-------------------------------------------------------------------------------------
------------------------------------UPDATE-------------------------------------------
-------------------------------------------------------------------------------------
v4 -> v4.0.1 
changelog -> ajout d'une option utilisateur pour afficher les noms de fichiers torrents
tuto -> copier les fichiers du www, en dehors du ./include/config.php
     -> Exécuter le fichier /update/_last_update.php
     -> Vérifier que cela fonctionne correctement en allant dans le pannel user option
     -> supprimer le dossier /update/ 

v4.0.1 -> v4.0.2 
changelog -> ajout des fichiers interdits sample / simples, ainsi que d’une fonction supprimant automatiquement les nouveaux fichiers interdits à chaque update
tuto -> copier les fichiers du www, en dehors du ./include/config.php
     -> Exécuter le fichier /update/_last_update.php
     -> Vérifier que cela fonctionne correctement en voir si vaut fichiers samples on bien disparus de la liste de fichiers
     -> supprimer le dossier /update/
     
     

[![Help](https://badges.weareopensource.me/badge/Help-On%20Patreon-052d49.svg?style=flat-square)](https://www.patreon.com/pbrisorgueil) [![Cofee](https://badges.weareopensource.me/badge/Buy-Me%20a%20Coffee-FF813F.svg?style=flat-square)](https://www.buymeacoffee.com/JrSa9tZGO)


[![Youtube](https://badges.weareopensource.me/badge/Watch-me%20on%20Youtube-e74c3c.svg?style=flat-square)](https://www.youtube.com/channel/UCIIjHtrZL5-rFFupn7c3OtA) [![Twitter](https://badges.weareopensource.me/badge/Follow-me%20on%20Twitter-3498db.svg?style=flat-square)](https://www.youtube.com/channel/UCIIjHtrZL5-rFFupn7c3OtA) 


