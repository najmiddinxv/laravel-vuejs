<?php
function compareProductNames($a, $b) {
    // Convert both strings to lowercase for consistent sorting
    $at = mb_strtolower($a, 'UTF-8');
    $bt = mb_strtolower($b, 'UTF-8');

    // Handle special characters (e.g., "o'" and "g'")
    $trans = [
        "o'" => 'o',
        "g'" => 'g',
        // Add more mappings as needed for other special characters
    ];

    // Replace special characters with their non-special equivalents
    $at = strtr($at, $trans);
    $bt = strtr($bt, $trans);

    // Compare the modified strings
    return strcmp($at, $bt);
}

$productNames = [
    'Apple',
    'Zebra',
    'Orange',
    'Grapes',
    'O\'Reilly', // Example with special character
    'G\'Store',  // Another example
];


//https://www.w3schools.com/php/func_array_usort.asp
uksort($productNames, 'compareProductNames');


// Now $productNames is sorted alphabetically, considering special characters
print_r($productNames);
