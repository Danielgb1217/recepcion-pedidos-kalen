<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//validar si el usuario esta autenticado

function isAuth(): void {       //Si noexiste la variable de sesion el usuario no esta autenticado y lo enruta a otro lado
    
    if(!isset($_SESSION['login'])){  //en login contorler se creo la variable de sesion login cuando se autentica queda en true

        header('Location:/');  //si no ha iniciado sesion se direcciona al inicio de sesion

    } 
}

function isAuthJS(): bool {       //Si noexiste la variable de sesion el usuario no esta autenticado y lo enruta a otro lado
    
    if(!isset($_SESSION['login'])){  //en login contorler se creo la variable de sesion login cuando se autentica queda en true

       // header('Location:/');  //si no ha iniciado sesion se direcciona al inicio de sesion
        return true;
    }else{
        return false;
    }
}


function isAdmin() {       //Si noexiste la variable de sesion el usuario no esta autenticado y lo enruta a otro lado
    
    if(!($_SESSION['admin'] === '1')){  //en login contorler se creo la variable de sesion login cuando se autentica queda en true
        header('Location:/nuestrosProductos');
    }
}