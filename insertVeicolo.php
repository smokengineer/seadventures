<!-- FILE PHP DI INSERIMENTO NUOVI VEICOLI -->

<?php
    require_once("PHPconfig/config.php");
    require_once("PHPconfig/tempConfig.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /////////////////////////////////////////////////////////////////////////////
    // VARIABILI DEL FORM 
    
    $nome           = $connessione->real_escape_string($_POST['nome']);
    $nome           = trim($nome);

    $descrizione    = $connessione->real_escape_string($_POST['descrizione']);
    $descrizione    = trim($descrizione);

    $IDTipo           = $connessione->real_escape_string($_POST['tipo']);

    $costo          = $connessione->real_escape_string($_POST['costo']);
    $costo          = floatval( $costo );
    
    $SkipperSI = 0;
    if( isset($_POST['SkipperSI']) )
        $SkipperSI = 1;

    /////////////////////////////////////////////////////////////////////////////
    // VERIFICA SE IL FILE E' STATO CARICATO SENZA ERRORI
    /*
    if ( isset($_FILES["immagine"]) && $_FILES["immagine"]["error"] == 0 ) {

        $cartellaDestinazione = "/images/veicoli/"; //"C:/xampp/htdocs/images/veicoli/"
        $percorsoPermanente = $cartellaDestinazione . basename($_FILES["immagine"]["name"]);

        $info_percorso = pathinfo($_FILES["immagine"]["name"]);

        $ext = $info_percorso['extension']; // ESTENSIONE FILE

        // INFO FILE
        $nomeFile = $_FILES['immagine']['name'];
        $tipoFile = $_FILES['immagine']['type'];
        $dimensioneFile = $_FILES['immagine']['size'];
        $percorsoTemporaneo = $_FILES['immagine']['tmp_name'];

        //$ID = "1";
        //$percorsoPermanente = $cartellaDestinazione . "VEICOLO-".$ID.".".$ext;

    } else {

        echo "Errore: Nessun file selezionato o si è verificato un problema durante il caricamento.";
        // echo 'Errore nell\'upload del file: ' . $_FILES['immagine']['error'];
    }*/

    /////////////////////////////////////////////////////////////////////////////
    $IDSede = (int) $_SESSION['IDSede'] ;

    $sql = 
    "INSERT INTO Veicolo 
    (IDSede, Nome, CostoGiornaliero,  Descrizione, NomeFile, IDTipo, SkipperSI) VALUES 
    ($IDSede, '$nome', '$costo', '$descrizione', 'temp-text', $IDTipo, $SkipperSI )";
    
    
    try {
        
        if ($connessione->query($sql)) {

            ////////////////////////// VEICOLO INSERITO ///////////////////////////////// 

            /////////////////////////////////////////////////////////////////////////////
            // GESTIONE IMMAGINE

            // VERIFICA SE IL FILE E' STATO CARICATO SENZA ERRORI
            if ( isset($_FILES["immagine"]) && $_FILES["immagine"]["error"] == 0 ) {

                $info_percorso = pathinfo($_FILES["immagine"]["name"]);

                $ext = $info_percorso['extension']; // ESTENSIONE FILE

                $percorsoTemporaneo = $_FILES['immagine']['tmp_name'];

                $IDVeicolo = $connessione->insert_id;
                $percorso = "C:/xampp/htdocs/images/veicoli/VEICOLO-".$IDVeicolo.".".$ext;

                $percorsoPermanente = "/images/veicoli/VEICOLO-".$IDVeicolo.".".$ext;

                // SALVATAGGIO FILE SUL SERVER
                if ( move_uploaded_file($percorsoTemporaneo, $percorso) ) {

                    $queryUpdate =  "UPDATE Veicolo SET NomeFile = '$percorsoPermanente' WHERE IDVeicolo = $IDVeicolo";

                    if ($connessione2->query($queryUpdate)) {

                        header("location: adminManagementPage.php?success=Veicolo inserito correttamente");
                        exit();

                    } else  {

                        header("location: adminManagementPage.php?error=Veicolo inserito senza immagine ($connessione->error)");
                        exit();
                    }

                } else {

                    header("location: adminManagementPage.php?error=Veicolo inserito senza immagine (immagine non caricata sul server)");
                    exit();
                }


            } else {

                header("location: adminManagementPage.php?error=Veicolo inserito senza immagine (errore upload immagine)");
                //echo "Errore: Nessun file selezionato o si è verificato un problema durante il caricamento.";
                // echo 'Errore nell\'upload del file: ' . $_FILES['immagine']['error'];
                exit();
            }

            /////////////////////////////////////////////////////////////////////////////

        } else {
    
            header("location: adminManagementPage.php?error=Errore durante l'inserimento del veicolo: $connessione->error");
            exit();
    
        }

    } catch (Exception $e) {

        header("location: adminManagementPage.php?error=".$e->getMessage());
        exit();

    }

    $connessione->close();
    }
?>
