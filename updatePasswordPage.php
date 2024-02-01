<!DOCTYPE html>



<html data-bs-theme="dark">
<head>
    <title>Recupero Password - Seadventures</title>
    
	<?php require_once("style.html"); ?>
</head>

<body>
	<!-- HEADER  -->
    <?php 
        require_once("header.php"); 

        require_once("PHPconfig/config.php");

        
        $IDUtente = null;
        // VERIFICA TOKEN

        // Token da verificare
        $Token = $_GET['token'];

        // Query per recuperare il token dal database
        $getToken = "SELECT * FROM Token WHERE Token = '$Token' AND Usato = FALSE AND DataScadenza > NOW()";

        $result = $connessione->query($getToken);

        if ( $result->num_rows > 0 ) {

            $row = $result->fetch_assoc();

            // Il token è valido

            $IDUtente = $row['IDUtente'];

        } else {

            // Il token non è valido
            header("location:userLoginPage.php?error=Il link per il recupero della password è scaduto");
            exit();
        }
    ?>
    <!-- END HEADER  -->

    <!-- HOME SECTION  -->
    </br></br></br>
    <section>

        <div class="container-sm">
            <div class="row">

                <div class="col-3">
                   
                </div>

                <div class="col-6">
                    <h1> CAMBIA PASSWORD </h1>

                    <?php alert(); ?>
                    
                    <form class="row g-3" method="POST" action="updatePassword.php" onsubmit="return verificaPassword();" >

                        <input type="hidden" name="IDUtente" 
                        value="<?php echo $IDUtente; ?>">

                        <input type="hidden" name="Token" 
                        value="<?php echo $Token; ?>">

                        <div class="row mt-3 mb-3">

                            <div class="col-md-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password1" required>
                            </div>

                            <div class="col-md-4">
                                <label for="password2" class="form-label">Conferma Password</label>
                                <input type="password" class="form-control" id="password2" name="password2" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit"> CAMBIA PASSWORD </button>
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
    <script>
        function verificaPassword() {
            // Ottieni i valori dai campi di password
            var password = document.getElementById('password1').value;
            var confermaPassword = document.getElementById('password2').value;

            // Verifica se le password sono uguali
            if (password === confermaPassword) {
                // Le password sono uguali, esegui azioni desiderate
                //alert('Le password sono uguali!');

            } else {
                // Le password non sono uguali, mostra un messaggio di errore
                alert('Le password non corrispondono. Riprova.');
            }
        }
    </script>
    
</body>
</html>


