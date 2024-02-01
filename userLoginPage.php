<!DOCTYPE html>



<html data-bs-theme="dark">
<head>
    <title>Log IN - Seadventures</title>
    
	<?php require_once("style.html"); ?>
</head>

<body>
	<!-- HEADER  -->
    <?php 
        require_once("header.php"); 
        if( isset($_SESSION['adminEmail']) ){

            unset($_SESSION['adminEmail']);
        }
    ?>
    <!-- END HEADER  -->

    <!-- HOME SECTION  -->
    </br></br></br>
    <section id="loginPage">

        <div class="container-sm">
            <div class="row">

                <div class="col-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Password dimenticata?</h5>
                            <p class="card-text"><a style="color: white" href="sendRecoveryMailPage.php"> RECUPERA </a></p>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <h1>ACCESSO UTENTE</h1>

                    <?php alert(); ?>
                    
                    <form class="row g-3" method="POST" action="accessoUtente.php" name="loginForm" onsubmit="return validateForm();">

                        <div class="col-md-4">
                            <label for="email" class="form-label">E-Mail</label>
                            <input type="email" class="form-control" id="email" name="email" required
                            value="<?php echo isset($_SESSION['Email']) ? $_SESSION['Email'] : ''; ?>" >

                        </div>
                        <div class="col-md-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">LOG IN</button>
                        </div>
                        
                    </form>

                </div>  

                <div class="col-3">

                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Non hai le credenziali?</h5>
                            <p class="card-text"><a style="color: white" href="userSignupPage.php"> SIGN-UP </a></p>
                        </div>
                    </div>

                    <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Sei un dipendente?</h5>
                            <p class="card-text"><a style="color: white" href="adminLoginPage.php"> ACCEDI QUI </a></p>
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
    <script src="js/formValidation.js"></script>
</body>
</html>


