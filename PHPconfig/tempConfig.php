<!-- FILE DI CONFIGURAZIONE PHP TEMPORANEO (A VOLTE E' NECESSARIO PER NON CREARE CONFLITTI CON LA PRIMA CONNESSIONE) -->

<?php
    $config = parse_ini_file('config.ini', true);

    define('DB_HOST2', $config['database']['host']);
    define('DB_USER2', $config['database']['username']);
    define('DB_PASSWORD2', $config['database']['password']);
    define('DB_NAME2', $config['database']['dbname']);

    try {
        // APRO UNA CONNESSIONE COL SERVER MYSQL
        $connessione2 = new mysqli(DB_HOST2, DB_USER2, DB_PASSWORD2, DB_NAME2);

        if ($connessione2->connect_error) {

            die("Errore durante la connessione: " . $connessione2->connect_error);
        }

    } catch (Exception $e) {

        die("Errore durante la connessione: " . $e->getMessage());

    }  
    
?>