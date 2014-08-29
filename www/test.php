<?php

    $headers = @get_headers("http://5.135.177.209/torrents/torrents/Hannibal.S01.VOSTFR.BDRip.x264-GKS/Hannibal.S01E10.VOSTFR.BDRip.x264-GKS.mkv");
 
    if (is_array($headers)){
 
        if(strripos($headers[0], '404 NOT FOUND') || strripos($headers[0], '500 Internal Server Error'))
            echo "yes";
        else
            echo "No";    
    }         

    echo "<br /><br />" . $headers[0];

?>