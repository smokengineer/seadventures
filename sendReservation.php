<!-- FILE PHP DI CONFERMA PRENOTAZIONE -->

<?php
    require_once("PHPconfig/config.php");

    session_start();

    $IDUtente       = $_SESSION['IDUtente'];
    $DataInizio     = $_SESSION['DataInizio'];
    $DataFine       = $_SESSION['DataFine'];
    $IDSede       = $_SESSION['IDSede'];

    $costoParzialeVeicoli = 0;
    $costoParzialeSkipper = 0;

    $CarrelloVeicoli = array();
    $CarrelloSkipper = array();
    $minSkipper = 0;
    // RECUPERO TUTTI GLI ID DI VEICOLI E SKIPPER CHE SONO PRESENTI NEL CARRELLO

    /////////////////////////////////////////////////
    $selectFromCart = "SELECT IDVeicolo FROM CarrelloVeicoli WHERE IDUtente = $IDUtente";

    if( $result = $connessione->query($selectFromCart) ) {

        if( $result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {

                $CarrelloVeicoli[] = $row['IDVeicolo'];

                if( (int) $row['SkipperSI'] == 1)
                    $minSkipper++;
            }

        } else {

            $numVeicoli = 0;
        
        }

    } else {

        die("Errore nella query: " . $connessione->error);

    }

    $result->free();
    /////////////////////////////////////////////////

    /////////////////////////////////////////////////
    $selectFromCart = "SELECT IDSkipper FROM CarrelloSkipper WHERE IDUtente = $IDUtente";

    if( $result = $connessione->query($selectFromCart) ) {

        if( $result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {

                $CarrelloSkipper[] = $row['IDSkipper'];

            }

        } else {

            $numSkipper = 0;
        
        }

    } else {

        die("Errore nella query: " . $connessione->error);

    }

    $result->free();
    /////////////////////////////////////////////////

    $numSkipper = count($CarrelloSkipper);
    $numVeicoli = count($CarrelloVeicoli);
    $minSkipper = $_SESSION["minSkipper"];

    if ( $numVeicoli == 0 ) { 

        header("location:userReservation.php?error=Carrello non valido");
        exit();
    }

    if ( $numSkipper !== $minSkipper ) { 

        if( $minSkipper === 1){
            header("location:userReservation.php?error=Serve almeno uno Skipper per prenotare");
            exit();
        } else {
            header("location:userReservation.php?error=Servono almeno $minSkipper Skipper per prenotare");
            exit();
        }
    }

    if ( $numSkipper > $numVeicoli ) {

        header("location:userReservation.php?error=Non puoi avere piu skipper che veicoli");
        exit();

    }

    /////////////////////////////////////////////////
    // CALCOLO COSTO TOTALE

    // CREO UNA STRINGA CON GLI IDVeicolo SEPARATI DA VIRGOLE
    $IDVeicoliString = implode(',', $CarrelloVeicoli);

    $queryCostoVeicoli = 
    "
        SELECT SUM(V.CostoGiornaliero) AS CostoParziale
        FROM Veicolo V
        WHERE V.IDVeicolo IN ($IDVeicoliString);
    ";
    
    //mysqli_query($connessione, $queryCostoVeicoli);

    if( $result = $connessione->query($queryCostoVeicoli) ) {

        $row = $result->fetch_assoc();
        $costoParzialeVeicoli = $row['CostoParziale'];

    } else {

        die("Errore nella query: " . $connessione->error);

    }

    $result->free();
    /////////////////////////////////////////////////

    if( $numSkipper > 0) { 

        // CREO UNA STRINGA CON GLI IDSkipper SEPARATI DA VIRGOLE
        $IDSkipperString = implode(',', $CarrelloSkipper);

        $queryCostoSkipper = 
        "
            SELECT SUM(S.CostoGiornaliero) AS CostoParziale
            FROM Skipper S
            WHERE S.IDSkipper IN ($IDSkipperString);
        ";

        if( $result = $connessione->query($queryCostoSkipper) ) {

            $row = $result->fetch_assoc();
            $costoParzialeSkipper = $row['CostoParziale'];

        } else {

            die("Errore nella query: " . $connessione->error);

        }

        $result->free();

    }
    /////////////////////////////////////////////////


    // OTTENGO IL NUMERO TOTALE DI GIORNI PER CALCOLARE IL COSTO TOTALE DELLA PRENOTAZIONE

    $inizio = new DateTime($DataInizio);
    $fine   = new DateTime($DataFine);

    // CALCOLA LA DIFFERENZA TRA LE DATE
    $differenza = $inizio->diff($fine);

    // NUMERO TOTALE DI GIORNI
    $giorni = $differenza->days + 1; 
    // AGGIUNGO 1 PERCHÉ VOGLIO INCLUDERE SIA LA DATA DI INIZIO CHE QUELLA DI FINE

    $costoTotale = ($costoParzialeVeicoli + $costoParzialeSkipper) * $giorni;

    try {

        // INIZIO DELLA TRANSAZIONE
        $connessione->begin_transaction(); 


        $SQLinsertPrenotazione = 
        "INSERT INTO 
        Prenotazione (IDUtente, IDSede, DataOraAvvenutaPrenotazione, DataInizio, DataFine, CostoTotale) VALUES 
        ($IDUtente, $IDSede, NOW(),'$DataInizio', '$DataFine', $costoTotale);";
    
        // ESEGUE LA QUERY
        $connessione->query($SQLinsertPrenotazione);

        // OTTENGO L'ID DELL'ULTIMA RIGA INSERITA
        $IDPrenotazione = $connessione->insert_id;
        
        
        // QUERY DI INSERIMENTO DELLE PRENOTAZIONI VEICOLI
        foreach($CarrelloVeicoli as $IDVeicolo){

            $SQLinsertVeicolo = 
            "INSERT INTO 
            PrenotazioneVeicolo (IDPrenotazione, IDVeicolo) VALUES 
            ($IDPrenotazione, $IDVeicolo);";

            $connessione->query($SQLinsertVeicolo);
        }
        
        // QUERY DI INSERIMENTO DELLE PRENOTAZIONI SKIPPER
        foreach($CarrelloSkipper as $IDSkipper){
            
            $SQLinsertSkipper = 
            "INSERT INTO 
            PrenotazioneSkipper (IDPrenotazione, IDSkipper) VALUES 
            ($IDPrenotazione, $IDSkipper);";

            $connessione->query($SQLinsertSkipper);
        }

        // CONFERMA LA TRANSAZIONE
        $connessione->commit();

        $_SESSION["Veicoli"] = array();
        $_SESSION["Skipper"] = array();


        header("location:PHPdemo/demoPrenotazione1.php");
        exit();

    } catch (Exception $e) {

        // ANNULLA LA TRANSAZIONE IN CASO DI ERRORE
        $connessione->rollback();

        header("location:userReservation.php?error=Errore durante l'elaborazione della prenotazione");
        exit();
        //echo '<script>alert("Errore durante la transazione: ' . $e->getMessage() . '");</script>';

    }

?>

