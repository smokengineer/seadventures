<!-- FILE DI LOGOUT PHP -->

<?php

    session_start();

    $_SESSION = array();                // SVUOTO I DATI MEMORIZZATI DELLA SESSIONE CORRENTE

    if (session_status() == PHP_SESSION_ACTIVE) { // SE LA SESSIONE E' ATTIVA LA TERMINA

        
        if ( !session_destroy() ) {

            echo "Errore durante la distruzione della sessione.";

        }
    }

    header("location: PHPdemo/demoLogOut.php");
?>
