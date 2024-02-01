<!-- FILE DI CONFIGURAZIONE PHP -->

<?php
    $config = parse_ini_file('config.ini', true);

    define( 'DB_HOST'        , $config['database']['host']     );
    define( 'DB_USER'        , $config['database']['username'] );
    define( 'DB_PASSWORD'    , $config['database']['password'] );
    define( 'DB_NAME'        , $config['database']['dbname']   );

    try {

        // APRO UNA CONNESSIONE COL SERVER MYSQL
        $connessione = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($connessione->connect_error) {
            
            die("Errore durante la connessione: " . $connessione->connect_error);
        }

    } catch (Exception $e) {

        die("Errore durante la connessione: " . $e->getMessage());

    }  

?>