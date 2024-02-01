<!-- HOME SECTION  -->
<section id="home" style="background: url(images/home2.jpg) no-repeat; background-size: cover; min-height: calc(100vh - 100px);">

    <div class="container">

        <div class="row">

            <div class="col-9 mt-3">

                <!-- Rimuovere d-none per la visibilità -->
                <div class="alert alert-primary alert-dismissible fade show d-none" role="alert">
                    Approfitta dello sconto del 5% sulle prenotazioni fino al 31/03/23 <!--<a href="#" class="alert-link">an example link</a>. -->
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <?php 
                    alert();

                    if( isset($_SESSION['Email']) ){

                        unset($_SESSION['Email']);
                    }
                ?>

                <div class="card border-primary">
                    <div class="card-body">
                        <p class="display-1 bg-opacity"> Servizio di </p>
                        <p class="h1">NOLEGGIO IMBARCAZIONI E MOTO D'ACQUA</p>
                    </div>
                </div>

            </div>

            <div class="col-3 mt-3">
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