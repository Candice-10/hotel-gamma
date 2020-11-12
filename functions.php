<?php

/**
 * Débugger une variable
 * @param mixed $var La variable à débugger
 * @param bool $stop Faire un die dans la fonction
 */
function debug($var, bool $stop = true) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    if ($stop) {
        die;
    }
}

function get_header() {
    require_once "layout/header.php";
}

function get_footer() {
    require_once "layout/footer.php";
}