var carte = L.map('map').setView([43.610769, 3.876716], 13);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 20,
    minZoom: 8,
    id: 'mapbox/streets-v11',
    accessToken: 'sk.eyJ1IjoiYXplbnRpYSIsImEiOiJjazQybmJkOHUwMHFuM29wanhsOGd5MG94In0.rYTy8hjTUqYno_0StjrU9w'
}).addTo(carte);

var marker = L.marker();

carte.on('click', onMapClick);

function onMapClick(e) {
    marker.setLatLng(e.latlng);
    marker.addTo(carte);
    document.getElementById("inputLat").value = e.latlng.lat;
    document.getElementById("inputLon").value = e.latlng.lng;
    addrByPositionOnMap(e.latlng.lat, e.latlng.lng);
}


function addrByPositionOnMap(lat, lon) {
    jQuery.getJSON('http://nominatim.openstreetmap.org/reverse?format=json&addressdetails=1&lat=' + lat + '&lon=' + lon, function(data) {
        var adress = data.address;
        typeof(adress.city) !== 'undefined' ? document.getElementById("ville").value = adress.city: document.getElementById("ville").value = adress.county;
        typeof(adress.postcode) !== 'undefined' ? document.getElementById("codePostal").value = adress.postcode: document.getElementById("codePostal").value = '';
        typeof(adress.road) !== 'undefined' ? document.getElementById("nomRue").value = adress.road: document.getElementById("nomRue").value = '';
        typeof(adress.house_number) !== 'undefined' ? document.getElementById("numRue").value = adress.house_number: document.getElementById("numRue").value = '';
    });
}