<?php

/**
 * ####################
 * ###   VALIDATE   ###
 * ####################
 */

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $type
 * @return string
 */
function url(string $type = "html"): string {
    $wayHTML = str_replace("index.php", "", $_SERVER['PHP_SELF']);
    $wayPHP = "https://" . $_SERVER['HTTP_HOST'] . $wayHTML;
    
    $url = [
        "php" => $wayPHP,
        "html" => $wayHTML
    ];
    return !empty($url[$type]) ? $url[$type] : $url["html"]; 
}

function alert(): string {
    $alert = "";

    if (!empty($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        unset($_SESSION['alert']);
    }
    return $alert;
}
