<!-- FILE PHP PER DEFINIZIONE FUNZIONE DI CHECK CHE CONTROLLA I DIRITTI UTENTE E RESPONSABILE -->

<!-- IN PARTICOLARE E' NECESSARIO, PER ALCUNE PAGINE, ESSERE SICURI CHE SI POSSA ACCEDERE AL CONTENUTO O ALLO SCRIPT PHP -->

<?php
    if (session_status() == PHP_SESSION_NONE) {

        session_start();
    }
    
    function check(){
        
        if ( (!isset($_SESSION['private'])) ) {

            header("location: index.php");
            exit();
        }
    }

    function adminCheck(){

        check();

        if ( $_SESSION['private'] != 2 ) {

            header("location: index.php");
            exit();
        }
    }

    function userCheck(){

        check();

        if ( $_SESSION['private'] != 1 ) {

            header("location: index.php");
            exit();
        }
    }

?>