/* ------------------------------------------------------------------------------
*
*  # Basic markers
*
*  Specific JS code additions for maps_google_markers.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

	// Setup map
	function initialize() {

		// Set coordinates
		var myLatlng = new google.maps.LatLng(31.79170,  -7.09262);

		// Options
		var mapOptions = {
			zoom: 6,
			center: myLatlng
		};

		// Apply options
		var map = new google.maps.Map($('.map-marker-simple')[0], mapOptions);
		var contentString = '<div class="panel panel-flat">'+
								'<div class="panel-heading">'+
								'	<h6 class="panel-title">Rounded justified</h6>'+
								'	<div class="heading-elements">'+
								'		<ul class="icons-list">'+
					             '   		<li><a data-action="collapse"></a></li>'+
					              '  		<li><a data-action="reload"></a></li>'+
					               ' 		<li><a data-action="close"></a></li>'+
					                '	</ul>'+
				                	'</div>'+
								'<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>'+

								'<div class="panel-body">'+
								'	<div class="tabbable">'+
								'		<ul class="nav nav-tabs bg-slate nav-tabs-component nav-justified">'+
								'			<li class="active"><a href="#colored-rounded-justified-tab1" data-toggle="tab">Active</a></li>'+
								'			<li><a href="#colored-rounded-justified-tab2" data-toggle="tab">Inactive</a></li>'+
								'			<li class="dropdown">'+
								'				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>'+
								'				<ul class="dropdown-menu dropdown-menu-right">'+
								'					<li><a href="#colored-rounded-justified-tab3" data-toggle="tab">Dropdown tab</a></li>'+
								'					<li><a href="#colored-rounded-justified-tab4" data-toggle="tab">Another tab</a></li>'+
								'				</ul>'+
								'			</li>'+
								'		</ul>'+

'										<div class="tab-content">'+
'											<div class="tab-pane active" id="colored-rounded-justified-tab1">'+
'												For justified tabs use <code>.nav-justified .bg-* .nav-tabs-component</code> classes.'+
'											</div>'+

'											<div class="tab-pane" id="colored-rounded-justified-tab2">'+
'												Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.'+
'											</div>'+

'											<div class="tab-pane" id="colored-rounded-justified-tab3">'+
'												DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.'+
'											</div>'+

'											<div class="tab-pane" id="colored-rounded-justified-tab4">'+
									'			Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.'+
									'		</div>'+
									'	</div>'+
									'</div>'+
							'	</div>'+
							'</div>';
		
		////////////////////////
		
		/////////////////////////
		// Add info window
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});

		// Add marker
		var marker = new google.maps.Marker({
			position: myLatlng,
			map: map,
			title: 'Hello World!'
		});

		// Attach click event
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map,marker);
		});

	};

	// Initialize map on window load
	google.maps.event.addDomListener(window, 'load', initialize);

});
