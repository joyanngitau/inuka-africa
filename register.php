<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user's location is within the allowed area
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    
    if (isLocationWithinBoundaries($latitude, $longitude)) {
        // Location is within the allowed area, proceed with registration
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Establish a database connection (replace with your database credentials)
        $connection = new mysqli("localhost", "root", "", "inuka-africa");

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Prepare and execute the SQL query to insert user data into the database
        $query = "INSERT INTO usersjs (username, email, password, latitude, longitude) VALUES ('$username', '$email', '$password', $latitude, $longitude)";

        if ($connection->query($query) === true) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $query . "<br>" . $connection->error;
        }

        $connection->close();
    } else {
        // Location is outside the allowed area, inform the user
        echo "Registration failed. You are outside the registration area.";
    }

    echo '<script>
    alert("Registration successful! You will be redirected to the home page.");
    window.location.href = "index.html";
</script>';
exit; 
}

function isLocationWithinBoundaries($latitude, $longitude) {
    // Define geofencing boundaries
    $minLat = -4.0;
    $maxLat = 4.0;
    $minLng = 33.0;
    $maxLng = 42.0;

    return ($latitude >= $minLat && $latitude <= $maxLat && $longitude >= $minLng && $longitude <= $maxLng);
}
?>
