//------------------------------------
//
//	JQUERY.GMAP.JS
//	Author: 	Digital One
//	Requires:	jquery 1.6
//	Version:	1
//		
//------------------------------------

(function($){
	
$.fn.gmap = function(options){
	
	var defaults = {
		markers: [{'latitude': 51.490405,'longitude': -0.232193,'name': 'London','content': 'Argentum<br />2 Queen Caroline Street<br />Hammersmith<br />London<br />W6 9DX'}],
		markerFile:  'marker.png',
		markerWidth:97,
		markerHeight:95,
		markerAnchorX:45,
		markerAnchorY:86,
		centerLat:0,
		centerLng:0,
		zoom: 15,
		mapType: 'ROADMAP',
		travelMode: 'DRIVING',
		route: false,
		scrollwheel: false,
		draggable: false,
		routeWayPoints: [],
		routeOrigin: [],
		routeDestination: []
		};
	
	var options = $.extend(defaults,options);
	return this.each(function(){
		
		var $this = $(this);
		var $id = $(this).attr('id');
		var centerLat;
		var centerLng;
		var latlng;
		var bounds;
		var waypoint;
		

		if(options.centerLat==0){
			centerLat = options.markers[0].latitude
		} else {
			centerLng = options.centerLat;
		}
		if(options.centerLng==0){
			centerLng = options.markers[0].longitude
		} else {
			centerLng = options.centerLng;
		}
		//Set the map
			var bounds = new google.maps.LatLngBounds();
		latlng = new google.maps.LatLng(centerLat,centerLng);
		var mapOptions = {
				zoom: options.zoom, // This number can be set to define the initial zoom level of the map
				center: latlng,
				scrollwheel: false,
				draggable: false,
				mapTypeId: eval('google.maps.MapTypeId.'+ options.mapType),// This value can be set to define the map type ROADMAP/SATELLITE/HYBRID/TERRAIN
				//styles: [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":40}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-10},{"lightness":30}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":10}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":60}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]}]
				styles: [{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#333333"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#333333"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}]
			};
		var map = new google.maps.Map(document.getElementById($id),mapOptions);
		
		if(options.route){
			var rendererOptions = { map: map };
   			directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
   			
   			
   			for(var i=0;i<options.routeWayPoints.length;i++){
   				
				eval("var point"+(i+1)+" = new google.maps.LatLng("+options.routeWayPoints[i]['lat']+","+options.routeWayPoints[i]['lng']+")");
			bounds.extend(eval('point'+(i+1)));
   			}
   			var wps = [{location: point1},{location: point1},{location: point1}];
   			
   			 var org = new google.maps.LatLng ( options.routeOrigin[0]['lat'],options.routeOrigin[0]['lng']);
   			 bounds.extend(org);

   			 var dest = new google.maps.LatLng ( options.routeDestination[0]['lat'],options.routeDestination[0]['lng']);
   			 bounds.extend(dest);

   			 var request = { origin: org, destination: dest, waypoints: wps, travelMode: eval('google.maps.DirectionsTravelMode.'+options.travelMode)};
   			 directionsService = new google.maps.DirectionsService();
   			 directionsService.route(request, function(response, status) { 
    		if (status == google.maps.DirectionsStatus.OK) { 
      		directionsDisplay.setDirections(response);
    		} else {
    			alert ('failed to get directions');
    		}
    		
  			});

   			 map.fitBounds(bounds);
		} else {

		// Define Marker properties
		var markerImage = new google.maps.MarkerImage(
		options.markerFile,
		new google.maps.Size(options.markerWidth,options.markerHeight), // size of marker
		new google.maps.Point(0,0), // origin for marker
		new google.maps.Point(options.markerAnchorX,options.markerAnchorY) // anchor for marker
		);

		for(var i=0;i<options.markers.length;i++){		// Add the marker
		var marker = new google.maps.Marker({
		position: new google.maps.LatLng(options.markers[i].latitude,options.markers[i].longitude),
		map: map,
		icon: markerImage
		})
 		bounds.extend(marker.position);
		var infowindow = new google.maps.InfoWindow({
		content: createInfo(options.markers[i].name,options.markers[i].content)
		});
		
		//listener to make sure same state is shown when closing and reopening fancybox
		google.maps.event.addListener(map, 'tilesloaded', function() {
    	google.maps.event.trigger(map, 'resize');
    	if(options.markers.length>1){
    		map.fitBounds(bounds);
    	}
    	
});

		/* Add listener for a click on the pin */
		google.maps.event.addListener(marker, 'click', makeInfoWindowEvent(map, infowindow, marker));
		}
		if(options.markers.length>1){
    		map.fitBounds(bounds);
    	}
}
		function createInfo(title,content){
			return '<div class="infowindow" style="width:300px; height:auto;"><strong>'+ title +'</strong><br />'+content+'</div>';
		}

		function makeInfoWindowEvent(map, infowindow, marker) {  
		   return function() {  
		      infowindow.open(map, marker);
		   };  
		}
		
			

	
	//

	
})

	
}
})(jQuery);