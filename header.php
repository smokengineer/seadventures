<?php
    session_start();
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="index.php"><i class="fa-solid fa-ship"></i> Seadventures.com 
        <?php 
        if ( isset( $_SESSION['adm'] ) ) {
            echo '<span class="badge text-bg-info">ADMIN</span>';
        } 
        ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            
            <?php

            function printElement($ref, $icon){

                echo '<li class="nav-item">';
                echo '<a class="nav-link" aria-current="page" href="'.$ref.'">';
                echo $icon;
                echo '</a></li>';

            }

            if ( isset($_SESSION['private']) && $_SESSION['private'] == 2 ) {
                // LINK DISPONIBILI PER LA PAGINA DEI DIPENDENTI

                printElement("index.php", '<i class="fa-solid fa-house"></i> HOME ');
                
                printElement("adminManagementPage.php", '<i class="fa-solid fa-gear"></i> GESTIONE');

                printElement("adminReservation.php", '<i class="fa-solid fa-calendar-check"></i> PRENOTAZIONI');
                
                if ( isset( $_SESSION['adm'] ) ) {
                    
                    // LINK DISPONIBILI PER LA PAGINA DEL SUPER ADMIN   

                    //printElement("#", '<i class="fa-solid fa-gear"></i> GESTIONE RESPONSABILI');
                    //printElement("#", '<i class="fa-solid fa-gear"></i> GESTIONE SEDI');
                    printElement("superAdminManagementPage.php", '<i class="fa-solid fa-gear"></i> GESTIONE SUPER ADMIN');

                }

                printElement("logout.php", '<i class="fa-solid fa-right-from-bracket"></i> LOG-OUT');
                

                


            } else if ( isset($_SESSION['private']) && $_SESSION['private'] == 1 ) {
                // LINK DISPONIBILI PER LA PAGINA DEGLI UTENTI

                printElement("index.php", '<i class="fa-solid fa-house"></i> HOME ');

                printElement("userAccount.php", '<i class="fa-solid fa-user"></i> ACCOUNT ');

                printElement("logout.php", '<i class="fa-solid fa-right-from-bracket"></i> LOG-OUT ');
                
            } else {

                printElement("userLoginPage.php", '<i class="fa-solid fa-right-to-bracket"></i> LOG-IN ');

            }

            ?>
            
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <?php
    // Verifica se il file corrente è "index.php"
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($currentPage !== 'index.php') {
    ?>
        <a href="#" id="GoBack" class="btn btn-primary position-fixed" style="top: 2; left: 1; margin: 10px;">
            <i class="fa-solid fa-arrow-left"></i> 
        </a>
    <?php
    }
    ?>
</div>


<?php require_once("alert.php"); ?>
<?php require_once("check.php"); ?>