<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Order Delivery Map</title>
  <style>
    html,
    body,
    #map,
    #map-canvas {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      position: absolute;
    }

  </style>
</head>

<body>
  <div id="map"></div>
  {{-- map Scripts --}}
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-KnRoUdTT4_xQ_xbyVkvXPoKUNTZptnE&libraries=places&callback=initMap" async defer></script>
  @if ($type == MapType::Pickup->value)
    <script>
      // get current position of the driver
      function getPosition() {
        "use strict";
        return new Promise(function(resolve, reject) {
          var coordinates = {
            latitude: null,
            longitude: null,
            error: false,
          }

          function success(pos) {
            coordinates.latitude = pos.coords.latitude;
            coordinates.longitude = pos.coords.longitude;
            resolve(coordinates);
          }

          function fail(error) {
            coordinates.error = true;
            resolve(coordinates); // or reject(error);
          }
          navigator.geolocation.getCurrentPosition(success, fail);
        });
      }
      var coordinatePromise = getPosition();
      var origin_query;
      coordinatePromise.then(function(coordinates) {
        origin_query = JSON.stringify(coordinates.latitude + ',' + coordinates.longitude);
        console.log(origin_query);
      });
      // now load the map to that location
      function initMap() {
        /* Current Location*/
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 120,
        });
        directionsService
          .route({
            origin: {
              query: origin_query,
            },
            destination: {
              query: "{{ $order->address }}",
            },
            travelMode: google.maps.TravelMode.DRIVING,
          })
          .then((response) => {
            directionsRenderer.setDirections(response);
          })
          .catch((e) =>
            window.alert("Directions request failed due to " + e)
          );
        directionsRenderer.setMap(map);
      }
    </script>
  @else
    <script>
      function initMap() {
        /* Current Location*/
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 120,
        });
        directionsService
          .route({
            origin: {
              query: "{{ $order->address }}",
            },
            destination: {
              query: "{{ $order->delivery_details->address }}",
            },
            travelMode: google.maps.TravelMode.DRIVING,
          })
          .then((response) => {
            directionsRenderer.setDirections(response);
          })
          .catch((e) =>
            window.alert("Directions request failed due to " + e)
          );
        directionsRenderer.setMap(map);
      }
    </script>
  @endif
</body>

</html>
