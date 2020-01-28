<div class="row mt20">
	<label class="col-md-1 col-md-offset-1">X <?php echo $id; ?>:</label>
	<div class="col-md-2">
		<input type="text" class="form-control" <?php echo $form["x"]; ?> value="">
	</div>
	<label class="col-md-1 col-md-offset-1">Y :</label>
	<div class="col-md-2">
		<input type="text" class="form-control" <?php echo $form["y"]; ?> value="">
	</div>

</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div id="map_canvas" style="width:900px;height:600px;"></div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	//function initialize() {
	   <?php if($id):?>
	   var myLatlng = new google.maps.LatLng(
			                  document.getElementById('tts_equipement_x').value,
			                  document.getElementById('tts_equipement_y').value);
	   <?php endif; ?>
       <?php if(!$id): ?>
	         var myLatlng = new google.maps.LatLng(33.5718613,-7.6224174);
	   <?php endif; ?>
	    var myOptions = {
	      zoom: 6,
	      center: myLatlng,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    }

	    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	    addMarker(myLatlng, 'Default Marker', map);

	   
	//}


	function addMarker(latlng,title,map) {
	    var marker = new google.maps.Marker({
	            position: latlng,
	            map: map,
	            title: title,
	            draggable:true
	    });
		var infowindow = new google.maps.InfoWindow({
						content: 'contnue',
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

</script>