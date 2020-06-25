    var map = L.map('map', { zoomControl: false }).setView([43.77, 11.25], 5);
    new L.Control.Zoom({ position: 'topright' }).addTo(map);
    L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=BlBYhbJ1lYy0qQkYSJWE', {
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
        maxZoom: 18, minZoom: 2
    }).addTo(map);

    var popup = L.popup();

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent("You clicked the map at " + e.latlng.toString())
            .openOn(map);

        var obj, param, xmlhttp;

        obj = { "lat": e.latlng.lat,
                "lon": e.latlng.lng,
                "radius": 50,
                "limit": 10,
                "filters": {
                    "all": 0,
                    "humans": 1 ,
                    "buildings": 0 ,
                    "art": 0 ,
                    "business": 0
                } 
            };

        param = JSON.stringify(obj);
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("demo").innerHTML = this.responseText;
        }
        };
        xmlhttp.open("GET", "find_pages.php?x=" + param, true);
        xmlhttp.send();
    }

/*
    function showOnMap() {

        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            myObj = JSON.parse(this.responseText);
            for (x in myObj) {
            L.markers[x]([myObj[x].lat, myObj[x].lon]).addTo(map);
            L.markers[x].bindPopup(<a href="skkssk">myObj[x].title</a>).openPopup();
            }

        }
        };
    }
*/
    map.on('click', onMapClick);

