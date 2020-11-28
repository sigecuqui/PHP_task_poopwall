<?php

/**
 * Generate navigation depending on login status
 *
 * @return array|string[]
 */
function nav(): array
{
    if (is_logged_in()) {
        return [
            'HOME' => '/index.php',
            'MY POOPIE' => '/admin/my.php',
            'ADD' => '/admin/add.php',
            'LOGOUT' => '/logout.php',
        ];
    } else {
        return [
            'HOME' => '/index.php',
            'LOGIN' => '/login.php',
            'REGISTER' => '/register.php',
        ];
    }
}


