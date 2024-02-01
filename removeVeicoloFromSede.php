<!-- FILE PHP PER RIMOZIONE VEICOLO DAL DATABASE -->

<?php
    session_start();
    require_once("check.php");
    
    adminCheck();
    
    require_once("PHPconfig/config.php");

    $IDVeicolo = $_GET['ID'];

    $deleteQuery = "DELETE FROM Veicolo WHERE IDVeicolo = $IDVeicolo;";

    if ( $connessione->query($deleteQuery) ) {

        header("location:adminManagementPage.php?success=Veicolo con ID $IDVeicolo rimosso con successo");
        exit();
        
    } else {

        header("location:adminManagementPage.php?error=Veicolo non rimosso: $connessione->error");
        exit();

    }

?>

