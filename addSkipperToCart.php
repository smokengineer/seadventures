<!-- FILE PHP PER AGGIUNTA SKIPPER AL CARRELLO -->

<?php
    require_once("PHPconfig/config.php");
    require_once("check.php");
    
    session_start();
    
    userCheck();

    $IDUtente = $_SESSION["IDUtente"];
    $IDSkipper = $_GET['IDSkipper'];
    
    $query =    "INSERT INTO CarrelloSkipper (IDUtente, IDSkipper)
                VALUES ($IDUtente, $IDSkipper)
                ON DUPLICATE KEY UPDATE IDUtente = IDUtente";

    $result = mysqli_query($connessione, $query);

    $_SESSION["Skipper"][] = $IDSkipper;
    
    // RIMUOVO EVENTUALI DUPLICATI
    $_SESSION["Skipper"] = array_unique($_SESSION["Skipper"]);

    header("location:userReservation.php");
?>

