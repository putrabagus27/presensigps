<style>
    #map {
        height: 250px;
    }
</style>
<div id="address" style="margin-bottom: 2px;">

</div>
<div id="map">

</div>
<script>
    var lokasi = "{{ $presensi->lokasi_in }}";
    var lok = lokasi.split(",");
    var latitude = lok[0];
    var longitude = lok[1];
    var address = document.getElementById("address");
    var map = L.map('map').setView([latitude, longitude], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker = L.marker([latitude, longitude]).addTo(map);
    var circle = L.circle([-8.691342871668562, 115.21338703595138], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(map);
    var popup = L.popup()
        .setLatLng([latitude, longitude])
        .setContent("{{ $presensi->nama_lengkap }}")
        .openOn(map);
    $.getJSON('https://nominatim.openstreetmap.org/reverse', {
        lat: latitude,
        lon: longitude,
        format: 'jsonv2',
    }, function(hasil) {
        console.log(hasil);
        // var obj = JSON.parse(hasil.display_name);
        // console.log(hasil.display_name);
        var obj = JSON.stringify(hasil.display_name);
        console.log(hasil.display_name);
        address.innerHTML = "<p>Lokasi Alamat : " + hasil.display_name + "</p>";
    });
</script>