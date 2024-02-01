<!DOCTYPE html>



<html data-bs-theme="dark">
<head>
    <title>Prenotazioni - Seadventures</title>
    
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

    <section>
        <div class="container">

            <div class="row mb-3">
                <div class="col-1">
                </div>

                <div class="col-10">

                    <?php alert(); ?>

                    <div class="container-fluid" >
                        <div class="card text-bg-info mb-3">
                            <div class="card-body text-center">
                                <h2 class="card-title"><i class="fa-solid fa-pen-to-square"></i> PRENOTAZIONI REGISTRATE </h2>
                            </div>
                        </div>   

                        <?php require_once("getAdminReservation.php"); ?>      

                    </div>

                </div> <!-- chiusura col-10 -->
                
                <div class="col-1"></div> 
            </div> 

        </div> <!-- chiusura container -->
    </section>      

    <!-- FOOTER SECTION  -->
    <?php require_once "footer.php"; ?>
    <!-- END FOOTER SECTION  -->

    <?php require_once("js.html"); ?>
</body>
</html>