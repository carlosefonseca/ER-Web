<?
global $c_lat;
global $c_lng;
global $zoom;
global $canEditMarkers;
<<<<<<< HEAD
iLog("<Map>");
=======
>>>>>>> 62f5d2252b428e533ffafa773842968fa47e686a
?>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAAXja6TyGWuD4IaWbzAXbvxSLjE9tukku2vkqMEHoc5mw6LJAEBRj_whLfeS6X4EmxvGFhH_BczregQ"></script>
<script type="text/javascript">

var selectedMarker;
var map;
var center;
var markers = new Object();

function initialize() {
  if (GBrowserIsCompatible()) {
<<<<<<< HEAD
    map = new google.maps.Map(document.getElementById("map_canvas"));
	center = new google.maps.LatLng(<? echo $c_lat;?>,<? echo $c_lng;?>);
    map.setCenter(center, <? echo isset($zoom)?$zoom:"13";?>);
	map.setUIToDefault();
	map.checkResize();
  }
}


function createMarkerAndPoint(map, lat, lng, id, nome, status, data) {
	if (lat == 0 || lng == 0) { 
		point = new google.maps.LatLng(<? echo $c_lat;?>,<? echo $c_lng;?>); 
	} else {
		point = new google.maps.LatLng(lat,lng); 
	}
	createMarker(map, point, id, nome, status, data, true);
}

// Creates a marker. If point === false, middle of map is used
function createMarker(map, point, id, nome, status, data) { createMarker(map, point, id, nome, status, data, true); }

