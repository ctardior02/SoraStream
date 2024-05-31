<?php
    session_start();//el script se una a la sesion

    unset($_SESSION['precios']);

    /* Para cerrar la sesion es necesario borrar todas las variables de la sesion, para ello inicilizamos el array $_sesion */
    $_SESSION = array();

    /* Ademas se debe utilizar la funcion sesion_destroy() */
    session_destroy();

    /* finalmete el script lleva de nuevo al login: */
    header("Location: ./Login.php");

?>