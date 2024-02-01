<!-- FILE PHP PER GENERARE LE INFO SULLE PRENOTAZIONI PER UNA DETERMINATA SEDE -->

<?php
    require_once("PHPconfig/config.php");
    require_once("PHPconfig/tempConfig.php");

    $IDSede = $_SESSION["IDSede"];

    function printVeicolo($veicolo){

        $tipo = $_SESSION["TipologiaVeicolo"][$veicolo["IDTipo"]];
        
        ////////////////
        echo '<div class="card">';
            echo '<div class="card-body">';
                echo '<h5 class="card-title"> NOME: '.$veicolo["Nome"].' - TIPO: '.$tipo["Nome"].'</h5>';
                echo '<p class="card-text"> PREZZO/GIORNO: '.$veicolo["CostoGiornaliero"].' &euro;</p>';
            echo '</div>';
        echo '</div>';
        ////////////////

    }

    function printSkipper($skipper){

        ////////////////
        echo '<div class="card">';
            echo '<div class="card-body">';
                echo '<h5 class="card-title"> NOME: '.$skipper["Nome"].' - COGNOME: '.$skipper["Cognome"].'</h5>';
                echo '<p class="card-text"> PREZZO/GIORNO: '.$skipper["CostoGiornaliero"].' &euro;</p>';
            echo '</div>';
        echo '</div>';
        ////////////////
    }

    function getVeicoli($IDPrenotazione, $connessione2){
        
        $queryVeicoli = 
        "SELECT V.*
        FROM PrenotazioneVeicolo PV INNER JOIN Veicolo V
        ON PV.IDVeicolo = V.IDVeicolo
        WHERE PV.IDPrenotazione = $IDPrenotazione;
        ";

        if( $result = $connessione2->query($queryVeicoli) ) {    
        
            // VERIFICA SE CI SONO RISULTATI
            if ( $result->num_rows > 0 ) {

        echo '<div class="accordion" id="Veicoli">';
            echo '<div class="accordion-item">';
                echo '<h2 class="accordion-header">';
                echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#veicoli'.$IDPrenotazione.'" aria-expanded="true" aria-controls="veicoli'.$IDPrenotazione.'">';
                    echo 'VEICOLI PRENOTATI ';
                echo '</button>';
                echo '</h2>';

                echo '<div id="veicoli'.$IDPrenotazione.'" class="accordion-collapse collapse" data-bs-parent="#Veicoli">';
                    echo '<div class="accordion-body">';

                        // STAMPA I DATI DI OGNI RIGA
                        while ( $row = $result->fetch_assoc() ) {
                            
                            printVeicolo($row); 
                        }

                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>'; // CHIUDE ACCORDION PARENT
            
            }
    
        } else {
    
            header("location:adminReservation.php?error=Errore in fase di recupero dei dati veicoli");
            exit();
        }   
    }

    function getSkippers($IDPrenotazione, $connessione2) {

        $querySkipper = 
        "SELECT S.*
        FROM PrenotazioneSkipper PS INNER JOIN Skipper S 
        ON PS.IDSkipper = S.IDSkipper
        WHERE PS.IDPrenotazione = $IDPrenotazione;
        ";

        if( $result = $connessione2->query($querySkipper) ) {    

            // VERIFICA SE CI SONO RISULTATI
            if ( $result->num_rows > 0 ) {

                echo '<div class="accordion" id="Skippers">';
                    echo '<div class="accordion-item">';
                        echo '<h2 class="accordion-header">';
                        echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#skipper'.$IDPrenotazione.'" aria-expanded="true" aria-controls="skipper'.$IDPrenotazione.'">';
                            echo 'SKIPPER PRENOTATI ';
                        echo '</button>';
                        echo '</h2>';

                        echo '<div id="skipper'.$IDPrenotazione.'" class="accordion-collapse collapse" data-bs-parent="#Skippers">';
                            echo '<div class="accordion-body">';

                                // STAMPA I DATI DI OGNI RIGA
                                while ( $row = $result->fetch_assoc() ) {
                                    
                                    printSkipper($row); 
                                }

                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>'; // CHIUDE ACCORDION PARENT
            
            }

        } else {

            header("location:adminReservation.php?error=Errore in fase di recupero dei dati skipper");
            exit();
        }

    }
   
    function printCardPrenotazione($reserv, $connessione2) {

        $IDPrenotazione = $reserv["IDPrenotazione"];
        $IDUtente = $reserv["IDUtente"];
        $Nome = $reserv["Nome"];
        $Cognome = $reserv["Cognome"];

        $infoUtente = "ID: ".$IDUtente." NOME: ".$Nome." COGNOME: ".$Cognome."";

        $dataInizio = new DateTime($reserv["DataInizio"]);
        $dataFine = new DateTime($reserv["DataFine"]);

        // Calcola la differenza tra le date
        $differenza = $dataInizio->diff($dataFine);

        // Ottieni il numero totale di giorni
        $giorni = $differenza->days + 1;

        echo '<div class="accordion-item">';
            echo '<h2 class="accordion-header">';
                echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#prenotazione_'.$IDPrenotazione.'" aria-expanded="true" aria-controls="prenotazione_'.$IDPrenotazione.'">';
                    echo 'PRENOTAZIONE #'.$IDPrenotazione;
                echo '</button>';
            echo '</h2>';

            echo '<div id="prenotazione_'.$IDPrenotazione.'" class="accordion-collapse collapse" data-bs-parent="#Prenotazioni">';
                echo '<div class="accordion-body">';

                    echo '<div class="card">';
                        echo '<div class="card-header">';
                        echo '<h5 class="card-title"> DETTAGLI PRENOTAZIONE </h5>';
                        echo '</div>';

                        echo '<div class="card-body">';

                            echo '<p class="card-text"><strong> UTENTE </strong>['.$infoUtente.']</p>';
                            echo '<p class="card-text"><strong> HA EFFETTUATO LA PRENOTAZIONE NEL GIORNO: '.$reserv["DataOraAvvenutaPrenotazione"].'</strong></p>';
                            echo '<p class="card-text"><strong> TOTALE GIORNI: '.$giorni.' (INIZIO: '.$reserv["DataInizio"].' - FINE: '.$reserv["DataFine"].')</strong></p>';
                            //echo '<p class="card-text"> FINE: '.$reserv["DataFine"].'</p>';
                            
                        echo '</div>';

                        echo '<div class="card-footer">';
                            echo '<p class="card-text"><strong>HA SPESO: '.$reserv["CostoTotale"].' &euro;</strong></p>';
                        echo '</div>';
                        echo '<div class="card-body">';

                            getVeicoli($IDPrenotazione, $connessione2);
                            getSkippers($IDPrenotazione, $connessione2);

                        echo '</div>';
                    echo '</div>';
                    ////////////////
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }


    // QUERY PER LE PRENOTAZIONI

    $selectPrenotazioni =
    "SELECT * 
    FROM Prenotazione P INNER JOIN Utente U
    ON P.IDUtente = U.IDUtente
    WHERE P.IDSede = $IDSede
    ORDER BY P.IDUtente;";

    if( $result = $connessione->query($selectPrenotazioni) ) {    
        
        // VERIFICA SE CI SONO RISULTATI
        if ( $result->num_rows > 0 ) {

            echo '<div class="accordion" id="Prenotazioni">';

            // STAMPA I DATI DI OGNI RIGA
            while ( $row = $result->fetch_assoc() ) {

                printCardPrenotazione($row, $connessione2);
            }

            echo '</div>'; // CHIUDE ACCORDION PARENT

        } else {
            
            
            printMessage("NESSUNA PRENOTAZIONE...");
        }

    } else {

        header("location:adminReservation.php?error=Errore in fase di recupero dei dati prenotazione");
        exit();
    }

?>