function createMarker(map, point, id, nome, status, data, info) {
	// Set up our google.maps.MarkerOptions object
	markerOptions = { <? if ($canEditMarkers) echo "draggable: true"; ?> };
	if (point === false) { point = map.getCenter(); }
	var marker = new google.maps.Marker(point, markerOptions);
	marker.id = id;
	marker.status = status;
	marker.name = nome;

if (info) {
	google.maps.Event.addDomListener(marker, "click", function() {
=======
    map = new GMap2(document.getElementById("map_canvas"));
	center = new GLatLng(<? echo $c_lat;?>,<? echo $c_lng;?>);
    map.setCenter(center, <? echo isset($zoom)?$zoom:"13";?>);
	map.setUIToDefault();
  }
}

function createMarkerAndPoint(map, lat, lng, id, nome, status, data) {
	if (lat == 0 || lng == 0) { 
		point = new GLatLng(<? echo $c_lat;?>,<? echo $c_lng;?>); 
	} else {
		point = new GLatLng(lat,lng); 
	}
	createMarker(map, point, id, nome, status, data);
}

// Creates a marker
function createMarker(map, point, id, nome, status, data) {
	// Set up our GMarkerOptions object
	markerOptions = { <? if ($canEditMarkers) echo "draggable: true"; ?> };
	var marker = new GMarker(point, markerOptions);
	marker.id = id;
	marker.status = status;
	marker.name = nome;
	GEvent.addListener(marker, "click", function() {
>>>>>>> 62f5d2252b428e533ffafa773842968fa47e686a
//		marker.openInfoWindowHtml("<h3>#"+id+" - "+nome+"</h3>"+data);
		selectedMarker = id;
		$("span.ui-dialog-title").html(nome);
		$('#marker_dialg').dialog('open');
	});
	
<<<<<<< HEAD
	google.maps.Event.addDomListener(marker, "mouseover", function() {
=======
	GEvent.addListener(marker, "mouseover", function() {
>>>>>>> 62f5d2252b428e533ffafa773842968fa47e686a
		switch(status) {
			case "0": estado = "OK"; break;
			case "off": estado = "Desactivado"; break;
			default: estado = status+" erros!"; break;
		}
		marker.openInfoWindowHtml("<h3>#"+id+" - "+nome+"</h3>"+data);
	});

<<<<<<< HEAD
	google.maps.Event.addDomListener(marker, "mouseout", function() {
		map.closeInfoWindow();
	});

	google.maps.Event.addDomListener(marker, "dragstart", function() {
		map.closeInfoWindow();
	});
}
	google.maps.Event.addDomListener(marker, "dragend", function() { 
		updateLocation(this);
	});

=======
	GEvent.addListener(marker, "mouseout", function() {
		map.closeInfoWindow();
	});

	GEvent.addListener(marker, "dragstart", function() {
		map.closeInfoWindow();
	});

    GEvent.addListener(marker, "dragend", function() {
		$.ajax({
			type: "POST",
			url: "../common/actions.php",
			data: "action=updateMarker&id="+this.id+"&lat="+this.getLatLng().lat()+"&lng="+this.getLatLng().lng(),
			success: function (msg) {
				if (msg != "OK")
					alert("Erro ao guardar o marcador!\n\n"+msg);
			}
		})
    });
>>>>>>> 62f5d2252b428e533ffafa773842968fa47e686a
	markers[id] = marker;
//	displayMarker(map, marker);
	return marker;
}

<<<<<<< HEAD
function updateLocation(marker) {
	$.ajax({
		type: "POST",
		url: "../common/actions.php",
		data: "action=updateMarker&id="+marker.id+"&lat="+marker.getLatLng().lat()+"&lng="+marker.getLatLng().lng(),
		success: function (msg) {
			if (msg != "OK")
				alert("Erro ao guardar o marcador!\n\n"+msg);
		}
	})
}

=======
>>>>>>> 62f5d2252b428e533ffafa773842968fa47e686a
function displayMarker(map, marker) {
	if ((marker.constructor.toString().indexOf("Object") == -1) && (marker.constructor.toString().indexOf("Array") == -1)) { //Se marker é apenas um pobre coitado
		map.addOverlay(marker);
		marker.disableDragging();
		if (marker.status == "0") {
			marker.setImage("../common/css/markers/green.png");
		} else if (marker.status == "off") {
			marker.setImage("../common/css/markers/grey.png");
		} else {
			marker.setImage("../common/css/markers/red.png");
		}
	} else { //Se marker é um array/object
		var min_lat = 9999;
		var min_lng = 9999;
		var max_lat = -9999;
		var max_lng = -9999;
		for(i in marker) {
			map.addOverlay(marker[i]);
			marker[i].disableDragging();
			if (marker[i].status == "0") {
				marker[i].setImage("../common/css/markers/green.png");
			} else if (marker[i].status == "off") {
				marker[i].setImage("../common/css/markers/grey.png");
			} else {
				marker[i].setImage("../common/css/markers/red.png");
			}
			var pos = marker[i].getLatLng();
    		if (pos.lat() < min_lat) { min_lat = pos.lat(); }
    		if (pos.lat() > max_lat) { max_lat = pos.lat(); }
    		if (pos.lng() < min_lng) { min_lng = pos.lng(); }
    		if (pos.lng() > max_lng) { max_lng = pos.lng(); }
		}
		var c_lat = (max_lat + min_lat)/2;
		var c_lng = (max_lng + min_lng)/2;
		if(c_lat && c_lng) {
<<<<<<< HEAD
			center = new google.maps.LatLng(c_lat,c_lng);
=======
			center = new GLatLng(c_lat,c_lng);
>>>>>>> 62f5d2252b428e533ffafa773842968fa47e686a
			map.panTo(center);
		} else {
			map.returnToSavedPosition();
		}
	}
}


function reloadJardins() {
	$.ajax({
		type: "GET",
		url: "jardins.php",
		success: function (txt) {
<<<<<<< HEAD
			iLog("Ajaxing jardins");
			map.clearOverlays();
    		eval(txt);
    		displayMarker(map, markers);
		}
	})
}
function loadJardim(id) {
	markers = new Object();
	$.ajax({
		type: "GET",
		url: "jardins.php?id="+id,
		success: function (txt) {
=======
>>>>>>> 62f5d2252b428e533ffafa773842968fa47e686a
			map.clearOverlays();
    		eval(txt);
    		displayMarker(map, markers);
		}
	})
}
</script>

<div id="map_canvas" style="width: 100%; height: 100%"></div>
	
</div>

<script>
	initialize();
	$("body").unload(function () { GUnload(); });

<<<<<<< HEAD
</script>
<? iLog("</Map>"); ?>
=======
</script>
>>>>>>> 62f5d2252b428e533ffafa773842968fa47e686a
