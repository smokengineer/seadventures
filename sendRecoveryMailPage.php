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
        if( isset($_SESSION['adminEmail']) ){

            unset($_SESSION['adminEmail']);
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
                    <h1> RECUPERA PASSWORD </h1>

                    <?php alert(); ?>
                    
                    <form class="row g-3" method="POST" action="sendRecoveryMail.php">

                        <div class="col-md-4">
                            <label for="email" class="form-label">E-Mail</label>
                            <input type="email" class="form-control" id="email" name="email" required
                            value="<?php echo isset($_SESSION['Email']) ? $_SESSION['Email'] : ''; ?>" >
                        </div>
                        
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">INVIA MAIL DI RECUPERO</button>
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


