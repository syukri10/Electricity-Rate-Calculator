<?php

function calculatePower($voltage, $current) {
    // Calculate power using the formula: Power (Wh) = Voltage (V) * Current (A)
    $power = $voltage * $current /1000;
    
    // Return the calculated power
    return $power;
}

Function calRate($currentRate){
    $rate = $currentRate/100;
    return $rate;
}

?>