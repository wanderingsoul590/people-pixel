<?php

// find wifi ip by comaand 
// : networksetup -getinfo Wi-Fi

function isConnectedToWifi() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }

    echo $ipAddress;

    // Define your Wi-Fi network's IP address or IP range
    $allowed_ip = ['106.203.212.51'];

    // Check if the visitor's IP address matches the allowed IP
    if (in_array($ipAddress, $allowed_ip)) {
        return true;
    } else {
        return false;
    }
}
