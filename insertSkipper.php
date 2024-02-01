<!-- FILE PHP DI INSERIMENTO NUOVI SKIPPER -->

<?php
    require_once("PHPconfig/config.php");
    require_once("PHPconfig/tempConfig.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /////////////////////////////////////////////////////////////////////////////
    // VARIABILI DEL FORM 
    
    $nome           = $connessione->real_escape_string($_POST['nome']);
    $nome           = trim($nome);

    $cognome        = $connessione->real_escape_string($_POST['cognome']);
    $cognome        = trim($cognome);

    $descrizione    = $connessione->real_escape_string($_POST['descrizione']);
    $descrizione    = trim($descrizione);

    $tipo           = $connessione->real_escape_string($_POST['tipo']);

    $costo          = $connessione->real_escape_string($_POST['costo']);
    $costo          = floatval( $costo );

    $esperienza     = $connessione->real_escape_string($_POST['esperienza']);

    $datanascita    = $connessione->real_escape_string($_POST['datanascita']);

    $IDSede = (int) $_SESSION['IDSede'] ;

    $sql = 
    "INSERT INTO Skipper 
    (IDSede, Nome, Cognome, DataNascita, Esperienza, CostoGiornaliero, Descrizione, NomeFile) VALUES 
    ($IDSede, '$nome', '$cognome', '$datanascita', '$esperienza', '$costo', '$descrizione', 'temp-text')";

    try {
        
        if ($connessione->query($sql)) {

            ////////////////////////// SKIPPER INSERITO ///////////////////////////////// 

            /////////////////////////////////////////////////////////////////////////////
            // GESTIONE IMMAGINE

            // VERIFICA SE IL FILE E' STATO CARICATO SENZA ERRORI
            if ( isset($_FILES["immagine"]) && $_FILES["immagine"]["error"] == 0 ) {

                $info_percorso = pathinfo($_FILES["immagine"]["name"]);

                $ext = $info_percorso['extension']; // ESTENSIONE FILE

                $percorsoTemporaneo = $_FILES['immagine']['tmp_name'];

                $IDSkipper = $connessione->insert_id;
                $percorso = "C:/xampp/htdocs/images/skippers/SKIPPER-".$IDSkipper.".".$ext;

                $percorsoPermanente = "/images/skippers/SKIPPER-".$IDSkipper.".".$ext;

                // SALVATAGGIO FILE SUL SERVER
                if ( move_uploaded_file($percorsoTemporaneo, $percorso) ) {

                    $queryUpdate =  "UPDATE Skipper SET NomeFile = '$percorsoPermanente' WHERE IDSkipper = $IDSkipper";

                    if ($connessione2->query($queryUpdate)) {

                        header("location: adminManagementPage.php?success=Skipper inserito correttamente");
                        exit();

                    } else  {

                        header("location: adminManagementPage.php?error=Skipper inserito senza immagine ($connessione->error)");
                        exit();
                    }

                } else {

                    header("location: adminManagementPage.php?error=Skipper inserito senza immagine (immagine non caricata sul server)");
                    exit();
                }

            } else {

                header("location: adminManagementPage.php?error=Skipper inserito senza immagine (errore upload immagine)");
                //echo "Errore: Nessun file selezionato o si è verificato un problema durante il caricamento.";
                // echo 'Errore nell\'upload del file: ' . $_FILES['immagine']['error'];
                exit();
            }

            /////////////////////////////////////////////////////////////////////////////

        } else {
    
            header("location: adminManagementPage.php?error=Errore durante l'inserimento dello skipper: $connessione->error");
            exit();
    
        }

    } catch (Exception $e) {

        header("location: adminManagementPage.php?error=".$e->getMessage());
        exit();

    }

    $connessione->close();
    }
?>
