<!DOCTYPE html>

<html data-bs-theme="dark">
<head>
    <title>Prenotazione - Seadventures</title>
    
	<?php require_once("style.html"); ?>
</head>

<body>
	    <!-- HEADER  -->
    <?php 
        require_once("header.php"); 
        // END HEADER

        userCheck();

        require_once("printFunctions.php");
        require_once("PHPconfig/config.php");

        // SE VENGONO APPLICATI I FILTRI DEVO ESSERE SICURO DI SVUOTARE IL CARRELLO
        // PER EVITARE CONFLITTI ($_SESSION['resetCart'] impostata in setFilters.php)

        if( isset($_SESSION['resetCart']) && $_SESSION['resetCart'] == 1 ){
        
            $_SESSION['resetCart'] = 0;
            header("location:emptyCart.php?svuota=1&idUtente=".$_SESSION['IDUtente']);
            exit();
        }

    ?>

<section id="reservationPage">

    <div class="container">
        <div class="row">

            <div class="col-9">
                <div class="container-fluid" >
                    
                    <div class="card text-bg-dark mb-3">
                            <div class="card-body">
                                <h1> IMPOSTA LE TUE PREFERENZE </h1>
                                
                                <?php alert(); ?>

                                <form method="POST" action="setFilters.php" name="filterForm">

                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <label for="IDSede" class="form-label"> Localita </label>
                                            <select class="form-select" aria-label="select example" id="IDSede" name="IDSede">

                                            <?php
                                                // RECUPERO INFORMAZIONI SULLE SEDI DISPONIBILI

                                                $sql = "SELECT Nome, IDSede FROM Sede ORDER BY Nome";
                                                $result = $connessione->query($sql);

                                                if ($result->num_rows > 0) {

                                                    //echo '<option value="all" ' . ($_SESSION['IDSede'] == 'all' ? 'selected' : '') . '>Tutte le sedi</option>';
                                                    while ( $row = $result->fetch_assoc() ) {
                                                        
                                                        $selected = ($_SESSION['IDSede'] == $row["IDSede"]) ? 'selected' : '';
                                                        echo '<option value="' . $row["IDSede"] . '" '. $selected .'>' . $row["Nome"] . '</option>';
                                                    }

                                                } else {

                                                    echo '<option value="nothing" selected> ERRORE </option>';
                                                }

                                            ?>

                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="IDTipo" class="form-label"> Tipologia Veicolo </label>
                                            <select class="form-select" aria-label="select example" id="IDTipo" name="IDTipo">
                                                <option value="0" selected>Qualsiasi</option>
                                                <?php
                                                    $tipologiaVeicolo = $_SESSION['TipologiaVeicolo'];

                                                    // Organizza gli elementi in gruppi in base alla colonna Categoria
                                                    $categorie = array();
                                                    foreach ($_SESSION['TipologiaVeicolo'] as $tipologia) {
                                                        
                                                        $categorie[] = $tipologia['Categoria'];

                                                    }
                                                    $categorie = array_unique($categorie);

                                                    // Stampa gli elementi organizzati nei gruppi
                                                    foreach ($categorie as $categoria) {
                                                        
                                                        echo '<optgroup label="' . htmlspecialchars($categoria) . '">';

                                                        foreach ($tipologiaVeicolo as $tipologia) {

                                                            if( $tipologia['Categoria'] == $categoria ){
                                                                
                                                            $idTipo = $tipologia['IDTipo'];
                                                            $nome = htmlspecialchars($tipologia['Nome']);
                                                            
                                                            $selected = ($_SESSION['IDTipo'] == $idTipo) ? 'selected' : '';

                                                            echo '<option value="' . $idTipo . '" '.$selected.'>' . $nome . '</option>';

                                                            }
                                                        }

                                                        echo '</optgroup>';
                                                    }
                                                ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-4">

                                        <div class="col-md-4">
                                            <label for="DataInizio" class="form-label"> Data di inizio </label>
                                            <input type="date" class="form-control" id="DataInizio" name="DataInizio" 
                                                value="<?php echo isset($_SESSION['DataInizio']) ? $_SESSION['DataInizio'] : date('Y-m-d'); ?>"
                                                min="<?php echo date('Y-m-d'); ?>">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="DataFine" class="form-label"> Data di fine </label>
                                            <input type="date" class="form-control" id="DataFine" name="DataFine"
                                                value="<?php echo isset($_SESSION['DataFine']) ? $_SESSION['DataFine'] : date('Y-m-d'); ?>"
                                                min="" >
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="skipperCheck" id="skipperCheck" 
                                                value="1" <?php echo isset($_SESSION['skipperCheck']) ? 'checked' : ''; ?>
                                                >
                                                <label class="form-check-label" for="skipperCheck"> Ho bisogno di skipper </label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-4"></div>
                                        
                                        <div class="col-4">
                                            <button class="btn btn-primary" type="submit" name="applyFilters"> APPLICA FILTRI </button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div> 
                    </div> 

                    <?php if( !isset($_SESSION['filters']) ) { ?>

                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title"> APPLICA FILTRI PER AVVIARE LA RICERCA </h5>
                            </div>
                        </div>
                        
                    <?php } ?>

                </div>
            </div>  
                        
            <div class="col-3">

                <div class="card" style="max-width: 18rem;">
                    <div class="card-header"> NOTA PER L'UTENTE </div>
                    <div class="card-body">  
                        Il simbolo <i class="fa-solid fa-anchor-circle-exclamation"></i>
                        contrassegna i veicoli che necessitano di personale qualificato
                    </div>
                </div>

            </div>

        </div> 
        

        <div class="row">

            <div class="col-9">
            <?php if( isset($_SESSION['filters']) ) { ?>
                
                <div class="container-fluid" >
                    <?php require_once "getResults.php"; ?>
                </div>

            </div>  <!-- chiusura col-9 -->
            
            <div class="col-3">

                <div class="container-fluid" >

                    <ul class="list-group mb-3">

                        <?php require_once "getCart.php"; ?> 

                    </ul>

                </div>
            </div>


            <?php } ?>  
        </div> 
        

        <!-- MODALE DI CONFERMA SVUOTA CARRELLO -->
        <div class="modal" tabindex="-1" role="dialog" id="ConfermaSvuotaCarrello">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Conferma Svuotamento Carrello</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Sei sicuro di voler svuotare il tuo carrello?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <?php echo '<a href="emptyCart.php?idUtente='.$_SESSION['carrello'].'" class="btn btn-danger">Svuota</a>'?>    
                    </div>
                </div>
            </div>
        </div>

        <!-- MODALE DI CONFERMA PRENOTAZIONE -->
        <div class="modal" tabindex="-1" role="dialog" id="ConfermaPrenotazione">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Conferma Prenotazione</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Stiamo per reindirizzarti alla pagina di conferma.</p>
                        <p>Sei sicuro di voler procedere?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                        <a href="sendReservation.php" class="btn btn-primary">Procedi alla prenotazione</a>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- chiusura container -->
</section>      

    <!-- FOOTER SECTION  -->
    <?php require_once "footer.php"; ?>
    <!-- END FOOTER SECTION  -->

    <?php require_once("js.html"); ?>
    <script src="js/modal.js"></script>
    <script src="js/setFinalDate.js"></script>
</body>
</html>


    