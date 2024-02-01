<!DOCTYPE html>



<html data-bs-theme="dark">

<head>
    <title>Registra Veicolo - Seadventures</title>
    
	<?php require_once("style.html"); ?>
</head>

<body>
    <!-- HEADER  -->
    <?php
        require_once("header.php"); 
        // END HEADER

        adminCheck();
        
        require_once("PHPconfig/config.php");
    ?>

    <!-- HOME SECTION  -->
    </br>
    <section>

        <div class="container">

            <div class="row">

                <div class="col-3">
                </div>

                <div class="col-6 text-center">
                    <h1> INSERISCI I DATI DEL VEICOLO </h1>

                    <form method="POST" action="insertVeicolo.php" enctype="multipart/form-data">
                        
                        <?php alert(); ?>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="nome" class="form-label"> Nome </label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="col-md-5">
                                <label for="descrizione" class="form-label">Descrizione</label>
                                <textarea class="form-control" rows="3" id="descrizione" name="descrizione" required></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="tipo" class="form-label"> Tipologia Veicolo </label>
                                <select class="form-select" aria-label="select example" id="tipo" name="tipo">
                                    <!-- <option value="" disabled selected>Scegli...</option> -->
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
                                                echo '<option value="' . $idTipo . '">' . $nome . '</option>';

                                                }
                                            }
                                            echo '</optgroup>';
                                        }
                                    ?>
                                    
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label for="costo" class="form-label"> Costo Giornaliero (€) </label>
                                <input type="number" class="form-control" id="costo" name="costo" step="any" min="0" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="immagine" class="form-label"> Immagine Veicolo </label>
                                <input type="file" class="form-control" id="immagine" name="immagine" accept="image/*" required>
                            </div>
                            <div class="col-md-5 mt-3">
                                <div class="form-check">
                                    <label class="form-check-label" for="SkipperSI">
                                        <input class="form-check-input" type="checkbox" name="SkipperSI" id="SkipperSI" value="1">
                                        Necessita skipper 
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3"></div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <button class="btn btn-primary" type="submit"> REGISTRA VEICOLO </button>
                            </div>
                        </div>

                    </form>

                </div>  

                <div class="col-3">
                </div>

            </div> 
        </div>

    </section>                                      
    <!-- END HOME SECTION  -->
   
	<!-- FOOTER SECTION  -->
    <?php //require_once "footer.php"; ?>
    <!-- END FOOTER SECTION  -->
    
    <?php require_once("js.html"); ?>
</body>
</html>

