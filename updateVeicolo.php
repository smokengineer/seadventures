<!-- FILE PHP PER AGGIORNAMENTO DATI VEICOLO -->

<?php
    require_once("PHPconfig/config.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /////////////////////////////////////////////////////////////////////////////
        // CAMPI DA AGGIORNARE
        
        $nome           = $connessione->real_escape_string($_POST['nome']);
        $nome           = trim( $nome );

        $descrizione    = $connessione->real_escape_string($_POST['descrizione']);
        $descrizione    = trim($descrizione);

        $tipo           = $connessione->real_escape_string($_POST['tipo']);

        $costo          = $connessione->real_escape_string($_POST['costo']);
        $costo          = floatval($costo);

        $IDVeicolo      =  $connessione->real_escape_string($_POST['IDVeicolo']);

        $SkipperSI = 0;
        if( isset($_POST['SkipperSI']) )
            $SkipperSI = 1;

        $queryUpdate =  
            "UPDATE Veicolo SET 
            Nome = '$nome', 
            Descrizione = '$descrizione', 
            CostoGiornaliero = $costo,
            IDTipo = '$tipo',
            SkipperSI = $SkipperSI
            
            WHERE IDVeicolo = $IDVeicolo";
            
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
