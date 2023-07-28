<?php

if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $userLatitude = $_POST['latitude'];
    $userLongitude = $_POST['longitude'];

    $officeLatitude = 23.0216127;
    $officeLongitude = 72.5446393;


   // $officeLatitude = 23.031368104021166;
   // $officeLongitude = 72.51171621070604;

    $acceptableRadius = 5;


    $distance = haversineDistance($userLatitude, $userLongitude, $officeLatitude, $officeLongitude);

    $distanceInKilometers = round($distance / 1000, 2);

    if ($distance <= $acceptableRadius) {
        $response = array(
            "status" => "true",
            "distance" => $distanceInKilometers
        );
    } else {
        $response = array(
            "status" => "false",
            "distance" => $distanceInKilometers
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array(
        "status" => "false",
    );
}

function haversineDistance($lat1, $lon1, $lat2, $lon2) {
    $earthRadius = 6371000; // Radius of the Earth in meters
    $deltaLat = deg2rad($lat2 - $lat1);
    $deltaLon = deg2rad($lon2 - $lon1);

    $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($deltaLon / 2) * sin($deltaLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $earthRadius * $c;
}
