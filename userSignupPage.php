<!DOCTYPE html>



<html data-bs-theme="dark">

<head>
    <title>Sign UP - Seadventures</title>
    
	<?php require_once("style.html"); ?>
</head>

<body>
	<!-- HEADER  -->
    <?php   
        require_once("header.php"); 
        if( isset($_SESSION['Email']) ){

            unset($_SESSION['Email']);
        }
    ?>
    <!-- END HEADER  -->

    <!-- HOME SECTION  -->
    </br>
    <section id="signupPage">

        <div class="container">
            <div class="row">

                <div class="col-3">
                </div>

                <div class="col-6">

                    <h1> INSERISCI I TUOI DATI </h1>
                    <form method="POST" action="registraUtente.php" name="signupForm">

                        <?php alert(); ?>

                        <div class="row  mb-3">
                            <div class="col-md-4">
                                <label for="nome" class="form-label"> Nome </label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="col-md-4">
                                <label for="cognome" class="form-label"> Cognome </label>
                                <input type="text" class="form-control" id="cognome" name="cognome" required>
                            </div>
                            <div class="col-md-4">
                                <label for="datanascita" class="form-label"> Data di nascita </label>
                                <input type="date" class="form-control" id="datanascita" name="datanascita" required>
                            </div>
                        </div>

                        <div class="row  mb-3">
                            
                            <div class="col-md-4">
                                <label for="codicefiscale" class="form-label"> Codice Fiscale </label>
                                <input type="text" class="form-control" id="codicefiscale" name="codicefiscale" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="prefisso" class="form-label"> Prefisso </label>
                                <select class="form-control" id="prefisso" name="prefisso" required>
                                    <option value="+1">+1 (USA)</option>
                                    <option value="+44">+44 (Regno Unito)</option>
                                    <option value="+39" selected>+39 (Italia)</option>
                                    <option value="+33">+33 (Francia)</option>
                                    <option value="+81">+81 (Giappone)</option>
                                    <option value="+86">+86 (Cina)</option>
                                    <option value="+49">+49 (Germania)</option>
                                    <option value="+91">+91 (India)</option>
                                    <option value="+7">+7 (Russia)</option>
                                    <option value="+82">+82 (Corea del Sud)</option>
                                    <option value="+34">+34 (Spagna)</option>
                                    <option value="+65">+65 (Singapore)</option>
                                    <option value="+61">+61 (Australia)</option>
                                    <option value="+27">+27 (Sudafrica)</option>
                                    <option value="+52">+52 (Messico)</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="phone" class="form-label"> Telefono </label>
                                <input type="phone" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>

                        <div class="row  mb-3">
                            <div class="col-md-6">
                                <label for="citta" class="form-label"> Citta </label>
                                <input type="text" class="form-control" id="citta" name="citta" required>
                            </div>
                        </div>
                        <div class="row  mb-3">
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
                            <div class="col-md-3">
                                <label for="nomeStrada" class="form-label"> Nome </label>
                                <input type="text" class="form-control" id="nomeStrada" name="nomeStrada" required>
                            </div>
                            <div class="col-md-3">
                                <label for="civico" class="form-label"> Civico </label>
                                <input type="text" class="form-control" id="civico" name="civico" pattern="^\d{1,3}$" maxlength="3" required>
                            </div>
                            <div class="col-md-3">
                                <label for="cap" class="form-label"> CAP </label>
                                <input type="text" class="form-control" id="cap" name="cap" pattern="\d{5}" maxlength="5" required>
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="email" class="form-label">E-Mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-4">
                                <label for="confirmEmail" class="form-label">Conferma E-Mail</label>
                                <input type="text" class="form-control" id="confirmEmail" name="confirmEmail" required>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-md-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password1" required>
                            </div>
                            <div class="col-md-4">
                                <label for="confirmPassword" class="form-label">Conferma Password</label>
                                <input type="password" class="form-control" id="password2" name="password2" required>
                            </div>
                        </div>
                        </br>
                        <div class="row  mb-3">
                            <div class="col-4">
                                <button class="btn btn-primary" type="submit"> REGISTRAMI </button>
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                <label class="form-check-label" for="invalidCheck2"> Accetto i termini e le condizioni </label>
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>  

                <div class="col-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Hai già un account?</h5>
                            <p class="card-text"><a href="userLoginPage.php" style="color: white"> ACCEDI </a></p>
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
</body>
</html>

