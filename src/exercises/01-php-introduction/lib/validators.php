<?php

function isValidEmail($email){
    $findAt   = '@';
    $findDot = '.';
    $atPos = strpos($email, $findAt);
    $dotPos = strpos($email, $findDot);

    if ($atPos and $dotPos === FALSE){
        echo 'Email is invalid';
    }
    else {
        echo 'Valid E-mail';
    }
}

?>