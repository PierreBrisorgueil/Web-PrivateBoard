<?php

function show_movie($result)
	{
	if(isset( $result["movie"]["title"] ))
	{
		// affiche
		echo '<img class="affiche" src="'.$result["movie"]["poster"]["href"].'"/>';
		// content
		echo '<div id="info_content">';
			// title
			echo "<span><font size='3px'><a href='".$result["movie"]["link"][0]["href"]."'>". $result["movie"]["title"] . "</a></font></span>";
			if(isset($result["movie"]["release"]["releaseDate"])){		echo "<i>(". $result["movie"]["release"]["releaseDate"] .")</i>";}
			// description
			echo '<br /><ul>';
			if(isset($result["movie"]["genre"])){echo "<li><span>Genre : </span>" . get_genre($result["movie"]["genre"]) . "</li>";}
			if(isset($result["movie"]["synopsis"])){echo "<li><span>Résumé : </span>" . $result["movie"]["synopsis"]. "</li>";}
			if(isset($result["movie"]["budget"])){echo "<li><span>Budget : </span>" . $result["movie"]["budget"]. "</li>";}
			if(isset($result["movie"]["castingShort"]["directors"])){echo "<li><span>Réalisateur(s) : </span>" . $result["movie"]["castingShort"]["directors"]. "</li>";}
			if(isset($result["movie"]["castingShort"]["actors"])){echo "<li><span>Acteur(s) : </span>" . $result["movie"]["castingShort"]["actors"]. "</li>";}
			if(isset($result["movie"]["trailer"]["href"])){echo "<li><span>Bande annonce : </span><a href='".$result["movie"]["trailer"]["href"]."' target='_blank'>Ici</a></li>";}

			if(isset($result["movie"]["statistics"]["pressRating"]) || isset($result["movie"]["statistics"]["userRating"]))
			{
				echo "<li><span>Notes Allociné : </span> ";
				if(isset($result["movie"]["statistics"]["pressRating"]))
				{
					$moyenne_press = round($result["movie"]["statistics"]["pressRating"], 1);
					$pourcent_moyenne_press = round($moyenne_press*100/5);	
					echo '
						<div class="html5-progress-bar">
							<div class="progress-bar-wrapper">
								<progress id="progressbar" value="'.$pourcent_moyenne_press.'" max="100"></progress>
								<span class="progress-value">Presse : '.$moyenne_press.'/5</span>
							</div>
						</div> 
					';
				}
				if(isset($result["movie"]["statistics"]["userRating"]))
				{
					$moyenne_user = round($result["movie"]["statistics"]["userRating"], 1);
					$pourcent_moyenne_user = round($moyenne_user*100/5);	
					echo '
						<div class="html5-progress-bar">
							<div class="progress-bar-wrapper">
								<progress id="progressbar" value="'.$pourcent_moyenne_user.'" max="100"></progress>
								<span class="progress-value">Spectateur : '.$moyenne_user.'/5</span>
							</div>
						</div>
					';		
				}
				echo "</li>";	
			}
			echo '</ul><br />
		</div>';
	}
	else
	{
		echo "<p>Information not found ... Sorry.</p>";
	}
}


function show_tvserie($result)
	{
	if(isset( $result["tvseries"]["title"] ))
	{
		// affiche
		echo '<img class="affiche" src="'.$result["tvseries"]["poster"]["href"].'"/>';
		// content
		echo '<div id="info_content">';
			// title
			echo "<span><font size='3px'><a href='".$result["tvseries"]["link"][0]["href"]."'>". $result["tvseries"]["title"] . "</a></font></span>";
			if(isset($result["tvseries"]["originalBroadcast"]["dateStart"])){		echo "<i>(". $result["tvseries"]["originalBroadcast"]["dateStart"] .")</i>";}
			// description
			echo '<br /><ul>';
			if(isset($result["tvseries"]["genre"])){echo "<li><span>Genre : </span>" . get_genre($result["tvseries"]["genre"]) . "</li>";}
			if(isset($result["tvseries"]["synopsis"])){echo "<li><span>Résumé : </span>" . $result["tvseries"]["synopsis"]. "</li>";}
			if(isset($result["tvseries"]["castingShort"]["creators"])){echo "<li><span>Réalisateur(s) : </span>" . $result["tvseries"]["castingShort"]["creators"]. "</li>";}
			if(isset($result["tvseries"]["castingShort"]["actors"])){echo "<li><span>Acteur(s) : </span>" . $result["tvseries"]["castingShort"]["actors"]. "</li>";}
			if(isset($result["tvseries"]["trailer"]["href"])){echo "<li><span>Bande annonce : </span><a href='".$result["tvseries"]["trailer"]["href"]."' target='_blank'>Ici</a></li>";}

			if(isset($result["tvseries"]["statistics"]["pressRating"]) || isset($result["tvseries"]["statistics"]["userRating"]))
			{
				echo "<li><span>Notes Allociné : </span> ";
				if(isset($result["tvseries"]["statistics"]["pressRating"]))
				{
					$moyenne_press = round($result["tvseries"]["statistics"]["pressRating"], 1);
					$pourcent_moyenne_press = round($moyenne_press*100/5);	
					echo '
						<div class="html5-progress-bar">
							<div class="progress-bar-wrapper">
								<progress id="progressbar" value="'.$pourcent_moyenne_press.'" max="100"></progress>
								<span class="progress-value">Presse : '.$moyenne_press.'/5</span>
							</div>
						</div> 
					';
				}
				if(isset($result["tvseries"]["statistics"]["userRating"]))
				{
					$moyenne_user = round($result["tvseries"]["statistics"]["userRating"], 1);
					$pourcent_moyenne_user = round($moyenne_user*100/5);	
					echo '
						<div class="html5-progress-bar">
							<div class="progress-bar-wrapper">
								<progress id="progressbar" value="'.$pourcent_moyenne_user.'" max="100"></progress>
								<span class="progress-value">Spectateur : '.$moyenne_user.'/5</span>
							</div>
						</div>
					';		
				}
				echo "</li>";	
			}
			echo '</ul><br />
		</div>';
	}
	else
	{
		echo "<p>Information not found ... Sorry.</p>";
	}
}
?>