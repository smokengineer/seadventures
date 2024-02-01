<!-- FILE PHP PER RIMOZIONE SKIPPER DAL CARRELLO -->

<?php
    require_once("PHPconfig/config.php");
    require_once("check.php");
    
    session_start();

    userCheck();

    $IDUtente = $_SESSION["IDUtente"];
    $IDSkipper = $_GET['IDSkipper'];

    // Verifica se l'elemento esiste nel carrello prima di eliminarlo
    $checkQuery = "SELECT 1 FROM CarrelloSkipper WHERE IDUtente = $IDUtente AND IDSkipper = $IDSkipper";
    $checkResult = $connessione->query($checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {


        // L'elemento esiste nel carrello, procedi con la rimozione
        $deleteQuery = "DELETE FROM CarrelloSkipper WHERE IDUtente = $IDUtente AND IDSkipper = $IDSkipper";
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
    $_SESSION["Skipper"] = array_diff($_SESSION["Skipper"], array( $IDSkipper ));


    header("location:userReservation.php");
?>

