<!-- FILE PHP PER RIMOZIONE VEICOLO DAL CARRELLO -->

<?php
    require_once("PHPconfig/config.php");
    require_once("check.php");
    
    session_start();

    userCheck();

    $IDUtente = $_SESSION["IDUtente"];
    $IDVeicolo = $_GET["IDVeicolo"];

    // Verifica se l'elemento esiste nel carrello prima di eliminarlo
    $checkQuery = "SELECT 1 FROM CarrelloVeicoli WHERE IDUtente = $IDUtente AND IDVeicolo = $IDVeicolo";
    $checkResult = $connessione->query($checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {


        // L'elemento esiste nel carrello, procedi con la rimozione
        $deleteQuery = "DELETE FROM CarrelloVeicoli WHERE IDUtente = $IDUtente AND IDVeicolo = $IDVeicolo";
        $deleteResult = $connessione->query($deleteQuery);

        if ($deleteResult) {

            echo "Elemento rimosso con successo.";

        } else {

            echo "Errore nella rimozione: " . $connessione->error;

        }


    } else {

        echo "L'elemento non esiste nel carrello.";

    }

    // RIMUOVIAMO L'ID DALL'ARRAY
    $_SESSION["Veicoli"] = array_diff($_SESSION["Veicoli"], array( $IDVeicolo ));


    if( isset($_GET['s']) )
        if( $_GET['s'] == 1 )
            $_SESSION["minSkipper"]--;

    header("location:userReservation.php");
?>

