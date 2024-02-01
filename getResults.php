<!-- FILE PHP PER GENERARE I RISULTATI IN BASE AI FILTRI APPLICATI -->

<?php
    require_once("PHPconfig/config.php");


    $condizioneDate     = '1';
    $condizioneSede     = '1';  // PER VEICOLI
    $condizioneSede2    = '1'; // PER SKIPPER
    $condizioneTipo     = '1';

    $selectVeicoli = null;
    $selectSkipper = null;


    /*
    if(!isset($_SESSION["Veicoli"]))
        $_SESSION["Veicoli"] = array();
    
    if(!isset($_SESSION["Skipper"]))
        $_SESSION["Skipper"] = array();
    */

    
    // GESTIONE CONDIZIONE TIPOLOGIA VEICOLO
    // 0 E' IL VALORE PER 'QUALSIASI'
    if( isset($_SESSION["IDTipo"]) && $_SESSION["IDTipo"] != 0 ){

        $IDTipo = $_SESSION["IDTipo"];
        $condizioneTipo = "IDTipo = $IDTipo";

    }
        

    // GESTIONE CONDIZIONI DATE

    if ( isset($_SESSION['DataInizio'], $_SESSION['DataFine']) ){
    
        $DataInizio = $_SESSION['DataInizio'];  
        $DataFine = $_SESSION['DataFine'];
        
        // $condizioneDate = 
        // "
        // (P.DataInizio <= '$DataFine'   AND P.DataFine >= '$DataInizio') OR
        // (P.DataInizio >= '$DataInizio' AND P.DataFine <= '$DataFine') OR
        // (P.DataInizio <= '$DataInizio' AND P.DataFine >= '$DataInizio')
        // ";
        $condizioneDate = "
        (
            ('$DataInizio' >= P.DataInizio AND '$DataFine' <= P.DataFine)
            OR

            (P.DataInizio >= '$DataInizio' AND P.DataFine <= '$DataFine')
            OR

            (P.DataInizio < '$DataInizio' AND P.DataFine >= '$DataInizio' AND P.DataFine <= '$DataFine')
            OR

            (P.DataInizio >= '$DataInizio' AND P.DataInizio <= '$DataFine' AND P.DataFine > '$DataFine')
            OR

            (P.DataInizio <= '$DataInizio' AND P.DataFine >= '$DataFine')
            OR

            (P.DataInizio = '$DataInizio' AND P.DataFine <= '$DataFine')
            OR

            (P.DataFine = '$DataFine' AND P.DataInizio >= '$DataInizio')
        )
        ";


    } else {

        ////////////////////////////////////////////
    }
    
    // GESTIONE CONDIZIONE SEDE
    if ( isset($_SESSION['IDSede']) ) {
        
        $sedeSelezionata = $_SESSION['IDSede'];

        if( $sedeSelezionata == 'all' ) {

            $condizioneSede = "1";
            $condizioneSede2 = "1";

        } else {

            $condizioneSede  = "V.IDSede = $sedeSelezionata";
            $condizioneSede2 = "S.IDSede = $sedeSelezionata";
        }
    }

    // RECUPERO TUTTI GLI ID E I NOMI DELLE SEDI PER EFFETTUARE CONTROLLI SU VEICOLI E SKIPPER
    $selectSedi = "SELECT Nome, IDSede FROM Sede";
    
    $sedi = array();

    if ( $res =  mysqli_query($connessione, $selectSedi) ) {

        while ($row = $res->fetch_assoc()) {

            // Per ogni riga, aggiunge una voce all'array $sedi
            $sedi[$row["IDSede"]] = $row["Nome"];
        }

    } else {

        //echo "Errore nella query: " . mysqli_error($connessione);
    }


    // QUERY PER I VEICOLI
    $selectVeicoli =
    "SELECT * FROM Veicolo V
    WHERE V.IDVeicolo NOT IN (
        
        SELECT PV.IDVeicolo
        FROM Prenotazione P INNER JOIN PrenotazioneVeicolo PV 
        ON P.IDPrenotazione = PV.IDPrenotazione
        WHERE $condizioneDate

    )

    AND $condizioneSede
    AND $condizioneTipo
    ORDER BY V.IDSede, V.IDTipo; 
    ";



    if( isset($_SESSION['skipperCheck']) ) { // IMPOSTA LA QUERY PER GLI SKIPPER SOLO SE RICHIESTO

        // QUERY PER GLI SKIPPER
        $selectSkipper =
        "SELECT *
        FROM Skipper S
        WHERE S.IDSkipper NOT IN (
            SELECT PS.IDSkipper
            FROM PrenotazioneSkipper PS INNER JOIN Prenotazione P 
            ON PS.IDPrenotazione = P.IDPrenotazione
            WHERE $condizioneDate
        )
        AND $condizioneSede2
        ORDER BY S.IDSede;
        ";
    }
    
    if($result = $connessione->query($selectVeicoli)) {    
        
        // VERIFICA SE CI SONO RISULTATI
        if ( $result->num_rows > 0 ) {


            $currentType = null;

            // STAMPA I DATI DI OGNI RIGA
            while ( $row = $result->fetch_assoc() ) {
                
                $IDSede = $row["IDSede"];

                if ( $IDSede !== $currentType ) {

                    if ($currentType != null) { // CHIUDE ROW SE CAMBIA SEDE

                        echo '</div>';    
                    }
                    
                    printCardSede( $sedi[ $IDSede ] , "VEICOLI" ); // APRE ANCHE UNA ROW
                    
                    $currentType = $IDSede;
                }

                printCardVeicolo($row);
            }

            echo '</div>'; // CHIUDE ULTIMA ROW

        } else {
            
            printMessage("NESSUN VEICOLO DISPONIBILE...");
        }

    } else {

        header("location:userReservation.php?error=Errore in fase di recupero dei dati veicoli");
        exit();
    }


    if($selectSkipper != null) { // SKIPPER RICHIESTI, QUERY IMPOSTATA IN PRECEDENZA

        if($result = $connessione->query($selectSkipper)) {            

            // VERIFICA SE CI SONO RISULTATI
            if ( $result->num_rows > 0 ) {

                $currentType = null;
                // STAMPA I DATI DI OGNI RIGA
                while ( $row = $result->fetch_assoc() ) {

                    $IDSede = $row["IDSede"];
                    
                    if ( $IDSede !== $currentType) {

                        if ($currentType != null) {// CHIUDE ROW SE CAMBIA SEDE

                            echo '</div>';                        
                        }
    
                        printCardSede( $sedi[ $IDSede ] , "SKIPPER" ); // APRE ANCHE UNA ROW
                        
                        $currentType = $IDSede;
                    }

                    printCardSkipper($row);
                }

                echo '</div>'; // CHIUDE ULTIMA ROW

            } else {
                
                printMessage("NESSUNO SKIPPER DISPONIBILE...");
                
            }

        } else {

            header("location:userReservation.php?error=Errore in fase di recupero dei dati skipper");
            exit();
        }
    }


?>