<!-- FILE PHP PER GENERARE LE INFO DI UN DETERMINATO UTENTE -->
<!-- RICHIAMATO IN userAccount.php -->

<?php
    require_once("PHPconfig/tempConfig.php");

    $IDUtente = $_SESSION["IDUtente"];

    function printInfo($utente){

        $indirizzo = $utente['TipoIndirizzo'].' '.$utente['NomeStrada']. ', ' .$utente['Civico']. ', ' .$utente['Citta']. ', ' .$utente['CAP'];

        $dataNascita = date('d-m-Y', strtotime($utente['DataNascita']));

        ////////////////
        echo '<div class="card">';
        
            echo '<div class="card-header">  <strong>ID UTENTE #'.$utente['IDUtente'].'</strong> </div>';
            echo '<div class="card-body">';

                echo '<p class="card-text"> <strong> NOME</strong>: '.$utente['Nome'].'</p>';

                echo '<p class="card-text"> <strong> COGNOME</strong>: '.$utente['Cognome'].'</p>';

                echo '<p class="card-text"> <strong> CODICE FISCALE</strong>: '.$utente['CodFiscale'].'</p>';
                
                echo '<p class="card-text"> <strong> DATA DI NASCITA</strong>: '.$dataNascita.'</p>';

                echo '<p class="card-text"> <strong> TELEFONO</strong>: '.$utente['Telefono'].'</p>';

                echo '<p class="card-text"> <strong> EMAIL</strong>: '.$utente['Email'].'</p>';

                echo '<p class="card-text"> <strong> INDIRIZZO</strong>: '. $indirizzo .'</p>';
            
            echo '</div>';
        echo '</div>';

        ////////////////
    }
  
    function getInfo($IDUtente, $connessione2){
        
        $queryUtente = "SELECT * FROM Utente WHERE IDUtente = $IDUtente; ";

        if( $result = $connessione2->query($queryUtente) ) {    
        
            // VERIFICA SE CI SONO RISULTATI
            if ( $result->num_rows > 0 ) {
                
                $row = $result->fetch_assoc();

                printInfo($row); 
            }
    
        } else {
    
            header("location:userReservation.php?error=Errore in fase di recupero dei dati utente");
            exit();
        }   
    }
    
    getInfo($IDUtente, $connessione2);

?>


