<!-- FILE PHP PER SVUOTARE CARRELLO UTENTE -->

<?php
    require_once("PHPconfig/config.php");
    require_once("check.php");

    session_start();

    userCheck();

    $idUtente = $_GET['idUtente'];

    // Verifica se l'elemento esiste nel carrello prima di eliminarlo
    $checkQuery = "SELECT 1 FROM CarrelloVeicoli WHERE IDUtente = $idUtente";
    $checkResult = mysqli_query($connessione, $checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {

        // L'elemento esiste nel carrello, procedi con la rimozione
        $deleteQuery = "DELETE FROM CarrelloVeicoli WHERE IDUtente = $idUtente";
        $deleteResult = mysqli_query($connessione, $deleteQuery);

        if ($deleteResult) {

            echo "Veicoli rimossi";

        } else {

            echo "Errore nella rimozione: " . $connessione->error;

        }

    } else {

        echo "L'elemento non esiste nel carrello.";

    }


    // Verifica se l'elemento esiste nel carrello prima di eliminarlo
    $checkQuery = "SELECT 1 FROM CarrelloSkipper WHERE IDUtente = $idUtente";
    $checkResult = mysqli_query($connessione, $checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {

        // L'elemento esiste nel carrello, procedi con la rimozione
        $deleteQuery = "DELETE FROM CarrelloSkipper WHERE IDUtente = $idUtente";
        $deleteResult = mysqli_query($connessione, $deleteQuery);

        if ($deleteResult) {

            echo "Skipper rimossi";

        } else {

            echo "Errore nella rimozione: " . $connessione->error;

        }

    } else {

        echo "L'elemento non esiste nel carrello.";

    }

    // SVUOTIAMO GLI ARRAY
    $_SESSION["Veicoli"] = array();
    $_SESSION["Skipper"] = array();
    $_SESSION["minSkipper"] = 0;

    unset($_SESSION['carrello']);
    
    // VEDIAMO SE SIAMO STATI REINDIRIZZATI QUI DA setFilters.php
    if( isset($_GET['svuota'])) {

        header("location:userReservation.php?success=Filtri applicati correttamente");
        exit();

    } else {

        header("location:userReservation.php?success=Carrello svuotato");
        exit();
    }
?>

