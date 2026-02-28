<?php 

function formatPhoneNumber($number) {
    $firstThree = substr($number, 0, 3);
    $secondThree = substr($number, 3, 3);
    $lastFour = substr($number, 6, 9);

    echo "+353 $firstThree $secondThree $lastFour";
}

?>