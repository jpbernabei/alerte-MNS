<?php

function valid_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function valid_password($password) {
    $longueurMin = 8;
    $contientMajuscule = false;
    $contientChiffre = false;

    if (strlen($password) < $longueurMin) {
        return false;
    }

    for ($i = 0; $i < strlen($password); $i++) {
        $caractere = $password[$i];
// vérifie si un caractère est une majuscule
        if (ctype_upper($caractere)) {
            $contientMajuscule = true;
// vérifie si un caractère est un chiffre
        } elseif (ctype_digit($caractere)) {
            $contientChiffre = true;
        }

        if ($contientMajuscule && $contientChiffre) {
            return true;
        }
    }

    return false;
}
?>