<!-- FILE PHP PER L'INVIO DELLA MAIL DI RECUPERO PASSWORD -->

<?php
    require_once("PHPconfig/config.php");
    require_once("PHPconfig/tempConfig.php");

    session_start();

    $row = null;

    if($_SERVER["REQUEST_METHOD"] === "POST") {

        $email = $connessione->real_escape_string($_POST['email']);  
    
        $sql = "SELECT * FROM Utente WHERE Email = '$email'";

        if ( $result = $connessione->query($sql) ) {
            
            // Verifica se esiste un utente con l'email fornita
            if ($result->num_rows == 1) {

                $row = $result->fetch_array(MYSQLI_ASSOC);

            } else {

                header("location:sendRecoveryMailPage.php?error=La mail fornita non esiste nei nostri sistemi");
                exit();
                
            }

        } else {

            // Errore nell'esecuzione della query
            header("location:sendRecoveryMailPage.php?error=Errore nell'elaborazione della richiesta'");
            exit();

        }


        // SE ESISTE UN UTENTE CON QUELLA MAIL
        if ( $row != null ) {

            // PARAMETRI TOKEN
            $IDUtente = $row['IDUtente'];
            $Token = bin2hex(random_bytes(32)); // Genera un token casuale
            $DataEmissione = date('Y-m-d H:i:s');
            $DataScadenza = date('Y-m-d H:i:s', strtotime('+1 hour')); // Scadenza tra 1 ora

            // QUERY INSERIMENTO TOKEN
            $insertToken = 
            "INSERT INTO Token (IDUtente, Token, DataEmissione, DataScadenza, Usato) VALUES 
            ($IDUtente, '$Token', '$DataEmissione', '$DataScadenza', False);";

            if ( $connessione->query($insertToken) ) {
                
                /////////////////////////////////////////////////////////////////////////////////////////

                // INVIO MAIL DI RECUPERO
                $destinatario = $row['Email'];
                $oggetto = "Recupera Password - SeAdventures.com";

                $link = "http://localhost/updatePasswordPage.php?token=$Token";

                $pt1 = "Ciao ".$row['Nome']." ".$row['Cognome'].",\n";
                $pt2 = "Clicca sul seguente link per reimpostare la password:\n";

                $pt3 = "\n\nIl seguente link ha una validità di 1 ora\n";

                $messaggio = $pt1.$pt2.$link.$pt3;

                $header = "From: seadventures@info.com";

                if ( mail($destinatario, $oggetto, $messaggio, $header) ){

                    header("location:userLoginPage.php?success=La mail di recupero e' stata inviata");
                    exit();
                }
                else {

                    header("location:userLoginPage.php?error=La mail di recupero non e' stata inviata");
                    exit();
                }
                /////////////////////////////////////////////////////////////////////////////////////////

            } else {
                
                // Errore inserimento token nel database
                header("location:sendRecoveryMailPage.php?error=Errore nell'elaborazione della richiesta'");
                exit();
            }

        }

    }
    
    $connessione->close();
?>