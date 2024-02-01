<!-- FILE PHP PER GENERARE LE INFO SUI RESPONSABILI E LA RELATIVA SEDE -->
<!-- RICHIAMATO IN adminManagementPage.php -->

<?php
    require_once("PHPconfig/config.php");

    $IDResponsabile = $_SESSION["IDResponsabile"];

    function printInfoResponsabile($responsabile){

        ////////////////
        echo '<div class="card">';
            
            echo '<div class="card-header">  <strong>ID ADMIN #'.$responsabile['IDResponsabile'].'</strong> </div>';
            echo '<div class="card-body">';
                
                echo '<p class="card-text"> <strong> NOME </strong>: '.$responsabile['Nome'].'</p>';

                echo '<p class="card-text"> <strong> COGNOME </strong>: '.$responsabile['Cognome'].'</p>';

                echo '<p class="card-text"> <strong> EMAIL </strong>: '.$responsabile['Email'].'</p>';

            echo '</div>';
        echo '</div>';
        ////////////////
    }

    function printInfoSede($sede){

        $indirizzo = $sede['TipoIndirizzo'].' '.$sede['NomeStrada']. ', ' .$sede['Civico']. ', ' .$sede['Citta']. ', ' .$sede['CAP'];

        ////////////////
        echo
            '<div class="card text-bg-warning mt-3 mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-location-dot"></i> INFO SEDE </h5>
                </div>
            </div> ';

        echo '<div class="card mt-3">';
            
            echo '<div class="card-header">  <strong>ID SEDE #'.$sede['IDSede'].'</strong> </div>';
            echo '<div class="card-body">';

                echo '<p class="card-text"> <strong> LOCALITA </strong>: '.$sede['Nome'].'</p>';
                echo '<p class="card-text"> <strong> INDIRIZZO </strong>: '.$indirizzo.'</p>';
                echo '<p class="card-text"> <strong> TELEFONO </strong>: '.$sede['Telefono'].'</p>';
                echo '<p class="card-text"> <strong> EMAIL </strong>: '.$sede['Email'].'</p>';

            echo '</div>';
        echo '</div>';
        ////////////////
    }
    
    function getInfo($IDResponsabile, $connessione){
        
        $query = "SELECT * FROM Responsabile WHERE IDResponsabile = $IDResponsabile; ";

        if( $result = $connessione->query($query) ) {    
        
            // VERIFICA SE CI SONO RISULTATI
            if ( $result->num_rows > 0 ) {
                
                $row = $result->fetch_assoc();

                printInfoResponsabile($row); 
            }
    
        } else {
    
            header("location:adminManagementPage.php?error=Errore in fase di recupero dei dati responsabile");
            exit();
        }   

        if ( isset( $_SESSION['adm'] ) )
            $IDSede = $_SESSION['IDSede'];
        else
            $IDSede = $row['IDSede'];
        
        $querySede = "SELECT * FROM Sede WHERE IDSede = $IDSede; ";

        if( $result = $connessione->query($querySede) ) {    
        
            // VERIFICA SE CI SONO RISULTATI
            if ( $result->num_rows > 0 ) {
                
                $sede = $result->fetch_assoc();

                printInfoSede($sede); 
            }
    
        } else {
    
            header("location:adminManagementPage.php?error=Errore in fase di recupero dei dati sede");
            exit();
        } 

    }
    
    getInfo($IDResponsabile, $connessione);

?>


