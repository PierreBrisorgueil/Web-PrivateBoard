function Chargeinfo(value, name_type, id)
{
	var jContent = $("#information" + id);
	var jLoad = $("#loader_information" + id);
	
	$.ajax(
	{
		url: "./include/modules/allocine/search.php",
		type: "GET",
		data:
		{
			_name : value,
			_type : name_type,
		},
		dataType: "html",
		error: function(){
			jContent.html( "<p>Reload</p>" );
		},
		beforeSend: function(){
			jLoad.show();
		},
		complete: function(){
		},
		success: function( strData ){
			jLoad.hide();
			jContent.html( strData );
		}
	});
	return( false );
};



function tginfo(id, name, type) {

if(jQuery("#descr"+id).is(":hidden"))
{ 
	jQuery("#expand"+id).attr("src","./img/uncross.png"); 
	Chargeinfo(name, type, id);

}else{
	jQuery("#expand"+id).attr("src","./img/cross.png"); 
}
	jQuery('#descr'+id).toggle(500);
}