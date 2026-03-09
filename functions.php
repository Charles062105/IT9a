<?php
// Function to validate numbers (Check for negative values)
function validateNumber($value) {
    if ($value < 0) {
        return false;
    }
    return true;
}

// Function to compute total
function computeTotal($price, $qty) {
    return $price * $qty;
}

// Function to redirect pages
function redirectPage($url) {
    header("Location: " . $url);
    exit();
}

// Function to check if value is negative (for permission request)
function isNegative($value) {
    return $value < 0;
}
?>