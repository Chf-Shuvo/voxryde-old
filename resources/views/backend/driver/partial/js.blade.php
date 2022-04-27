<script src="{{ asset('backend/vendors/scripts/core.js') }}"></script>
<script src="{{ asset('backend/vendors/scripts/script.min.js') }}"></script>
<script src="{{ asset('backend/vendors/scripts/process.js') }}"></script>
<script src="{{ asset('backend/vendors/scripts/layout-settings.js') }}"></script>
<script src="{{ asset('backend/vendors/scripts/dashboard.js') }}"></script>
@include('sweetalert::alert')
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
  // console.log(coordinatePromise);
  coordinatePromise.then(function(coordinates) {
    origin_query = JSON.stringify(coordinates.latitude + ',' + coordinates.longitude);
    let path = "{{ route('driver.location.update') }}";
    $.ajax({
      type: "get",
      url: path,
      data: {
        'lat': coordinates.latitude,
        'long': coordinates.longitude
      },
      dataType: "json",
      success: function(response) {
        console.log(response);
      }
    });
  });
</script>
@stack('js')
