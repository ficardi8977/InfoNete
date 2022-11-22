function loadMap() {

    var posicionX = document.getElementById("coordenadasX");
    var posicionY = document.getElementById("coordenadasY");
    var map;
    var flag = 0;

    var mapOptions = {
        zoom: 12,
        panControl: false,
        zoomControl: true,
        scaleControl: false,
        mapTypeControl: false,
        streetViewControl: true,
        overviewMapControl: true,
        rotateControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    if (!posicionX.value || !posicionY.value) {
        mapOptions["center"] = new google.maps.LatLng(-34.6686986, -58.5614947);
        map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
    }
    else {
        mapOptions["center"] = new google.maps.LatLng(posicionX.value, posicionY.value);
        map = new google.maps.Map(document.getElementById("mapa"), mapOptions);
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(posicionX.value, posicionY.value),
            map:map
        });
    }

    // evento que detecta click derecho y te devuelve las coordendas x e y
    google.maps.event.addListener(map, "rightclick", (event) =>{
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();
        document.getElementById("coordenadasX").value = lat;
        document.getElementById("coordenadasY").value = lng;
        marker = marcador(lat, lng, marker);
    });

    function marcador(lat, lng, marker){
        if(!marker){
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                map: map
            });
            return marker;
        }
        else{
            marker.setPosition(new google.maps.LatLng(lat, lng));
            return marker;
        }
    }
}