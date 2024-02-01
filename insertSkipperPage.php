<!DOCTYPE html>



<html data-bs-theme="dark">

<head>
    <title>Registra Skipper - Seadventures</title>
    
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
                    <h1> INSERISCI I DATI DELLO SKIPPER </h1>

                    <form method="POST" action="insertSkipper.php" enctype="multipart/form-data">
                        
                        <?php alert(); ?>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="nome" class="form-label"> Nome </label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="col-md-5">
                                <label for="cognome" class="form-label"> Cognome </label>
                                <input type="text" class="form-control" id="cognome" name="cognome" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="descrizione" class="form-label">Descrizione</label>
                                <textarea class="form-control" rows="3" id="descrizione" name="descrizione" required></textarea>
                            </div>

                            <div class="col-md-5">
                                <label for="costo" class="form-label"> Costo Giornaliero (€) </label>
                                <input type="number" class="form-control" id="costo" name="costo" step="any" min="0" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="datanascita" class="form-label"> Data di nascita </label>
                                <input type="date" class="form-control" id="datanascita" name="datanascita" max="" required>
                            </div>
                            <div class="col-md-5">
                                <label for="esperienza" class="form-label"> Esperienza </label>
                                <input type="range" class="form-range" min="1" max="10" id="esperienza" name="esperienza" value="1" required>
                                <span id="valoreEsperienza"> 1 </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="immagine" class="form-label"> Immagine Skipper </label>
                                <input type="file" class="form-control" id="immagine" name="immagine" accept="image/*" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3"></div>

                        <div class="row mb-3">
                            <div class="col-md-5">
                                <button class="btn btn-primary" type="submit"> REGISTRA SKIPPER </button>
                            </div>
                        </div>

                    </form>

                </div>  

                <div class="col-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <!-- <div class="card-header">Header</div> -->
                        <div class="card-body">
                            <h5 class="card-title">TEST</h5>
                            <p class="card-text">TEST</p>
                            <p class="card-text"><a href="#" style="color: white"> TEST </a></p>
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

    <?php require_once("js.html"); ?>
</body>
</html>

