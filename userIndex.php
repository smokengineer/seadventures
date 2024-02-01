<!-- HOME SECTION  -->
<section id="home" style="background: url(images/home1.jpg) no-repeat; background-size: cover; min-height: calc(100vh - 100px);">

    <div class="container">
        
        <div class="row">
            
            <div class="col-9 mt-3">

                <!-- Rimuovere d-none per la visibilità -->
                <div class="alert alert-primary alert-dismissible fade show d-none" role="alert">
                    Approfitta dello sconto del 5% sulle prenotazioni fino al 31/03/23 <!--<a href="#" class="alert-link">an example link</a>. -->
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <?php alert(); ?>

                <div class="card">
                    <div class="card-body">
                        <p class="display-1 bg-opacity"> Servizio di </p>
                        <p class="h1">NOLEGGIO IMBARCAZIONI E MOTO D'ACQUA</p>
                    </div>
                </div>

            </div>
            <div class="col-3 mt-3">
                
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header"> ACCESSO EFFETTUATO </div>
                    <div class="card-body">
                        <?php echo '<h5 class="card-title"> Bentornato '.$_SESSION['Nome'].'! </h5>'; ?>
                    </div>
                </div>
                
                <div class="card text-white bg-dark mb-3 position-fixed bottom-0 end-0 mb-3 me-3" style="max-width: 18rem;">
                    <div class="card-header"> AREA PRENOTAZIONI </div>
                    <div class="card-body">
                        <h5 class="card-title"> Clicca qui per procedere alla prenotazione </h5>
                        <button class="btn btn-primary"> <a href="userReservation.php" class="btn"> PRENOTA ORA  </a></button>
                    </div>
                </div>
            
            </div> 

        </div>
        
    </div>

</section>
<!-- END HOME SECTION  -->

<!-- MARKETING SECTION  -->
<section id="marketing">
    <?php require_once("marketing.html"); ?>
</section>
<!-- END MARKETING SECTION  -->