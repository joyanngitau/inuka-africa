<?php
// Connect to the database (replace with your DB credentials)
$connection = new mysqli("localhost", "root", "", "inuka-africa");

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve form data
$username = $_POST['username'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Define geofencing boundaries
$minLat = -4.0; // Define your boundaries
$maxLat = 4.0;
$minLng = 33.0;
$maxLng = 42.0;

if ($latitude >= $minLat && $latitude <= $maxLat && $longitude >= $minLng && $longitude <= $maxLng) {
    // User location is within the allowed geofence
    // Proceed with registration
    // Insert user data into the database
    $query = "INSERT INTO users (username, latitude, longitude) VALUES ('$username', $latitude, $longitude)";
    if ($connection->query($query)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $connection->error;
    }
} else {
    // User is outside the allowed geofence
    echo "Location is outside the allowed area.";
}

// Close the connection
$connection->close();
?>
