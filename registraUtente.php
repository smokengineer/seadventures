<!-- FILE PHP DI REGISTRAZIONE UTENTE -->

<?php

    require_once("PHPconfig/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /////////////////////////////////////////////////////////////////////////////
    // VARIABILI DEL FORM DI REGISTRAZIONE
    $nome           = $connessione->real_escape_string($_POST['nome']);
    $nome           = trim( $nome );

    $cognome        = $connessione->real_escape_string($_POST['cognome']);
    $cognome        = trim( $cognome);

    $datanascita    = $connessione->real_escape_string($_POST['datanascita']);
    $codicefiscale  = $connessione->real_escape_string($_POST['codicefiscale']);
    
    $tipoIndirizzo  = $connessione->real_escape_string($_POST['tipoIndirizzo']);

    $nomeStrada     = $connessione->real_escape_string($_POST['nomeStrada']);
    $nomeStrada     = trim( $nomeStrada );

    $civico         = $connessione->real_escape_string($_POST['civico']);
    $citta          = $connessione->real_escape_string($_POST['citta']);
    $citta          = trim( $citta );

    $cap            = $connessione->real_escape_string($_POST['cap']);
     
    $email          = $connessione->real_escape_string($_POST['email']);
    $email          = trim( $email );

    $confirmEmail          = $connessione->real_escape_string($_POST['confirmEmail']);
    $confirmEmail          = trim( $confirmEmail );
    

    $prefisso       = $connessione->real_escape_string($_POST['prefisso']);    
    $phone          = $connessione->real_escape_string( $_POST['phone'] );  
    
    $phone = str_replace([' ', "\t", "\n", "\r"], '', $phone);
    //$senzaSpazi = str_replace([' ', "\t", "\n", "\r"], '', $stringaConSpazi);

    $phoneNumber    = $prefisso.' '.$phone;
    
    $password           = $_POST['password1'];
    $confermaPassword   = $_POST['password2'];

    if ( $email !== $confirmEmail ) {

        header("location: userSignupPage.php?error=Le mail non coincidono");
        exit();
    }

    /////////////////////////////////////////////////////////////////////////////
    // VALIDAZIONE PASSWORD
    
    // CONTROLLA LA LUNGHEZZA MINIMA (ALMENO 8 CARATTERI)
    if ( strlen($password) < 8 ) {

        header("location: userSignupPage.php?error=La lunghezza minima per la password è di 8 caratteri");
        exit();
    }

    // CONTROLLA LA PRESENZA DI SPAZI ALL'INIZIO O ALLA FINE
    if ( $password !== trim($password) ) {

        header("location: userSignupPage.php?error=La password contiene caratteri non validi");
        exit();
    }

    // CONTROLLA LA PRESENZA DI SPAZI ALL'INTERNO DELLA PASSWORD
    if ( strpos($password, ' ') !== false ) {

        header("location: userSignupPage.php?error=La password contiene caratteri non validi");
        exit();
    }

    // CONTROLLA SE LA PASSWORD E LA CONFERMA DELLA PASSWORD SONO UGUALI
    if ( $password !== $confermaPassword ) {

        header("location: userSignupPage.php?error=Le password non coincidono");
        exit();
    }
 
    // CODIFICA PASSWORD
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    /////////////////////////////////////////////////////////////////////////////
    
    /////////////////////////////////////////////////////////////////////////////
    // VALIDAZIONE E-MAIL
    $emailExistsQuery = "SELECT COUNT(*) as MailCount FROM Utente WHERE Email = '$email'";
    $result = mysqli_query($connessione, $emailExistsQuery);

    if ($result) {
        
        $row = $result->fetch_assoc();
        $emailCount = $row['MailCount'];

        if ($emailCount > 0) {

            header("location: userSignupPage.php?error=La E-Mail inserita è già registrata");
            exit();
        }

    } else {

        // Gestione dell'errore nella query
        header("location: userSignupPage.php?error=Errore nella verifica dell'email: $connessione->error");
        exit();
    }
    /////////////////////////////////////////////////////////////////////////////
 

    $sql = 
    "INSERT INTO 
    Utente (Nome, Cognome, DataNascita, CodFiscale, Telefono, Email, Password, TipoIndirizzo, NomeStrada, Civico, Citta, CAP)
    VALUES ('$nome', '$cognome', '$datanascita', '$codicefiscale', '$phoneNumber', '$email', '$hashed_password', '$tipoIndirizzo', '$nomeStrada', '$civico', '$citta', '$cap');";


    try {
        
        if ($connessione->query($sql)) {

            header("location: PHPdemo/demoRegistrazione.php");
            exit();
            
        } else {
    
            header("location: userSignupPage.php?error=Errore durante la registrazione dell'utente: $connessione->error");
            exit();
        }

    } catch (Exception $e) {

        header("location: userSignupPage.php?error=".$e->getMessage());
        exit();

    }

    /////////////////////////////////////////////////////////////////////////////
    $connessione->close();
    }
?>
