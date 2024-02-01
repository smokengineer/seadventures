<!-- FILE PHP PER AGGIORNAMENTO DATI UTENTE -->

<?php
    require_once("PHPconfig/config.php");
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $IDUtente           = $connessione->real_escape_string( $_POST["IDUtente"] );
        $Token              = $connessione->real_escape_string( $_POST["Token"] );

        $password           = $connessione->real_escape_string( $_POST["password1"] );
        $confermaPassword   = $connessione->real_escape_string( $_POST["password2"] );


        if ( $password !== $confermaPassword ){
            
            header("location:updatePasswordPage.php?token=$Token&error=Le password non coincidono");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $queryUpdate =  
        
        "UPDATE Utente SET 
        Password='$hashed_password'
    
        WHERE IDUtente=$IDUtente";
        
        if ( mysqli_query($connessione, $queryUpdate) ) {
            
            // Aggiornamento riuscito

            // MARCO IL TOKEN COME USATO
            $markToken = "UPDATE Token SET Usato = TRUE WHERE Token = '$Token'";

            mysqli_query($connessione, $markToken);


            header("location:PHPdemo/demoCambioPassword.php");
            exit();

        } else {

            // Errore durante l'aggiornamento
            header("location:updatePasswordPage.php?error=Errore durante l'aggiornamento della password");
            exit();
        }

        $connessione->close();
    }

?>
