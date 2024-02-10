<?php

$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];


$api_url = "https://ipinfo.io/$ip?token=your_token_here";
$api_response = file_get_contents($api_url);
$visitor_data = json_decode($api_response, true);

if ($visitor_data !== null) {
    // Extract relevant information
    $ip_address = $visitor_data['ip'];
    $city = $visitor_data['city'];
    $region = $visitor_data['region'];
    $country = $visitor_data['country'];
    $location = $visitor_data['loc'];
    $organization = $visitor_data['org'];
    $postal_code = $visitor_data['postal'];
    $timezone = $visitor_data['timezone'];

    $db_host = "localhost";
    $db_user = "your_username";
    $db_pass = "your_password";
    $db_name = "your_database_name";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO visitor (ip_address, agent, city, region, country, location, organization, postal_code, timezone) 
            VALUES ('$ip_address', '$agent', '$city', '$region', '$country', '$location', '$organization', '$postal_code', '$timezone')";

    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
else {
 //echo "Error: Unable to retrieve visitor data";
}


?>
