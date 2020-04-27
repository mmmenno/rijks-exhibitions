<?php

// first, create geojson

$orgswithcoords = array();
$otherorgs = array();

foreach ($wdimages['results']['bindings'] as $img) {

	if(strlen($img['coords']['value'])){
		$coords = str_replace(array("Point(",")"), "", $img['coords']['value']);
	}elseif(strlen($img['supercoords']['value'])){
		$coords = str_replace(array("Point(",")"), "", $img['supercoords']['value']);
	}else{
		if(isset($otherorgs[$img['collection']['value']])){
			$othercount = $otherorgs[$img['collection']['value']]['nr']  + 1;
		}else{
			$othercount = 1;
		}
		$otherorgs[$img['collection']['value']] = array(
			"name" => $img['collectionLabel']['value'],
			"url" => $img['article']['value'],
			"nr" => $othercount
		);
		continue;
	}

	if(isset($orgswithcoords[$img['collection']['value']])){
		$count = $orgswithcoords[$img['collection']['value']]['nr']  + 1;
	}else{
		$count = 1;
	}
	$latlon = explode(" ", $coords);
	$geometry = array("type"=>"Point","coordinates"=>array((double)$latlon[0],(double)$latlon[1]));
	$orgswithcoords[$img['collection']['value']] = array(
		"name" => $img['collectionLabel']['value'],
		"url" => $img['article']['value'],
		"nr" => $count,
		"geometry" => $geometry
	);
}

$fc = array("type"=>"FeatureCollection", "features"=>array());

foreach ($orgswithcoords as $k => $v) {

	$fc['features'][] = array(
		"type" => "Feature",
		"geometry" => $v['geometry'],
		"properties" => array(
			"name" => $v['name'],
			"url" => $v['url'],
			"nr" => $v['nr']
		)
	);

}

$geojson = json_encode($fc);


if(count($otherorgs)){
	$othertext = "Verder werk uit de collectie(s) ";
	foreach ($otherorgs as $k => $v) {
		if(strlen($v['url'])){
			$othertext  .= '<a target="_blank" href="' . $v['url'] . '">' . $v['name'] . '</a>';
		}else{
			$othertext  .= $v['name'];
		}
		$othertext  .= " (" . $v['nr'] . ") ";
	}
}


?>


<div id="map" style="margin-top: 24px; height: 250px; width: 100%;"></div>

<div id="otherorgs">
	<span id="clicked" style="font-weight: bold;"></span><?= $othertext ?>
</div>

<script>

	mapfeatures = JSON.parse('<?= $geojson ?>');

	$(document).ready(function() {
		createMap();
	});

  function createMap(){
    center = [52.381016, 4.637126];
    zoomlevel = 16;
    
    map = L.map('map', {
          center: center,
          zoom: zoomlevel,
          minZoom: 1,
          maxZoom: 20,
          scrollWheelZoom: true,
          zoomControl: false
      });

    L.control.zoom({
        position: 'bottomright'
    }).addTo(map);

    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
		subdomains: 'abcd',
		maxZoom: 19
	}).addTo(map);

    institutions = L.geoJson(null, {
		pointToLayer: function (feature, latlng) {                    
			return new L.CircleMarker(latlng, {
				color: "#D55140",
				radius:4,
				weight: 1,
				opacity: 0.8,
				fillOpacity: 0.8
			});
		},
		style: function(feature) {
			return {
			    radius: getSize(feature.properties),
			    clickable: true
			};
		},
		onEachFeature: function(feature, layer) {
			layer.on({
				click: whenClicked
			});
		}
	}).addTo(map);

	institutions.addData(mapfeatures).bringToFront();

	map.fitBounds(institutions.getBounds());

  }

  

	function getSize(props) {
		var i = props['nr'] * 4;
		if(i>40){
			return 40;
		}
		return i;
	}

	function whenClicked(){
		var props = $(this)[0].feature.properties;
		if(props['url']){
			var content = '<a target="_blank" href="' + props['url'] + '">' + props['name'] + '</a> (' + props['nr'] + '). '; 
		}else{
			var content = props['name'] + ' (' + props['nr'] + '). '; 
		}
		$("#clicked").html(content);
	}

</script>