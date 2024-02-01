<!-- FILE PHP DI IMPOSTAZIONE FILTRI DI RICERCA -->

<?php
    require_once("PHPconfig/config.php");
    session_start();

    $user = null;
    $DataInizio = null;
    $DataFine = null;

    // QUESTI DUE VETTORI DI SESSIONE SERVONO SOLO A FARE PICCOLI CONTROLLI 
    // AD ESEMPIO SUI PULSANTI DI AGGIUNTA AL CARRELLO DI VEICOLI E SKIPPER

    // ANCHE NEL CASO IN CUI NON CI FOSSERO QUESTI CONTROLLI (O NON DOVESSERO FUNZIONARE)
    // NEL MOMENTO DELL'AGGIUNTA AL CARRELLO CI SONO I CONTROLLI EFFETTUATI DIRETTAMENTE SUL DATABASE

    // VEDI FILE getCart.php, addVeicoloToCart.php, addSkipperToCart.php, removeVeicoloFromCart.php, removeSkipperFromCart.php


    if(!isset($_SESSION["Veicoli"]))
        $_SESSION["Veicoli"] = array();

    if(!isset($_SESSION["Skipper"]))
        $_SESSION["Skipper"] = array();

    if(!isset($_SESSION["minSkipper"]))
        $_SESSION["minSkipper"] = 0;
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // IMPOSTO VARIABILE CHE INDICA CHE SONO STATI APPLICATI I FILTRI (CONTROLLO EFFETTUATO SULLA PAGINA userReservation.php)
        $_SESSION['filters'] = 1;
        
        //$user = $_SESSION['IDUtente']; // NON RICORDO MA SEMBRA CHE NON SERVA A NIENTE

        if( isset($_POST['DataInizio']) && $_POST['DataInizio'] !== '' ) {
            
            $_SESSION['DataInizio'] = $_POST['DataInizio'];
        }

        if( isset($_POST['DataFine']) && $_POST['DataFine'] !== '' ) {

            $_SESSION['DataFine'] = $_POST['DataFine'];
        }

        // VARIABILE SKIPPER SI/NO
        if( isset($_POST['skipperCheck']) ) 
            $_SESSION['skipperCheck'] = $_POST['skipperCheck'];
        else 
            unset($_SESSION['skipperCheck']);
      
        // VARIABILE SCELTA SEDE
        if( isset($_POST['IDSede']) )
            $_SESSION['IDSede'] = $_POST['IDSede'];

        // VARIABILE SCELTA TIPOLOGIA VEICOLO
        if( isset($_POST['IDTipo']) )
            $_SESSION['IDTipo'] = $_POST['IDTipo'];

        
        $_SESSION['resetCart'] = 1;

        header("location:userReservation.php?success=Filtri applicati correttamente");
    }
?>