<?php
    // arranca una sesion
    session_start();
    // asigna una array vacion que solapara el contenido de $_SESSION
    $_SESSION = array();
    // destruye la sesion 
    session_destroy();
    // cuando se cierra la sesion vuelve a index.html
    header("Location: ../index.html");

// si solo contine codigo php es recomendable no cerra la etiqueta