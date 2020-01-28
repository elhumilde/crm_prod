$(document).ready(function() {
	//function initialize() {
	    var myLatlng = new google.maps.LatLng(31.79170,  -7.09262);
	    var myOptions = {
	      zoom: 6,
	      center: myLatlng,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    }

	    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	    addMarker(myLatlng, 'Default Marker', map);

	    google.maps.event.addListener(map,'click',function(event) {
	        addMarker(event.latLng, 'Click Generated Marker', map);
	    });
	//}


	function addMarker(latlng,title,map) {
	    var marker = new google.maps.Marker({
	            position: latlng,
	            map: map,
	            title: title,
	            draggable:true
	    });
		var infowindow = new google.maps.InfoWindow({
						content: '<form id="myForm" action="fichier.php" method="post" target="_blank">'+
					'<div>'+
						'<label for="titre">Titre :</label>'+
						'<input type="text" name="titre" id="titre" />'+
					'</div>'+
					'<div>'+
						'<label for="comm">Commentaire :</label>'+
						'<textarea name="comm" id="comm"></textarea>'+
					'</div>'+
					'<div >'+
						'<input type="submit" id="envoyer" value="Envoyer" />'+
					'</div>'+
					'</form>',
						maxWidth: 310
					  });

		marker.addListener('click', function() {
						infowindow.open(map, marker);
					  });

	    google.maps.event.addListener(marker,'drag',function(event) {
	        document.getElementById('tts_equipement_x').value = event.latLng.lat();
	        document.getElementById('tts_equipement_y').value = event.latLng.lng();
	    });

	    google.maps.event.addListener(marker,'dragend',function(event) {
	        document.getElementById('tts_equipement_x').value = event.latLng.lat();
	        document.getElementById('tts_equipement_y').value = event.latLng.lng();
			var $lati = event.latLng.lat();
			var $longitude = event.latLng.lng();
			$.ajax({
							url: "fich.php",
							type: "post",
							data: 'lati='+$lati+'&longitude='+$longitude,
							dataType: 'json',
							success: function(json) {
								if(json.reponse == 'ok') {
									alert('Tout est bon');
								} else {
									alert('Erreur : '+ json.reponse);
								}
							}
						});
	    });					
	}


	});  
