let lat = 13.6739993;
let log = -89.2788287;
var map = L.map("mapid", {center: [lat, log], zoom: 16});

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    'Map & Data © <a href="http://openstreetmap.org">OpenStreetMap</a>',
  maxZoom: 18,
}).addTo(map);

var marker = L.marker([lat, log], {
  icon: L.AwesomeMarkers.icon({
    icon: "skyatlas",
    markerColor: "cadetblue",
    prefix: "fa",    
  })
}).addTo(map);

let bodyMarker = '<p style="text-align: center;font-size: small;"><i class="fab fa-skyatlas"></i>&nbsp<span class="text-uppercase font-weight-bold">Oficinas CloudMind</span> <br> Elige, Aprende, Disfruta. </p>';

marker.bindPopup(bodyMarker).openPopup();

$(".awesome-marker").find("i").removeClass();
$(".awesome-marker").find("i").addClass("fab fa-skyatlas icon-white");