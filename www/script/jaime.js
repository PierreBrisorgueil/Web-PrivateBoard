//$(document).ready(function() {
	
  function jaime1(fileid, userid, note, current){
 		var jaime = current;
		//on apelle en ajax notre fichier de traitement serveur en lui donnant en parramètre idetifiant de notre article 
		$.ajax({
			type: "GET",
			url: "./include/jaime.php?fileid=" + fileid + "&userid=" + userid + "&note=" + note,
			dataType: "html",

			//affichage de l'erreur en cas de problème 
			error: function(msg, string) {
				alert("Une erreur a eu lieu : " + string + ". Nous nous excusons pour le désagrément occasioné, si cela se répète, merci de nous contacter.");
			},
			success: function(data) {
				//si le fichier renvoi 0 on ne fait rien sinon on vide notre lien et on remplace par les nouvelles données 
				console.log(data);
				/*if (data != 0) {
					jaime.empty();
					jaime.append(data);
				}*/
			}
		});
  }
