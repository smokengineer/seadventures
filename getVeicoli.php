<!-- FILE PHP PER GENERARE LE INFO SUI VEICOLI DI UNA DETERMINATA SEDE -->
<!-- OLTRE ALLE INFO CONSENTE DI REINDIRIZZARE ALLE PAGINE DI AGGIORNAMENTO E AGGIUNTA VEICOLI -->

<?php
    require_once("PHPconfig/config.php");
    require_once("printFunctions.php");

    $IDSede = $_SESSION["IDSede"];

    // QUERY PER I VEICOLI DI UNA DETERMINATA SEDE

    $selectVeicoli =
    "SELECT * FROM Veicolo V
    WHERE IDSede = $IDSede;";

    if($result = $connessione->query($selectVeicoli)) {    
        
        // VERIFICA SE CI SONO RISULTATI
        if ( $result->num_rows > 0 ) {

            echo '<div class="accordion" id="Veicoli">';

            // STAMPA I DATI DI OGNI RIGA
            while ( $row = $result->fetch_assoc() ) {
                
                printItemVeicolo($row);
            }

            echo '</div>'; // CHIUDE ACCORDION PARENT

            ////////////////
            echo '<div class="card mt-3 mb-3 text-center" style="max-width:20rem">';   
                echo '<div class="card-header"> <strong> AGGIUNGI NUOVO VEICOLO </strong> </div>';

                echo '<div class="card-body">';

                    //echo '<p class="card-text"> <strong> NOME </strong>: '.$responsabile['Nome'].'</p>';
                    echo '<button class="btn btn-primary"> <a href="insertVeicoloPage.php" class="btn"> NUOVO VEICOLO  </a></button>';
                echo '</div>';
            echo '</div>';
            ////////////////

        } else {
            
            printMessage("NESSUN VEICOLO...");
        }

    } else {

        header("location:adminManagementPage.php?error=Errore in fase di recupero dei dati veicoli");
        exit();
    }

        
?>


