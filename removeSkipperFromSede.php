<!-- FILE PHP PER RIMOZIONE SKIPPER DAL DATABASE -->

<?php
    session_start();
    require_once("check.php");
    
    adminCheck();

    require_once("PHPconfig/config.php");

    $IDSkipper = $_GET['ID'];

    $deleteQuery = "DELETE FROM Skipper WHERE IDSkipper = $IDSkipper;";

    if ( $connessione->query($deleteQuery) ) {

        header("location:adminManagementPage.php?success=Skipper con ID $IDSkipper rimosso con successo");
        exit();

    } else {

        header("location:adminManagementPage.php?error=Skipper non rimosso: $connessione->error");
        exit();

    }

?>

