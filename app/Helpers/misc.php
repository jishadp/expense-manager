<?php

function shortNumber($number = null)
{
    if($number == 0) {
        $short = number_format($number,2);
    } elseif($number <= 999) {
        $short = number_format($number,2);
    } elseif($number < 100000) {
        $short = number_format($number/1000, 2).' K';
    } elseif($number < 1000000) {
        $short = number_format($number/100000, 2).' L';
    } elseif($number < 10000000) {
        $short =  number_format($number/100000, 2).' L';
    } elseif($number >= 10000000) {
        $short = number_format($number/10000000, 2).' Cr';
    }

   return $short;
}
?>
