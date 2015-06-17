var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];

function initialize() {
	// var centro = new google.maps.LatLng(-22.8661340, -47.2266390);
    var options = {
		zoom: 14,
		maxZoom: 20,
		minZoom: 12,
		center: new google.maps.LatLng(-15.823130, -47.905288),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
	    zoomControl: true,
	    zoomControlOptions: {
	        style: google.maps.ZoomControlStyle.SMALL,
	        position: google.maps.ControlPosition.LEFT_BOTTOM
	    },
		streetViewControl:true,
		scrollwheel: true,
		draggable: true,
		panControl:false,
		rotateControl:false,
		mapTypeControlOptions: {
			position:google.maps.ControlPosition.RIGHT_BOTTOM
		}
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
}

initialize();

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}
	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}

function carregarPontos() {
	
	$.getJSON('js/pontos_asa_sul.json', function(pontos) {
		
		var latlngbounds = new google.maps.LatLngBounds();
		
		var shadowImage = new google.maps.MarkerImage('img/icon_shadow.png', null, null, new google.maps.Point(10, 34));
			
		$.each(pontos, function(index, ponto) {
			
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
				title: ponto.Titulo,
				animation: google.maps.Animation.DROP,
				icon: ponto.Icone,
				shadow: shadowImage
			});
						
			var myOptions = {
				content: "<p>" + ponto.Descricao + "</p>",
				pixelOffset: new google.maps.Size(-150, 0),
				infoBoxClearance: new google.maps.Size(1, 1)
        	};

			infoBox[ponto.Id] = new InfoBox(myOptions);
			infoBox[ponto.Id].marker = marker;
			
			infoBox[ponto.Id].listener = google.maps.event.addListener(marker, 'click', function (e) {
				abrirInfoBox(ponto.Id, marker);
			});
			
			markers.push(marker);
			
			latlngbounds.extend(marker.position);
			
		});
		
		//var markerCluster = new MarkerClusterer(map, markers);
		var markerClusterer = new MarkerClusterer(map, markers, {
          maxZoom: 9,
          gridSize: 4
        });
	});
}

carregarPontos();