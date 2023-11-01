document.addEventListener("DOMContentLoaded", function () {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            document.getElementById("latitude").value = latitude;
            document.getElementById("longitude").value = longitude;

            // Check if the user is within the allowed area
            if (isLocationWithinBoundaries(latitude, longitude)) {
                document.getElementById("locationStatus").innerHTML = "Location acquired. You are within the registration area.";
                document.getElementById("registerButton").removeAttribute("disabled");
            } else {
                document.getElementById("locationStatus").innerHTML = "Location acquired. You are outside the registration area. Registration is disabled.";
            }
        }, function (error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    document.getElementById("locationStatus").innerHTML = "User denied the request for location. Registration is disabled.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    document.getElementById("locationStatus").innerHTML = "Location information is unavailable. Registration is disabled.";
                    break;
                case error.TIMEOUT:
                    document.getElementById("locationStatus").innerHTML = "The request to get user location timed out. Registration is disabled.";
                    break;
                case error.UNKNOWN_ERROR:
                    document.getElementById("locationStatus").innerHTML = "An unknown error occurred. Registration is disabled.";
                    break;
            }
        });
    } else {
        document.getElementById("locationStatus").innerHTML = "Geolocation is not supported by your browser. Registration is disabled.";
    }
});

function isLocationWithinBoundaries(latitude, longitude) {
    // Define geofencing boundaries (adjust these to match your registration area)
    var minLat = -1.5;
    var maxLat = -0.5;
    var minLng = 36.0;
    var maxLng = 37.0;

    return latitude >= minLat && latitude <= maxLat && longitude >= minLng && longitude <= maxLng;
}
