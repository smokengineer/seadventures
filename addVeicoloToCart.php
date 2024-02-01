<!-- FILE PHP PER AGGIUNTA VEICOLO AL CARRELLO -->

<?php
    require_once("PHPconfig/config.php");
    require_once("check.php");
    
    if (session_status() == PHP_SESSION_NONE) {

        session_start();

    }
    
    userCheck();
    
    $idUtente = $_SESSION["IDUtente"];
    $IDVeicolo = $_GET['IDVeicolo'];

    $query =    "INSERT INTO CarrelloVeicoli (IDUtente, IDVeicolo)
                VALUES ($idUtente, $IDVeicolo)
                ON DUPLICATE KEY UPDATE IDUtente = IDUtente";
    
    $result = mysqli_query($connessione, $query);

    $_SESSION["Veicoli"][] = $IDVeicolo;
    
    // RIMUOVO EVENTUALI DUPLICATI
    $_SESSION["Veicoli"] = array_unique($_SESSION["Veicoli"]);

    if( isset($_GET['s']) )
        if( $_GET['s'] == 1 )
            $_SESSION["minSkipper"]++;

    header("location:userReservation.php");
?>
