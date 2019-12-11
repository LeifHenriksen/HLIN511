function click_etoile(etoile_id)
{
    $('document').ready(function (){
	let res   = etoile_id.split("_");
	let id_ev = res[3];
	let note  = res[1];

	$.ajax({
	    method: "GET",
	    url: "../scripts/rating.php",
	    data: { id_ev : id_ev, note : note }
	})
	    .done(function(msg) {
			var reponse = JSON.parse(msg);
			console.log(reponse);
			if(reponse.status)
			{
				for(let i = 1; i<6; i++)
				{
				    $('#'+res[0]+'_'+i+'_'+res[2]+'_'+res[3]).removeClass('checked');
				}

				for(let i = 1; i<=note; i++)
				{
				    $('#'+res[0]+'_'+i+'_'+res[2]+'_'+res[3]).addClass('checked');
				}
				alert(reponse.message)
			}
			else
			{
				alert(reponse.message)
			}			
	    });
    });
}
