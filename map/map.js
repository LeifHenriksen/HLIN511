var map = new ol.Map({
  target: 'map',
  layers: [
  new ol.layer.Tile({
  source: new ol.source.OSM()})
  ],
    view: new ol.View({
      center: ol.proj.fromLonLat([3.87667, 43.611]),
      zoom: 11
    })
  });

function addmarker(nom,long,lat){
  console.log("addmarker");
  let image = $("#markerProto").clone();
        image.attr("id", "marker"+ nom);
        $("body").append(image);
        marker = new ol.Overlay({
        element: document.getElementById('marker'+nom),
        position: ol.proj.fromLonLat([long,lat]),
        });
          console.log(long);
         map.addOverlay(marker); 
         image.hide(); 
}

function ischecked(){
  $('body').on("change", "input[type=checkbox]", function() {
                                    //elever les espqces
  let valeur = $(this).attr('name').replace(/\s/g,'');
  console.log("selection de la case a cocher "+valeur);
  if ($(this).is(':checked')) { $("#marker" + valeur).show(); }
  else {  $("#marker" + valeur).hide(); }
  });
}

function addpopup(name,lon,lat,msg){
  let popup = $("#popupProto").clone();
  popup.attr("id", "popup"+name);
  popup.append("<p style='background-color: white;'>"+msg+"</p>");
  $("body").append(popup);
  console.log(popup.get(0));
  map.addOverlay(
  new ol.Overlay({position : ol.proj.fromLonLat([lon,lat]),
            element  : popup.get(0)
          }));
  popup.hide();
}

function onClick_marker(marker){
  console.log("#popup"+marker.id);
  let name = marker.id.replace("marker","");
  let popup = $("#popup"+name);
  if(popup.is(":hidden"))
  {
    popup.show();
  }
  else
  {
    popup.hide();
  }
}


$(document).ready(function (){
  var marker=null;;
  $.getJSON("themes.json",function(data){
    $.each( data, function( key, val ) {
     var br=document.createElement("br");
     var div_item= document.createElement("div");
     div_item.id = val["nom"];
     var h3 =document.createElement("h3");
     var textnode =document.createTextNode(val["nom"]);
      h3.append(textnode);
      $('#points_interet').append(h3);
      $('#points_interet').append(div_item);
     $.getJSON(val["lien"],function(data){
        $.each(data,function(key,objet){
        var new_textnode=document.createTextNode(objet["NOM_EVENT"]);
        var checkbox = document.createElement('INPUT');
        checkbox.type = "checkbox";
        checkbox.name = objet["NOM_EVENT"];
        $('#'+val.nom).append(new_textnode);
        $('#'+val.nom).append(checkbox);
        objet["NOM_EVENT"] = objet["NOM_EVENT"].replace(/\s/g,'');
        addmarker(objet["NOM_EVENT"],objet["LONGITUDE"],objet["LATITUDE"]);
        console
        addpopup(objet["NOM_EVENT"],objet["LONGITUDE"],objet["LATITUDE"],objet["DESCRIPTIF"]);
        console.log("#marker" + objet["NOM_EVENT"]);
       $("#marker"+ objet["NOM_EVENT"]).click(function(){onClick_marker(this);
       });
      });
      });
    });
         $('#points_interet').accordion({ icons: { "header": "ui-icon-plus", "activeHeader": "ui-icon-minus" }, collapsible: true, heightStyle: 'content'});
  });
});

//mapInit();
ischecked();
