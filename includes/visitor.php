<?php
// Get visitor details
$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];

$apiurl = 'https://freegeoip.app/json/' . $ip;
$ch = curl_init($apiurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$apiResponse = curl_exec($ch);
curl_close($ch);
$ipData = json_decode($apiResponse, true);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_mark_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert visitor details into database
if (!empty($ipData)) {
    $country_code = $ipData['country_code'];
    $country_name = $ipData['country_name'];
    $region_code = $ipData['region_code'];
    $region_name = $ipData['region_name'];
    $city = $ipData['city'];
    $zip_code = $ipData['zip_code'];
    $latitude = $ipData['latitude'];
    $longitude = $ipData['longitude'];
    $time_zone = $ipData['time_zone'];

    $sql = "INSERT INTO visitor_tracking (address, agent, latitude, longitude, country_name, region_name, city, zip_code, time_zone)
            VALUES ('$ip', '$agent', '$latitude', '$longitude', '$country_name', '$region_name', '$city', '$zip_code', '$time_zone')";

    if ($conn->query($sql) === TRUE) {
        echo "Visitor details recorded successfully.";
    } else {
        echo "Error recording visitor details: " . $conn->error;
    }
}

$conn->close();
?>
