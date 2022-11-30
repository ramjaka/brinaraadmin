"use strict";

const addressInput  = document.getElementById("search_address");
const addressInMap  = document.getElementById("address_in_map");
const address_title = document.getElementById("address_title");
const address = document.getElementById("address");

const autocomplete = new google.maps.places.Autocomplete(addressInput,{types: ['(cities)']});

let geocoder;
let map;
let marker;

function createMarker(latLng) {
    if ( !! marker && !! marker.setMap) marker.setMap(null);
    marker = new google.maps.Marker({
        map: map,
        position: latLng,
        draggable: true
    });

    document.getElementById('lat').value = marker.getPosition().lat().toFixed(6);
    document.getElementById('lng').value = marker.getPosition().lng().toFixed(6);

    google.maps.event.addListener(marker, "dragend", function () {
        document.getElementById('lat').value = marker.getPosition().lat().toFixed(6);
        document.getElementById('lng').value = marker.getPosition().lng().toFixed(6);
    });
}

function initialize() {
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    codeAddress(new google.maps.LatLng(map.center.lat(), map.center.lng()));

    google.maps.event.addListener(map, 'click', function (event) {
        map.panTo(event.latLng);
        map.setCenter(event.latLng);

        createMarker(event.latLng);
        codeAddress(event.latLng);
    });
}

google.maps.event.addListener(autocomplete, 'place_changed', function(){
    const place = autocomplete.getPlace();

    codeAddress(place.geometry.location);
})

google.maps.event.addDomListener(window, 'load', initialize);

function codeAddress(latLng = null, location = null) {
    let options;

    if(latLng) {
        options = {
            'latLng': latLng,
            'address': location
        };
    } else {
        options = {
            'address': location
        };
    }

    geocoder.geocode(options, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            createMarker(results[0].geometry.location);

            addressInMap.value  = results[0].formatted_address;
            address_title.value = results[0].address_components[1].short_name;
            address.value = results[0].formatted_address;
        }
    });
}

$("#search_button").click(function (e) {
    codeAddress("", addressInput.value);
})
