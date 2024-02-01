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
        if( isset($_SESSION['Email']) ){

            unset($_SESSION['Email']);
        }
    ?>
    <!-- END HEADER  -->
    
    <!-- HOME SECTION  -->
    </br></br></br>
    <section id="loginPage">

        <div class="container-sm">
            <div class="row">

                <div class="col-3">
                </div>

                <div class="col-6">

                    <h1>ACCESSO DIPENDENTE</h1>
                    <form class="row g-3" method="POST" action="accessoDipendente.php" name="loginForm" onsubmit="return validateForm();">

                        <?php alert(); ?>

                        <div class="col-md-4">
                            <label for="email" class="form-label">E-Mail</label>
                            <input type="email" class="form-control" id="email" name="email" required
                            value="<?php echo isset($_SESSION['adminEmail']) ? $_SESSION['adminEmail'] : ''; ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">LOG IN</button>
                        </div>
                        
                        <!-- <h6>Le tue credenziali ti sono state fornite direttamente dal sistema</h6> -->
                        </br>
                    </form>
                    
                </div>  

                <div class="col-3">
                    <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                        <!-- <div class="card-header">Header</div> -->
                        <div class="card-body">
                            <h5 class="card-title">NOTA</h5>
                            <p class="card-text">Le tue credenziali ti sono state fornite direttamente dall'Admin</p>
                        </div>
                    </div>
                </div>

            </div> 
        </div>

    </section>
    <!-- END HOME SECTION  -->

	<!-- FOOTER SECTION  -->
    <?php //require_once("footer.php"); ?>
    <!-- END FOOTER SECTION  -->

    <?php require_once("js.html"); ?>
</body>
</html>


