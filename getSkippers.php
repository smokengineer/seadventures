<!-- FILE PHP PER GENERARE LE INFO SUGLI SKIPPER DI UNA DETERMINATA SEDE -->
<!-- OLTRE ALLE INFO CONSENTE DI REINDIRIZZARE ALLE PAGINE DI AGGIORNAMENTO E AGGIUNTA SKIPPER -->

<?php
    require_once("PHPconfig/config.php");
    require_once("printFunctions.php");

    $IDSede = $_SESSION["IDSede"];

    // QUERY PER GLI SKIPPER DI UNA DETERMINATA SEDE

    $selectSkipper =
    "SELECT * FROM Skipper S
    WHERE IDSede = $IDSede;";

    if($result = $connessione->query($selectSkipper)) {    
        
        // VERIFICA SE CI SONO RISULTATI
        if ( $result->num_rows > 0 ) {

            echo '<div class="accordion" id="Skippers">';

            // STAMPA I DATI DI OGNI RIGA
            while ( $row = $result->fetch_assoc() ) {
                
                printItemSkipper($row);
            }

            echo '</div>'; // CHIUDE ACCORDION PARENT

            ////////////////
            echo '<div class="card mt-3 mb-3 text-center" style="max-width:20rem">';   
                echo '<div class="card-header"> <strong> AGGIUNGI NUOVO SKIPPER </strong> </div>';

                echo '<div class="card-body">';

                    //echo '<p class="card-text"> <strong> NOME </strong>: '.$responsabile['Nome'].'</p>';
                    echo '<button class="btn btn-primary"> <a href="insertSkipperPage.php" class="btn"> NUOVO SKIPPER  </a></button>';
                echo '</div>';
            echo '</div>';
            ////////////////

        } else {
            
            printMessage("NESSUNO SKIPPER...");
        }

    } else {

        header("location:adminManagementPage.php?error=Errore in fase di recupero dei dati skipper");
        exit();
    }

        
?>


