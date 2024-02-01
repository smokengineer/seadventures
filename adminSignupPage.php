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
        // END HEADER

        // CONTROLLO DIRITTI SUPER ADMIN
        if ( ! isset( $_SESSION['adm'] ) ) {

            header("location: index.php");
            exit();
        }
        
        require_once("PHPconfig/config.php");
    ?>

    <!-- HOME SECTION  -->
    </br>
    <section id="signupPage">

        <div class="container">
            <div class="row">

                <div class="col-3">
                </div>

                <div class="col-6">

                    <h1> INSERISCI I DATI DEL DIPENDENTE </h1>
                    <form method="POST" action="registraDipendente.php" name="signupForm">

                        <?php alert(); ?>
 
                        <div class="row mb-3 mt-3">
                            <div class="col-md-5">
                                <label for="nome" class="form-label"> Nome </label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="col-md-5">
                                <label for="cognome" class="form-label"> Cognome </label>
                                <input type="text" class="form-control" id="cognome" name="cognome" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-3">
                            <div class="col-md-5">
                                <label for="datanascita" class="form-label"> Data di nascita </label>
                                <input type="date" class="form-control" id="datanascita" name="datanascita" required>
                            </div>
                            <div class="col-md-5">
                                <label for="codicefiscale" class="form-label"> Codice Fiscale </label>
                                <input type="text" class="form-control" id="codicefiscale" name="codicefiscale" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-3">
                            <div class="col-md-5">
                                <label for="sede" class="form-label"> Sede di Riferimento </label>
                                <select class="form-select" aria-label="select example" id="sede" name="sede">

                                <?php
                                    // RECUPERO INFORMAZIONI SULLE SEDI DISPONIBILI

                                    $sql = "SELECT Nome, IDSede FROM Sede ORDER BY Nome";
                                    $result = mysqli_query($connessione, $sql);

                                    if ($result->num_rows > 0) {

                                        while ( $row = $result->fetch_assoc() ) {

                                            echo '<option value="'. $row["IDSede"] .'">' . $row["Nome"] . '</option>';
                                        }

                                    } else {

                                        echo '<option value="nothing" selected> ERRORE </option>';
                                    }

                                ?>

                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-3">
                            <div class="col-md-5">
                                <label for="email" class="form-label">E-Mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-5">
                                <label for="confirmEmail" class="form-label">Conferma E-Mail</label>
                                <input type="text" class="form-control" id="confirmEmail" name="confirmEmail" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-3">
                            <div class="col-md-5">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password1" required>
                            </div>
                            <div class="col-md-5">
                                <label for="confirmPassword" class="form-label">Conferma Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="password2" required>
                            </div>
                        </div>

                        <!-- <div class="row mb-3"></div> -->

                        <div class="row mb-3 mt-3">
                            <div class="col-md-5">
                                <div class="form-check">
                                <label class="form-check-label" for="adminCheck"> Concedi privilegi amministrativi a questo responsabile </label>
                                <input class="form-check-input" type="checkbox" value="" name = "adminCheck" id="adminCheck">
                                </div>
                            </div>
                            

                            <div class="col-md-5">
                                <button class="btn btn-primary" type="submit"> REGISTRA DIPENDENTE </button>
                            </div>

                        </div>
                    </form>

                </div>  

                <div class="col-3"></div>

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

