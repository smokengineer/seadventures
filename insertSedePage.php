<!DOCTYPE html>

<html data-bs-theme="dark">

<head>
    <title>Nuova Sede - Seadventures</title>
    
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
    </br>
    <section>

        <div class="container">

            <div class="row">

                <div class="col-3">
                </div>

                <div class="col-6 text-center">
                    <h1> INSERISCI I DATI DELLA NUOVA SEDE </h1>

                    <form method="POST" action="insertSede.php">
                        
                        <?php alert(); ?>

                        
                        <div class="row mb-3 mt-3">
                            <div class="col-md-4">
                                <label for="localita" class="form-label"> Località </label>
                                <input type="text" class="form-control" id="localita" name="localita" required>
                            </div>
                        </div>

                        <p class="h3 mt-3 mb-3"> Contatti </p>
                        <div class="row mb-3 mt-3">

                            <div class="col-md-3">
                                <label for="prefisso" class="form-label"> Prefisso </label>
                                <select class="form-control" id="prefisso" name="prefisso" readonly>
                                    <option value="+39" selected>+39 (Italia)</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="phone" class="form-label"> Telefono </label>
                                <input type="phone" class="form-control" id="phone" name="phone" required>
                            </div>
                
                            <div class="col-md-5">
                                <label for="email" class="form-label"> E-Mail </label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <p class="h3 mt-3 mb-3"> Indirizzo </p>
                        <div class="row mb-3 mt-3">
                            <div class="col-md-6">
                                <label for="citta" class="form-label"> Citta </label>
                                <input type="text" class="form-control" id="citta" name="citta" required>
                            </div>
                            <div class="col-md-4">
                                <label for="cap" class="form-label"> CAP </label>
                                <input type="text" class="form-control" id="cap" name="cap" pattern="\d{5}" maxlength="5" required>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="col-md-3">
                                
                                <label for="tipoIndirizzo" class="form-label">Tipo Indirizzo</label>
                                <select class="form-select" id="tipoIndirizzo" name="tipoIndirizzo" required>
                                    <!-- <option value="" disabled selected>Scegli...</option> -->
                                    <option value="Via" selected>Via</option>
                                    <option value="Viale">Viale</option>
                                    <option value="Piazza">Piazza</option>
                                    <option value="Strada">Strada</option>
                                    <option value="Corso">Corso</option>
                                    <option value="Largo">Largo</option>
                                    <option value="Borgo">Borgo</option>
                                    <option value="Lungomare">Lungomare</option>
                                </select>
                                
                            </div>
                            <div class="col-md-5">
                                <label for="nomeStrada" class="form-label"> Nome Strada</label>
                                <input type="text" class="form-control" id="nomeStrada" name="nomeStrada" required>
                            </div>
                            <div class="col-md-4">
                                <label for="civico" class="form-label"> Civico </label>
                                <input type="text" class="form-control" id="civico" name="civico" pattern="^\d{1,3}$" maxlength="3" required>
                            </div>
                            
                        </div>

                        <div class="row mb-3 mt-3"></div>

                        <div class="row mb-3 mt-3">
                            <div class="col-md-5">
                                <button class="btn btn-primary" type="submit"> REGISTRA NUOVA SEDE </button>
                            </div>
                        </div>

                    </form>

                </div>  

                <div class="col-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
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

    <?php require_once("js.html"); ?>
</body>
</html>

