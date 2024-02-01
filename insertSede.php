<?php

    require_once("PHPconfig/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /////////////////////////////////////////////////////////////////////////////

    $localita           = $connessione->real_escape_string($_POST['localita']);
    $localita           = trim( $localita );

    $tipoIndirizzo  = $connessione->real_escape_string($_POST['tipoIndirizzo']);

    $nomeStrada     = $connessione->real_escape_string($_POST['nomeStrada']);
    $nomeStrada     = trim( $nomeStrada );

    $civico         = $connessione->real_escape_string($_POST['civico']);
    $citta          = $connessione->real_escape_string($_POST['citta']);
    $citta          = trim( $citta );

    $cap            = $connessione->real_escape_string($_POST['cap']);
     
    $email          = $connessione->real_escape_string($_POST['email']);
    $email          = trim( $email );

    $prefisso       = $connessione->real_escape_string($_POST['prefisso']);    
    $phone          = $connessione->real_escape_string($_POST['phone']);  
    
    $phoneNumber    = $prefisso.' '.$phone;

    
    $sql = 
    "INSERT INTO Sede (Nome, Telefono, Email, TipoIndirizzo, NomeStrada, Civico, Citta, CAP)
    VALUES ('$localita', '$phoneNumber', '$email', '$tipoIndirizzo', '$nomeStrada', '$civico', '$citta', '$cap');";

    try {
        
        if ( mysqli_query($connessione, $sql) ) {

            header("location: PHPdemo/demoRegistrazioneSede.php");
            exit();
            
        } else {
    
            header("location: superAdminManagementPage.php?error=Errore durante la registrazione della sede: $connessione->error");
            exit();
    
        }

    } catch (Exception $e) {

        header("location: superAdminManagementPage.php?error=".$e->getMessage());
        exit();

    }

    /////////////////////////////////////////////////////////////////////////////
    $connessione->close();
    }

?>