<!-- FILE PHP PER L'ACCESSO DEI RESPONSABILI -->

<?php
    require_once("PHPconfig/config.php");
    require_once("PHPconfig/tempConfig.php");
    
    
    if($_SERVER["REQUEST_METHOD"] === "POST") {

        $email          = $connessione->real_escape_string($_POST['email']);  
        $password       = $connessione->real_escape_string($_POST['password']);

        $_SESSION['adminEmail'] = $email;

        $sql = "SELECT * FROM Responsabile WHERE Email = ?";

        // Preparazione della query
        $statement = $connessione->prepare($sql);

        if ($statement) {
            
            // Associazione del parametro
            $statement->bind_param("s", $email);

            // Esecuzione della query
            $statement->execute();

            // Ottieni i risultati
            $result = $statement->get_result();

            // Verifica se esiste un utente con l'email fornita
            if ($result->num_rows > 0) {

                $row = $result->fetch_array(MYSQLI_ASSOC);

                // Verifica la password
                if ( password_verify($password, $row['Password']) ) {

                    session_start();
                    // IMPOSTA I PARAMETRI DELLA SESSIONE
                    $_SESSION['IDResponsabile'] = $row['IDResponsabile'];
                    $_SESSION['Nome'] = $row['Nome'];
                    $_SESSION['Cognome'] = $row['Cognome'];
                    $_SESSION['Email'] = $row['Email'];
                    //$_SESSION['adminEmail'] = $row['Email'];

                    $_SESSION["IDSede"] = $row['IDSede'];

                    $_SESSION['private'] = 2;
                    
                    if ( $row['Administrator'] == 1 ) // SUPER-ADMIN
                        $_SESSION['adm'] = 1;

                    /////////////////////////////////////////////////////
                    $selectTipo = "SELECT * FROM TipologiaVeicolo ORDER BY Categoria";

                    $res = $connessione2->query($selectTipo);

                    // Verifica se la query ha restituito risultati

                    if ($res->num_rows > 0) {

                        $tipologiaVeicolo = array();

                        while ($tipologia = $res->fetch_assoc()) {
                            $index = $tipologia["IDTipo"];

                            $tipologiaVeicolo[$index] = $tipologia;
                        }
                        // Memorizza l'array in sessione
                        $_SESSION['TipologiaVeicolo'] = $tipologiaVeicolo;
                    }
                    /////////////////////////////////////////////////////

                    header("location: index.php");
                    exit();

                } else {

                    header("location:adminLoginPage.php?error=Password errata, riprova");
                    exit();
                }

            } else {

                unset($_SESSION['adminEmail']);
                header("location:adminLoginPage.php?error=Dipendente non trovato");
                exit();
            }

            // Chiudi lo statement
            $stmt->close();

        } else {

            // Errore nella preparazione della query
            header("location:adminLoginPage.php?error=Errore nella preparazione della query");
            exit();
        }
    }
    
    $connessione->close();
?>