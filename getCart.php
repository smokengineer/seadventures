<!-- FILE PHP PER OTTENIMENTO CARRELLO UTENTE -->

<?php
    require_once("PHPconfig/config.php");
    require_once("printFunctions.php");

    $IDUtente = $_SESSION['IDUtente'];
    
    $noSkipper = true;
    $noVeicoli = true;
    $prezzo = 0;
    

    $CarrelloVeicoli = array();
    $CarrelloSkipper = array();
    // RECUPERO TUTTI GLI ID DI VEICOLI E SKIPPER CHE SONO PRESENTI NEL CARRELLO

    /////////////////////////////////////////////////
    $selectFromCart = "SELECT IDVeicolo FROM CarrelloVeicoli WHERE IDUtente = $IDUtente";

    if( $result = $connessione->query($selectFromCart) ) {

        if( $result->num_rows > 0) 
            
            while ($row = $result->fetch_assoc())
                $CarrelloVeicoli[] = $row['IDVeicolo'];

    } else {

        die("Errore nella query: " . $connessione->error);

    }

    $result->free();
    /////////////////////////////////////////////////

    /////////////////////////////////////////////////
    $selectFromCart = "SELECT IDSkipper FROM CarrelloSkipper WHERE IDUtente = $IDUtente";

    if( $result = $connessione->query($selectFromCart) ) {

        if( $result->num_rows > 0) 

            while ($row = $result->fetch_assoc()) 
                $CarrelloSkipper[] = $row['IDSkipper'];

    } else {

        die("Errore nella query: " . $connessione->error);

    }

    $result->free();
    /////////////////////////////////////////////////

    $dim = count($CarrelloVeicoli) + count($CarrelloSkipper);
    //$dim = count($_SESSION["Veicoli"]) + count($_SESSION["Skipper"]);

    printCartHeader($dim);
    
    //foreach ($_SESSION["Veicoli"] as $idVeicolo) {
    foreach ($CarrelloVeicoli as $IDVeicolo) {

        $selectVeicolo = "SELECT * FROM Veicolo WHERE IDVeicolo = $IDVeicolo";

        if( $res = $connessione->query($selectVeicolo) ) {

            if ( $res->num_rows == 1 ) {
            
                $row = $res->fetch_assoc();

                printCartItemVeicolo($row);

                $prezzo = $prezzo + (float) $row['CostoGiornaliero'];

                $noVeicoli = false;
            }

        } else {

            header("location:userReservation.php?error=Errore in fase di recupero dei dati veicoli");
            exit();
        }
    }

    //foreach ($_SESSION["Skipper"] as $IDSkipper) {
    foreach ($CarrelloSkipper as $IDSkipper) {
        
        $selectSkipper = "SELECT * FROM Skipper WHERE IDSkipper = $IDSkipper";

        if( $res = $connessione->query($selectSkipper) ) {

            if ( $res->num_rows == 1 ) {
            
                $row = $res->fetch_assoc();
                
                $indici = array_keys($row);

                printCartItemSkipper($row);

                $prezzo = $prezzo + (float) $row['CostoGiornaliero'];

                $noSkipper = false;
            }

        } else {

            header("location:userReservation.php?error=Errore in fase di recupero dei dati skipper");
            exit();
        }
    }


    $emptyCart = $noVeicoli && $noSkipper;
    
    $dataInizio = new DateTime($_SESSION['DataInizio']);
    $dataFine = new DateTime($_SESSION['DataFine']);

    // CALCOLA LA DIFFERENZA TRA LE DATE
    $differenza = $dataInizio->diff($dataFine);

    // NUMERO TOTALE DI GIORNI
    $giorni = $differenza->days + 1; // AGGIUNGO 1 PERCHÉ VOGLIO INCLUDERE SIA LA DATA DI INIZIO CHE QUELLA DI FINE


    if ( $emptyCart ) {

        $prezzoTotale = 0;
    
        if (isset($_SESSION['carrello'])){

            unset($_SESSION['carrello']);
        }   

    } else {

        $prezzoTotale = $prezzo * $giorni;
        //printPrice($prezzoTotale, $giorni);
        $_SESSION['carrello'] = $IDUtente;

    }

    $_SESSION['prezzoTotale'] = $prezzoTotale;
    printPrice($prezzoTotale, $giorni);
?>


