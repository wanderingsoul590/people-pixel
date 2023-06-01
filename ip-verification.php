<?php

// $visitor_ip = $_SERVER['REMOTE_ADDR'];
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
} else {
    $ipAddress = $_SERVER['REMOTE_ADDR'];
}

// Define your Wi-Fi network's IP address or IP range
$allowed_ip = ['192.168.176.5'];

// Check if the visitor's IP address matches the allowed IP
if ( !in_array($ipAddress, $allowed_ip)) {
    // Redirect or display an error message
    echo 'please connect to wifi i-value<br>';
    echo $ipAddress;
    exit();
}else{
    echo "thankyou ✅<br>";
    echo $ipAddress;
}