<!DOCTYPE html>



<html data-bs-theme="dark">

<head>
    <title>Modifica Skipper - Seadventures</title>
    
	<?php require_once("style.html"); ?>
</head>

<body>
        <!-- HEADER  -->
    <?php
        require_once("header.php"); 
        // END HEADER

        adminCheck();
        
        require_once("PHPconfig/config.php");

        if( isset($_GET['ID']) ){
                                
            $IDSkipper = $_GET['ID'];
            
            $selectSkipper = "SELECT * FROM Skipper WHERE IDSkipper = $IDSkipper";

            if( $result = $connessione->query($selectSkipper) ) {    
        
                if ( $result->num_rows == 1 ) {

                    $skipper = $result->fetch_assoc();

                    $IDSede = $skipper['IDSede'];

                    // NON POSSIAMO MODIFICARE SKIPPER DI UN'ALTRA SEDE
                    if( $_SESSION['IDSede'] != $IDSede ){

                        header("location: adminManagementPage.php");
                    }

                    $nome = $skipper['Nome'];
                    $cognome = $skipper['Cognome'];
                    $costo = $skipper['CostoGiornaliero'];
                    $descrizione = $skipper['Descrizione'];
                    $datanascita = $skipper['DataNascita'];
                    $esperienza = $skipper['Esperienza'];
                }
            }
            
        } else {

            header("location: index.php");
            exit();
        }
    ?>

    <!-- HOME SECTION  -->
    </br>
    <section>

        <div class="container">

            <div class="row">

                <div class="col-3">
                </div>

                <div class="col-6 text-center">
                    <h1> AGGIORNA I DATI DELLO SKIPPER </h1>

                    <form method="POST" action="updateSkipper.php" enctype="multipart/form-data">
                        
                        <?php alert(); ?>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="IDSkipper" class="form-label"> ID SKIPPER </label>
                                <input type="number" class="form-control" id="IDSkipper" name="IDSkipper" 
                                <?php echo 'value ="'.$IDSkipper.'"'; ?>
                                readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="nome" class="form-label"> Nome </label>
                                <input type="text" class="form-control" id="nome" name="nome" 
                                <?php echo 'value ="'.$nome.'"'; ?>
                                required>
                            </div>
                            <div class="col-md-5">
                                <label for="cognome" class="form-label"> Cognome </label>
                                <input type="text" class="form-control" id="cognome" name="cognome" 
                                <?php echo 'value ="'.$cognome.'"'; ?>
                                required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="descrizione" class="form-label">Descrizione</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="descrizione" name="descrizione" 
                                required><?php echo $descrizione; ?></textarea>
                            </div>
                            <div class="col-md-5">
                                <label for="costo" class="form-label"> Costo Giornaliero (€) </label>
                                <input type="number" class="form-control" id="costo" name="costo" step="any" min="0" 
                                <?php echo 'value ="'.$costo.'"'; ?>
                                required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="datanascita" class="form-label"> Data di nascita </label>
                                <input type="date" class="form-control" id="datanascita" name="datanascita" max="" 
                                <?php echo 'value ="'.$datanascita.'"'; ?>
                                required>
                            </div>
                            <div class="col-md-5">
                                <label for="esperienza" class="form-label"> Esperienza </label>
                                <input type="range" class="form-range" min="1" max="10" id="esperienza" name="esperienza"
                                <?php echo 'value ="'.$esperienza.'"'; ?>
                                required>
                                <span id="valoreEsperienza"> <?php echo $esperienza; ?> </span>
                            </div>
                        </div>

                        <div class="row mb-3"></div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <button class="btn btn-primary" type="submit"> MODIFICA SKIPPER </button>
                            </div>
                        </div>

                    </form>

                    <div class="container mt-5">
                        <button class="btn btn-danger" onclick="conferma('ConfermaRimozioneSkipper')"> RIMUOVI SKIPPER </button>
                    </div>

                </div>  

                <div class="col-3">
                    
                </div>
            
            </div> 
                

            <!-- MODALE DI CONFERMA RIMOZIONE SKIPPER -->
            <div class="modal" tabindex="-1" role="dialog" id="ConfermaRimozioneSkipper">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Conferma Rimozione</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Questa azione è irreversibile e causerà la perdita delle informazioni riguardanti questo skipper, sei sicuro?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <?php echo '<a href="removeSkipperFromSede.php?ID='.$IDSkipper.'" class="btn btn-danger">Rimuovi</a>'?>    
                        </div>
                    </div>
                </div>
            </div>

            
        </div>

    </section>                                      
    <!-- END HOME SECTION  -->
   
	<!-- FOOTER SECTION  -->
    <?php //require_once "footer.php"; ?>
    <!-- END FOOTER SECTION  -->
    
    <?php require_once("js.html"); ?>

    <script src="js/modal.js"></script>

    <script>
        var rangeEsperienza = document.getElementById('esperienza');
        var spanValoreEsperienza = document.getElementById('valoreEsperienza');

        // Aggiunge un listener per l'evento change sull'input range
        rangeEsperienza.addEventListener('input', function() {
            // Aggiorna il valore nell'elemento span
            spanValoreEsperienza.textContent = rangeEsperienza.value;
        });
    </script>

    <script>
        // Ottieni l'elemento input date
        var inputDataNascita = document.getElementById('datanascita');

        // Calcola la data minima per essere maggiorenni (18 anni fa dalla data corrente)
        var dataMassima = new Date();
        dataMassima.setFullYear(dataMassima.getFullYear() - 18);

        // Formatta la data minima nel formato "YYYY-MM-DD"
        var dataMassimaFormatted = dataMassima.toISOString().split('T')[0];

        // Imposta il valore minimo dell'input date alla data minima
        inputDataNascita.max = dataMassimaFormatted;
    </script>

</body>
</html>

