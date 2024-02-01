<!-- FILE PHP DI REGISTRAZIONE DIPENDENTE -->

<?php
    require_once("PHPconfig/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /////////////////////////////////////////////////////////////////////////////
    // VARIABILI DEL FORM DI REGISTRAZIONE
    $nome           = $connessione->real_escape_string($_POST['nome']);
    $nome           = trim($nome);
    
    $cognome        = $connessione->real_escape_string($_POST['cognome']);
    $cognome        = trim($cognome);

    $datanascita    = $connessione->real_escape_string($_POST['datanascita']);
    $codicefiscale  = $connessione->real_escape_string($_POST['codicefiscale']);
    
    $idSede         = $connessione->real_escape_string($_POST['sede']);

    $email          = $connessione->real_escape_string($_POST['email']);
    $email          = trim($email);
    
    $confirmEmail          = $connessione->real_escape_string($_POST['confirmEmail']);
    $confirmEmail          = trim( $confirmEmail );

    $password           = $_POST['password1'];
    $confermaPassword   = $_POST['password2'];

    if ( $email !== $confirmEmail ) {

        header("location: adminSignupPage.php?error=Le mail non coincidono");
        exit();
    }

    /////////////////////////////////////////////////////////////////////////////
    // VALIDAZIONE PASSWORD
    // CONTROLLA LA LUNGHEZZA MINIMA (ALMENO 8 CARATTERI)
    if ( strlen($password) < 8 ) {

        header("location: adminSignupPage.php?error=La lunghezza minima per la password è di 8 caratteri");
        exit();
    }

    // CONTROLLA LA PRESENZA DI SPAZI ALL'INIZIO O ALLA FINE
    if ( $password !== trim($password) ) {

        header("location: adminSignupPage.php?error=La password contiene caratteri non validi");
        exit();
    }

    // CONTROLLA LA PRESENZA DI SPAZI ALL'INTERNO DELLA PASSWORD
    if ( strpos($password, ' ') !== false ) {

        header("location: adminSignupPage.php?error=La password contiene caratteri non validi");
        exit();

    }

    // CONTROLLA SE LA PASSWORD E LA CONFERMA DELLA PASSWORD SONO UGUALI
    if ( $password !== $confermaPassword ) {

        header("location: adminSignupPage.php?error=Le password non coincidono");
        exit();

    }


    // CODIFICA PASSWORD
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    /////////////////////////////////////////////////////////////////////////////




    $adminCheck = 0;
    if( isset($_POST['adminCheck']) ) 
        $adminCheck = 1;

    /////////////////////////////////////////////////////////////////////////////

    $emailExistsQuery = "SELECT COUNT(*) as count FROM Responsabile WHERE Email = '$email'";
    $result = $connessione->query($emailExistsQuery);

    if ($result) {
        $row = $result->fetch_assoc();
        $emailCount = $row['count'];

        if ($emailCount > 0) {
            
            // L'email è già registrata, gestisci di conseguenza (mostra un messaggio di errore, reindirizza, ecc.)
            header("location: adminSignupPage.php?error=La E-Mail inserita è già registrata");
            exit();
        }

    } else {

        // Gestione dell'errore nella query
        header("location: adminSignupPage.php?error=Errore nella verifica dell'email:: $connessione->error");
        exit();
    }
   
    
    $sql = 
    "INSERT INTO Responsabile (IDSede, Nome, Cognome, DataNascita, CodFiscale, Email, Password, Administrator) VALUES 
    ('$idSede', '$nome', '$cognome', '$datanascita', '$codicefiscale', '$email', '$hashed_password', $adminCheck);";


    $psw = str_repeat('*',  strlen($password));

    if ($connessione->query($sql)) {

        header("location: PHPdemo/demoRegistrazioneAdmin.php?email=$email&password=$psw");
        exit();
        
    } else {

        header("location: adminSignupPage.php?error=Errore durante la registrazione del dipendente: $connessione->error");
        exit();

    }
    /////////////////////////////////////////////////////////////////////////////
    $connessione->close();
    }
?>
