<?php 

function truncate($text, $length) {
        echo substr($text, 0, $length);
    }


function formatPrice($amount) {
    echo "€$amount";
}

function getCurrentYear() {
    echo "2026";
}

?>