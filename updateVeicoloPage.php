<!DOCTYPE html>



<html data-bs-theme="dark">

<head>
    <title>Modifica Veicolo - Seadventures</title>
    
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
                                
            $IDVeicolo = $_GET['ID'];
            
            $selectVeicolo = "SELECT * FROM Veicolo WHERE IDVeicolo = $IDVeicolo";

            if( $result = $connessione->query($selectVeicolo) ) {    
        
                if ( $result->num_rows == 1 ) {

                    $veicolo = $result->fetch_assoc();

                    $IDSede = $veicolo['IDSede'];

                    // NON POSSIAMO MODIFICARE VEICOLI DI UN'ALTRA SEDE
                    if( $_SESSION['IDSede'] != $IDSede ){

                        header("location: adminManagementPage.php");
                        exit();
                    }

                    $nome = $veicolo['Nome'];
                    $costo = $veicolo['CostoGiornaliero'];
                    $descrizione = $veicolo['Descrizione'];
                    $tipo = $veicolo['IDTipo'];

                    $checked = ($veicolo['SkipperSI'] == 1) ? 'checked' : '' ;
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
                    <h1> AGGIORNA I DATI DEL VEICOLO </h1>

                    <form method="POST" action="updateVeicolo.php" enctype="multipart/form-data">
                        
                        <?php alert(); ?>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="IDVeicolo" class="form-label"> ID VEICOLO </label>
                                <input type="number" class="form-control" id="IDVeicolo" name="IDVeicolo" 
                                <?php echo 'value ="'.$IDVeicolo.'"'; ?>
                                readonly>
                            </div>
                            <div class="col-md-5">
                                <label for="nome" class="form-label"> Nome </label>
                                <input type="text" class="form-control" id="nome" name="nome" 
                                <?php echo 'value ="'.$nome.'"'; ?>
                                required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="tipo" class="form-label"> Tipologia Veicolo </label>
                                <select class="form-select" aria-label="select example" id="tipo" name="tipo">
                                    <!-- <option value="" disabled selected>Scegli...</option> -->
                                    <?php
                                        $tipologiaVeicolo = $_SESSION['TipologiaVeicolo']; // ROWS DELLE TIP. VEICOLI

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
                                                    $selected = ($tipo == $idTipo) ? 'selected' : '';
                                                    $nome = htmlspecialchars($tipologia['Nome']);
                                                    echo '<option value="' . $idTipo . '"'.$selected.'>' . $nome . '</option>';

                                                }
                                            }

                                            echo '</optgroup>';
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="descrizione" class="form-label">Descrizione</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="descrizione" name="descrizione" 
                                required><?php echo $descrizione; ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="costo" class="form-label"> Costo Giornaliero (€) </label>
                                <input type="number" class="form-control" id="costo" name="costo" step="any" min="0" 
                                <?php echo 'value ="'.$costo.'"'; ?>
                                required>
                            </div>
                            <div class="col-md-5 mt-3">
                                <div class="form-check">
                                    <label class="form-check-label" for="SkipperSI">
                                        <input class="form-check-input" type="checkbox" name="SkipperSI" id="SkipperSI" value="1" <?php echo $checked; ?>>
                                        Necessita skipper 
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3"></div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <button class="btn btn-primary" type="submit"> MODIFICA VEICOLO </button>
                            </div>
                        </div>

                    </form>

                    <div class="container mt-5">
                        <button class="btn btn-danger" onclick="conferma('ConfermaRimozioneVeicolo')"> RIMUOVI VEICOLO </button>
                    </div>

                </div>  

                <div class="col-3">
                    
                </div>
            
            </div> 
                

            <!-- MODALE DI CONFERMA RIMOZIONE VEICOLO -->
            <div class="modal" tabindex="-1" role="dialog" id="ConfermaRimozioneVeicolo">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Conferma Rimozione</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Questa azione è irreversibile e causerà la perdita delle informazioni riguardanti questo veicolo, sei sicuro?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <?php echo '<a href="removeVeicoloFromSede.php?ID='.$IDVeicolo.'" class="btn btn-danger">Rimuovi</a>'?>    
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

</body>
</html>

