<!DOCTYPE html>

<html data-bs-theme="dark">
<head>
    <title>Gestione - Seadventures</title>
    
	<?php require_once("style.html"); ?>
</head>

<body>
	    <!-- HEADER  -->
    <?php
        require_once("header.php"); 
        // END HEADER

        // CONTROLLO DIRITTI SUPER ADMIN
        if ( ! isset( $_SESSION['adm'] ) ) {

            header("location: index.php");
            exit();
        }

        require_once("PHPconfig/config.php");
        require_once("PHPconfig/tempConfig.php");
        require_once("printFunctions.php");
    ?>

    <section>
        <div class="container">

            <div class="row mb-3">
                <div class="col-1">
                </div>

                <div class="col-10">
                    <?php alert(); ?>
                </div>

                <div class="col-1"></div>
            </div> 
            
            <div class="row mb-3">
                
                <div class="col-1"></div>

                <div class="col-10">
                    <div class="container-fluid">
                        <div class="card text-bg-info mb-3">
                            <div class="card-body text-center">
                                <h1> GESTIONE RESPONSABILI </h1>        
                            </div>
                        </div>  
                   
                        <?php
                        // RECUPERO TUTTI GLI ID E I NOMI DELLE SEDI
                        $selectSedi = "SELECT Nome, IDSede FROM Sede";
                        
                        $sedi = array();

                        if ( $res =  mysqli_query($connessione, $selectSedi) ) {

                            while ( $row = $res->fetch_assoc() ) {

                                $sedi[$row["IDSede"]] = $row["Nome"];
                            }

                        }
                        
                        // QUERY PER I RESPONSABILI
                        $selectResponsabili =
                        "SELECT * FROM Responsabile WHERE IDResponsabile <> ".$_SESSION['IDResponsabile']." AND IDResponsabile <> 0 ;";

                        if($result = $connessione->query($selectResponsabili)) {    
                            
                            // VERIFICA SE CI SONO RISULTATI
                            if ( $result->num_rows > 0 ) {

                                echo '<div class="accordion" id="Responsabili">';

                                // STAMPA I DATI DI OGNI RIGA
                                while ( $row = $result->fetch_assoc() ) {
                                    
                                    printItemResponsabile($row, $sedi);
                                }

                                echo '</div>'; // CHIUDE ACCORDION PARENT

                                ////////////////
                                echo '<div class="card mt-3 mb-3 text-center" style="max-width:20rem">';   
                                    echo '<div class="card-header"> <strong> REGISTRA RESPONSABILE </strong> </div>';
                                    echo '<div class="card-body">';
                                        echo '<button class="btn btn-primary"> <a href="adminSignupPage.php" class="btn"> NUOVO RESPONSABILE  </a></button>';
                                    echo '</div>';
                                echo '</div>';
                                ////////////////

                            } else {
                                
                                printMessage("NESSUN RESPONSABILE...");
                            }

                        } else {

                            header("location:adminManagementPage.php?error=Errore in fase di recupero dei dati responsabile");
                            exit();
                        }

                        ?>   
                    </div> 
                </div> 
                
                <div class="col-1"></div> 
            </div>

            <div class="row mb-3">
                
                <div class="col-1"></div>

                <div class="col-10">
                    <div class="container-fluid">
                        <div class="card text-bg-info mb-3">
                            <div class="card-body text-center">
                                <h1> GESTIONE SEDI </h1>        
                            </div>
                        </div>  
                        <?php 
                        // QUERY PER LE SEDI
                        $selectSedi =
                        "SELECT * FROM Sede;";

                        if($result = $connessione->query($selectSedi)) {    
                            
                            // VERIFICA SE CI SONO RISULTATI
                            if ( $result->num_rows > 0 ) {

                                echo '<div class="accordion" id="Sedi">';

                                // STAMPA I DATI DI OGNI RIGA
                                while ( $row = $result->fetch_assoc() ) {
                                    
                                    // RESPONSABILI ASSOCIATI ALLA SEDE
                                    $IDSede = $row['IDSede'];
                                    $selectResp = "SELECT * FROM Responsabile WHERE IDSede = $IDSede ORDER BY IDResponsabile;";
                                    $responsabili = array();

                                    if ( $resp =  mysqli_query($connessione2, $selectResp) ) {
                            
                                        while ( $responsabile = $resp->fetch_assoc() ) {
                                            
                                            $responsabili[] = $responsabile;

                                        }
                            
                                    }

                                    printItemSede($row, $responsabili);
                                }

                                echo '</div>'; // CHIUDE ACCORDION PARENT

                                ////////////////
                                echo '<div class="card mt-3 mb-3 text-center" style="max-width:20rem">';   
                                    echo '<div class="card-header"> <strong> REGISTRA SEDE </strong> </div>';
                                    echo '<div class="card-body">';
                                        echo '<button class="btn btn-primary"> <a href="insertSedePage.php" class="btn"> NUOVA SEDE  </a></button>';
                                    echo '</div>';
                                echo '</div>';
                                ////////////////

                            } else {
                                
                                printMessage("NESSUNA SEDE...");
                            }

                        } else {

                            header("location:adminManagementPage.php?error=Errore in fase di recupero dei dati sede");
                            exit();
                        }
                        ?>   
                    </div> 
                </div> 
                
                <div class="col-1"></div> 
            </div>
                    
        <!-- MODALE DI CAMBIO SEDE -->
        <div class="modal" tabindex="-1" role="dialog" id="SceltaSede">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Scelta Sede di riferimento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="cambioSede.php">
                        <div class="modal-body">
                            <p>Scegli tra le sedi disponibili quale associare al responsabile</p>
                            <!-- <p>Sei sicuro di voler procedere al pagamento?</p> -->
                            
                            <div class="row mb-3 mt-3">
                                
                                <div class="col-md-5">
                                    <!-- <label for="sede" class="form-label"> Sede di Riferimento </label> -->
                                    <select class="form-select" aria-label="select example" id="sede" name="sede">

                                    <?php
                                        // RECUPERO INFORMAZIONI SULLE SEDI DISPONIBILI

                                        $sql = "SELECT Nome, IDSede FROM Sede ORDER BY Nome";
                                        $result = mysqli_query($connessione, $sql);

                                        if ($result->num_rows > 0) 
                                            while ( $row = $result->fetch_assoc() ) 
                                                echo '<option value="'. $row["IDSede"] .'">' . $row["Nome"] . '</option>';
                                        else 
                                            echo '<option value="nothing" selected> ERRORE </option>';
                                        
                                    ?>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <!-- <label for="IDResp" class="form-label">IDResp</label> -->
                                    <input type="text" class="form-control" id="IDResp" name="IDResp" hidden>
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <button class="btn btn-primary" type="submit"> Conferma </button>
                        </div>
                    </form>   

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
</body>
</html>