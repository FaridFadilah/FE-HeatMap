var map = L.map('map').setView([-6.917008029115489, 107.61900716418606], 12);
var markers = [], loc = [];

/* API */
const BASE_URL = 'https://f632-113-11-180-58.ap.ngrok.io';
const ALLHEATMAP = `${BASE_URL}/api/allheatmap`;
const CREATE = `${BASE_URL}/api/create`;
let isLoading = false

/* Elements */
const btn = document.querySelector('#submit');
const form = document.querySelector('#handleForm');

async function fetchApi(link) {
    let object = await fetch(link);
    let value = await object.json();
    loading = true

    loc = value.data.map((d) => [d.latitude, d.longitude, d.price]);
    for (i = 0; i < loc.length; i++) {
        loading = false
        L.marker([loc[i][0], loc[i][1]])
            .bindPopup('Price : ' + loc[i][2])
            .addTo(map);
    }
}

function onClickMap(e) {
    if (markers.length > 0) {
        markers[0].remove();
        markers = [];
    }

    const latitudeElement = document.getElementById('lat');
    const longitudeElement = document.getElementById('long');

    latitudeElement.value = e.latlng.lat;
    longitudeElement.value = e.latlng.lng;

    const newMarker = new L.Marker([e.latlng.lat, e.latlng.lng]);
    newMarker.addTo(map);
    markers.push(newMarker);
}

btn.addEventListener('click', (e) => {
    e.preventDefault();
    const formData = new FormData(form);

    formData.append('harga', document.querySelector('#price').value);
    formData.append('lat', document.querySelector('#lat').value);
    formData.append('long', document.querySelector('#long').value);

    fetch(CREATE, {
        method: 'POST',
        body: formData,
    })
        .then(res => res.json())
        .then(data => console.log(data));
});

map.on('click', onClickMap);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

fetchApi(ALLHEATMAP);