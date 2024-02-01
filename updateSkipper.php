<!-- FILE PHP PER AGGIORNAMENTO DATI SKIPPER -->

<?php
    require_once("PHPconfig/config.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /////////////////////////////////////////////////////////////////////////////
        // CAMPI DA AGGIORNARE
        
        $nome           = $connessione->real_escape_string($_POST['nome']);
        $nome           = trim($nome);

        $cognome        = $connessione->real_escape_string($_POST['cognome']);
        $cognome        = trim($cognome);

        $descrizione    = $connessione->real_escape_string($_POST['descrizione']);
        $descrizione    = trim($descrizione);

        $costo          = $connessione->real_escape_string($_POST['costo']);
        $costo          = floatval( $costo );

        $esperienza     = $connessione->real_escape_string($_POST['esperienza']);

        $datanascita    = $connessione->real_escape_string($_POST['datanascita']);

        $IDSkipper      =  $connessione->real_escape_string($_POST['IDSkipper']);
    

        $queryUpdate =  
            "UPDATE Skipper SET 
            Nome = '$nome', 
            Cognome = '$cognome', 
            Descrizione = '$descrizione', 
            CostoGiornaliero = $costo,
            Esperienza = $esperienza,
            DataNascita = '$datanascita'

            WHERE IDSkipper = $IDSkipper";
            
        if ( $connessione->query($queryUpdate) ) {

            header("location:adminManagementPage.php?success=Modifiche salvate con successo");
            exit();

        } else {

            header("location:adminManagementPage.php?error=Errore durante l'aggiornamento");
            exit();
        }

        $connessione->close();
    }

?>
