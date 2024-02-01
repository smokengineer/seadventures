<!-- FILE PHP PER AGGIORNAMENTO DATI VEICOLO -->

<?php
    require_once("PHPconfig/config.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        /////////////////////////////////////////////////////////////////////////////    
        $IDSede         = (int) $_POST['sede'];
        $IDResponsabile = (int) $_POST['IDResp'];
        $IDSede2 = null;

        $sql = "SELECT IDSede FROM Responsabile WHERE IDResponsabile = '$IDResponsabile'";
        
        if ( $result = mysqli_query($connessione, $sql) ) {

            $row = mysqli_fetch_assoc($result);

            $IDSede2 = $row['IDSede'];
        }

        // Verifica il numero di responsabili con lo stesso IDSede
        $sqlCount = "SELECT COUNT(*) as numResp FROM Responsabile WHERE IDSede = '$IDSede2'";
        
        if ( $resultCount= mysqli_query($connessione, $sqlCount) ) {

            $rowCount = mysqli_fetch_assoc($resultCount);

            // Se ci sono almeno due responsabili con lo stesso IDSede, esegui l'aggiornamento
            if ($rowCount['numResp'] > 1) {

                $sqlUpdate = "UPDATE Responsabile SET IDSede = $IDSede WHERE IDResponsabile = $IDResponsabile";
                $resultUpdate = mysqli_query($connessione, $sqlUpdate);

                if ($resultUpdate) {

                    header("location:superAdminManagementPage.php?success=Modifiche salvate con successo");
                    exit();
                
                } else {

                    header("location:superAdminManagementPage.php?error=Errore durante l'aggiornamento: ".htmlspecialchars(mysqli_error($connessione))."");
                    exit();    
                }   

            } else {

                header("location:superAdminManagementPage.php?error=Non puoi lasciare una sede scoperta");
                exit();
            }

        } else {

            header("location:superAdminManagementPage.php?error=Errore durante la verifica ".htmlspecialchars(mysqli_error($connessione))."" );
            exit();
        }

        $connessione->close();
    }

?>
