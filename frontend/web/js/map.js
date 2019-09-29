$(document).ready(function () {

        atmApiBaseUrl = 'http://127.0.0.1:20080/atm';

    $.ajax({
        "url": atmApiBaseUrl
    }).done(function (data) {
        renderMap(data);
    });


    function renderMap(mapCoordinates) {
        let mapOptions = {
                center: new google.maps.LatLng(mapCoordinates[0].latitude, mapCoordinates[0].longitude),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            },
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        for (let i = 1; i < mapCoordinates.length; i++) {
            let marker = new window.google.maps.Marker(
                {
                    position: {
                        "lat": mapCoordinates[i].latitude,
                        "lng": mapCoordinates[i].longitude
                    },
                    clickable: false,
                    map: map
                }
            );
        }
    }
});