<!-- FILE PHP PER DEFINIZIONE FUNZIONE DI ALERT -->

<?php

// DEFINIAMO QUI LA FUNZIONE DI ALERT PER ESSERE SICURI DI IMPORTARLA PER TUTTE LE PAGINE
    
    function alert() {

    /*
        AVREI POTUTO IMPLEMENTARE DEI CODICI DI ERRORE A CUI ASSOCIARE UN MESSAGGIO TESTUALE
        
        switch ($_GET['error']) {

            case '1':
                $code = "ERRORE 1";
                break;
            
            default:
                $code = "ERRORE GENERICO";
                break;

        }
    */

        if( isset($_GET['error']) ){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.htmlspecialchars($_GET['error']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_GET['error']);
        }

        if( isset($_GET['success']) ){
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">'.htmlspecialchars($_GET['success']);
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
            unset($_GET['success']);
        }

    }

?>