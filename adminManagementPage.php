<!DOCTYPE html>



<html data-bs-theme="dark">
<head>
    <title>Gestione - Seadventures</title>
    
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
                        <div class="card text-bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-user"></i> INFO RESPONSABILE </h5>
                            </div>
                        </div>   
                        <?php require_once("getAdminInfo.php"); ?>                  
                    </div>
                </div> <!-- chiusura col-10 -->

                <div class="col-1"></div>
            </div> 

            <div class="row mb-3">
                <div class="col-1"></div>

                <div class="col-10">
                    <div class="container-fluid" >
                        <div class="card text-bg-info mb-3">
                            <div class="card-body text-center">
                                <h1> GESTIONE VEICOLI </h1>        
                            </div>
                        </div>  
                        
                        <?php require_once("getVeicoli.php"); ?>   
                        
                    </div> 
                </div> 
                
                <div class="col-1"></div> 
            </div> 

            <div class="row mb-3">
                
                <div class="col-1"></div>

                <div class="col-10">
                    <div class="container-fluid">
                        <div class="card text-bg-info mb-3">
                            <div class="card-body text-center">
                                <h1> GESTIONE SKIPPER </h1>        
                            </div>
                        </div>  
                        <?php require_once("getSkippers.php"); ?>   
                    </div> 
                </div> 
                
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