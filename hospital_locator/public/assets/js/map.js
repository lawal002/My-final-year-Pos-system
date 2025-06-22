let map;
let infoWindow;
let directionsService;
let directionsRenderer;

function initMap() {
  infoWindow = new google.maps.InfoWindow();
  directionsService = new google.maps.DirectionsService();
  directionsRenderer = new google.maps.DirectionsRenderer();

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
  });
  directionsRenderer.setMap(map);

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
      const pos = { lat: position.coords.latitude, lng: position.coords.longitude };
      map.setCenter(pos);
      loadHospitals(pos);
    }, () => handleLocationError(true));
  } else {
    handleLocationError(false);
  }

  document.getElementById('keyword').addEventListener('keyup', e => {
    const keyword = e.target.value;
    if (keyword.length > 2) {
      fetchHospitals({ keyword });
    }
  });
}

function handleLocationError(browserHasGeolocation) {
  const message = browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.';
  infoWindow.setPosition(map.getCenter());
  infoWindow.setContent(message);
  infoWindow.open(map);
}

function loadHospitals(position) {
  fetchHospitals({ lat: position.lat, lng: position.lng });
}

function fetchHospitals(params) {
  const query = new URLSearchParams(params).toString();
  fetch('search.php?' + query)
    .then(res => res.json())
    .then(data => {
      clearMarkers();
      data.forEach(hospital => addHospitalMarker(hospital));
    });
}

let markers = [];
function addHospitalMarker(hospital) {
  const position = { lat: parseFloat(hospital.latitude), lng: parseFloat(hospital.longitude) };
  const marker = new google.maps.Marker({
    position,
    map,
    title: hospital.name
  });
  markers.push(marker);
  marker.addListener('click', () => {
    infoWindow.setContent(`<strong>${hospital.name}</strong><br>${hospital.address}<br><button class="btn btn-sm btn-primary mt-2" onclick="routeTo(${hospital.latitude}, ${hospital.longitude})">Directions</button>`);
    infoWindow.open(map, marker);
  });
}

function clearMarkers() {
  markers.forEach(m => m.setMap(null));
  markers = [];
}

function routeTo(lat, lng) {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
      const start = { lat: position.coords.latitude, lng: position.coords.longitude };
      const end = { lat, lng };
      directionsService.route({
        origin: start,
        destination: end,
        travelMode: 'DRIVING'
      }, (response, status) => {
        if (status === 'OK') {
          directionsRenderer.setDirections(response);
          const leg = response.routes[0].legs[0];
          document.getElementById('results').innerHTML = `Distance: ${leg.distance.text}, Duration: ${leg.duration.text}`;
        }
      });
    });
  }
}

document.addEventListener('DOMContentLoaded', initMap);
