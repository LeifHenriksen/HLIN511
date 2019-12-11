function click_etoile(etoile_id)
{
    $('document').ready(function (){
	let res   = etoile_id.split("_");
	let id_ev = res[3];
	let note  = res[1];
	/*
	console.log(id_ev);
	console.log(note);
	console.log($('#'+etoile_id).attr('class'));
	*/
	for(let i = 1; i<6; i++)
	{
	    $('#'+res[0]+'_'+i+'_'+res[2]+'_'+res[3]).removeClass('checked');
	}

	for(let i = 1; i<=note; i++)
	{
	    $('#'+res[0]+'_'+i+'_'+res[2]+'_'+res[3]).addClass('checked');
	}

	$.ajax({
	    method: "GET",
	    url: "../scripts/rating.php",
	    data: { id_ev : id_ev, note : note }
	})
	    .done(function( msg ) {
		alert(msg);
	    });
    });
}
