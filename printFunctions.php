<!-- FILE PHP CON LE FUNZIONI PER STAMPARE ELEMENTI DEL CARRELLO, CARD VEICOLI E SKIPPER, ECC... -->

<?php

    function printCardVeicolo($row) {

        $tipo = $_SESSION["TipologiaVeicolo"][$row["IDTipo"]];
        $IDVeicolo = $row["IDVeicolo"];

        $badge = "";
        $badgeValue = "s=0";

        if ( $row["SkipperSI"] == 1 ) {

            $badge = '<i class="fa-solid fa-anchor-circle-exclamation"></i>';
            $badgeValue = "s=1";
        }
        

        echo '<div class="col-md-4 mb-3 mt-3">';
            
            echo '<div class="card" style="width: 15rem;">';
                echo '<div class="card-header">';
                    echo '<p class="card-text">'.$tipo["Nome"].'</p>';
                echo '</div>';
                echo '<img src="images/category-2.jpg" class="card-img-top" alt="'.$tipo["Nome"].'">';
                echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$row["Nome"]." ".$badge.'</h5>';
                    echo '<p class="card-text">'.$row["Descrizione"].'</p>';
                    echo '<p class="text-monospace text-success h4">'.$row["CostoGiornaliero"].' &euro;/Giorno </p>';
                echo '</div>';

                echo '<div class="card-body">';

                    if( in_array( $IDVeicolo, $_SESSION["Veicoli"] ) )
                        echo '<button class="btn btn-primary" disabled> <a class="btn"> AGGIUNTO </a></button>';
                    else 
                        echo '<button class="btn btn-primary"> <a href="addVeicoloToCart.php?IDVeicolo='.$IDVeicolo.'&'.$badgeValue.'"'.' class="btn"> SELEZIONA  </a> </button>';

                echo '</div>';
            echo '</div>';
        echo '</div>';
    } 

    function printCardSkipper($row) {

        $IDSkipper = $row["IDSkipper"];

        echo '<div class="col-md-4 mb-3 mt-3">';
            echo '<div class="card" style="width: 15rem;">';
                echo '<img src="images/img-1.jpg" class="card-img-top" alt="'.$row["Nome"].'">';
                echo '<div class="card-body">';
                    echo '<h5 class="card-title">'.$row["Nome"].' '.$row["Cognome"].'</h5>';
                    echo '<p class="card-text"><strong>BREVE DESCRIZIONE:</strong></p>';
                    echo '<p class="card-text">'.$row["Descrizione"].'</p>';
                    
                    echo '<p class="card-text"><strong> ESPERIENZA: </strong>';
                    $a = floor($row['Esperienza'] / 2);
                    $b = $row['Esperienza'] % 2;
                    for($i = 0; $i < $a; $i++){
                        echo '<i class="fa-solid fa-star"></i>';
                    }
                    if($b != 0)
                        echo '<i class="fa-solid fa-star-half-stroke"></i>';

                    echo '</p>';


                    echo '<p class="text-monospace text-success h4">'.$row["CostoGiornaliero"].' &euro;/Giorno </p>';
                echo '</div>';

                echo '<div class="card-body">';

                    if( in_array( $IDSkipper, $_SESSION["Skipper"] ) )
                        echo '<button class="btn btn-primary" disabled> <a class="btn"> AGGIUNTO </a></button>';
                    else
                        echo '<button class="btn btn-primary"> <a href="addSkipperToCart.php?IDSkipper='.$IDSkipper.'" class="btn"> SELEZIONA  </a> </button>';

                echo '</div>';
            echo '</div>';
        echo '</div>';
    }

    function printCardSede($nomeSede, $keyword) {
        echo '<div class="row mb-3 mt-3">';
            echo '<div class="container-fluid" >';
                echo '<div class="card text-white bg-primary mb-3">';
                    echo '<div class="card-body">';
                        echo '<h5 class="card-title"> RISULTATI '.$keyword.' PER: '.$nomeSede.'</h5>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        
        echo '<div class="row">';
    }

    function printMessage($message) {
        echo '<div class="row mb-3 mt-3">';
            echo '<div class="container-fluid" >';
                echo '<div class="card text-white bg-primary mb-3">';
                    echo '<div class="card-body">';
                        echo '<h5 class="card-title"> '.$message.' </h5>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }

    function printMessageRed($message) {
        echo '<div class="row mb-3 mt-3">';
            echo '<div class="container-fluid" >';
                echo '<div class="card text-bg-danger mb-3">';
                    echo '<div class="card-body">';
                        echo '<h5 class="card-title"> '.$message.' </h5>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }

    function printPrice($price, $giorni) {

        echo '<li class="list-group-item d-flex justify-content-between">';
            echo '<span>Totale Giorni</span>';
            echo '<strong>'.$giorni.'</strong>';
        echo '</li>';

        echo '<li class="list-group-item d-flex justify-content-between">';
                echo '<span class="text-success">Totale (EUR)</span>';
                echo '<span class="text-success"><strong>'.$price.' &euro;</strong></span>';
        echo '</li>';
        
        if( isset($_SESSION['carrello']) ){
            echo '<li class="list-group-item d-flex justify-content-between">';
                $nome = "ConfermaSvuotaCarrello";
                echo '<button class="btn btn-danger mt-2 mb-2" onclick="conferma(\''.$nome.'\')"> SVUOTA </button>';
            
                    //href="emptyCart.php?idUtente='.$_SESSION['carrello'].'"
                echo '</button>';

                $nome = "ConfermaPrenotazione";
                echo '<button class="btn btn-primary mt-2 mb-2" onclick="conferma(\''.$nome.'\')"> PRENOTA';
                    //href="sendReservation.php"
                echo '</button>';

            echo '</li>';
        }
    }

    function printCartItemVeicolo($row) {

        $IDVeicolo = $row["IDVeicolo"];

        $badge = "";
        $badgeValue = "s=0";

        if ( $row["SkipperSI"] == 1 ) {

            $badge = '<i class="fa-solid fa-anchor-circle-exclamation"></i>';
            $badgeValue = "s=1";
        }

        echo '<li class="list-group-item d-flex justify-content-between lh-sm">';
            echo '<div>';
                echo '<h6 class="my-0">'.$row["Nome"].'</h6>';
                echo '<small class="text-body-secondary">Veicolo '.$badge.'</small>';      
            echo '</div>';
            echo '<span class="text-body-secondary">'.$row["CostoGiornaliero"].'&euro;</span>';
            echo '<small class="btn">';
                echo '<a href="removeVeicoloFromCart.php?IDVeicolo='.$IDVeicolo.'&'.$badgeValue.'"'.'>  <i class="fa-solid fa-trash-can"></i> </a>';

            echo '</small>';
        echo '</li>';
    }

    function printCartHeader($dim){

        echo '<h4 class="d-flex justify-content-between align-items-center mb-3">';
            echo '<span class="text-primary"> <i class="fa-solid fa-cart-shopping"></i> Il tuo carrello </span>';
            echo '<span class="badge bg-primary rounded-pill">'.$dim.'</span>';
        echo '</h4>';
    }

    function printCartItemSkipper($row) {

        echo '<li class="list-group-item d-flex justify-content-between lh-sm">';
            echo '<div>';
                echo '<h6 class="my-0">'.$row["Nome"].' '.$row["Cognome"].'</h6>';
                echo '<small class="text-body-secondary">Skipper</small>';
            echo '</div>';
                echo '<span class="text-body-secondary">'.$row["CostoGiornaliero"].'&euro;</span>';
                echo '<small class="btn">';
                    echo '<a href="removeSkipperFromCart.php?IDSkipper='.$row["IDSkipper"].'" >  <i class="fa-solid fa-trash-can"></i> </a>';
                echo '</small>';
        echo '</li>';
    }

    function printItemSkipper($row) {

        $IDSkipper = $row['IDSkipper'];

        echo '<div class="accordion-item">';

            echo '<h2 class="accordion-header">';
                echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#skipper'.$IDSkipper.'" aria-expanded="true" aria-controls="skipper'.$IDSkipper.'">';
                    echo 'SKIPPER #'.$IDSkipper;
                echo '</button>';
            echo '</h2>';

            echo '<div id="skipper'.$IDSkipper.'" class="accordion-collapse collapse" data-bs-parent="#Skippers">';
                echo '<div class="accordion-body">';
                    echo '<div class="row">';
                    
                        echo '<div class="col-6">';
                            echo '<div class="card">';
                                echo '<div class="card-body">';
                                    
                                    echo '<p class="card-text"><strong> NOME: </strong>'.$row['Nome'].'</p>';
                                    echo '<p class="card-text"><strong> COGNOME: </strong>'.$row['Cognome'].'</p>';
                                    echo '<p class="card-text"><strong> DATA DI NASCITA: </strong>'.$row['DataNascita'].'</p>';

                                    echo '<p class="card-text"><strong> DESCRIZIONE: </strong>'.$row['Descrizione'].'</p>';

                                    echo '<p class="card-text"><strong> ESPERIENZA: </strong>';
                                    $a = floor($row['Esperienza'] / 2);
                                    $b = $row['Esperienza'] % 2;
                                    for($i = 0; $i < $a; $i++){
                                        echo '<i class="fa-solid fa-star"></i>';
                                    }
                                    if($b != 0)
                                        echo '<i class="fa-solid fa-star-half-stroke"></i>';

                                    echo '</p>';

                                    echo '<p class="card-text"><strong> COSTO GIORNALIERO: </strong>'.$row['CostoGiornaliero'].' &euro;</p>';
                                    
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-6 ">';
                            echo '<div class="card text-center" style="width: 15rem;">';
                                //echo '<img src="'.$row['NomeFile'].'" class="img-thumbnail rounded" alt="'.$row['Nome'].'">';ù
                                echo '<img src="images/category-3.jpg" class="img-thumbnail rounded">';
                            echo '</div>';
                        echo '</div>';

                    echo '</div>';

                    echo '<a href="updateSkipperPage.php?ID='.$IDSkipper.'" class="btn btn-primary mt-3"> MODIFICA DATI SKIPPER </a>';

                echo '</div>';
            echo '</div>';
        echo '</div>';

    }

    function printItemVeicolo($row) {

        $IDVeicolo = $row['IDVeicolo'];
        $tipo = $_SESSION["TipologiaVeicolo"][$row["IDTipo"]];

        echo '<div class="accordion-item">';

            echo '<h2 class="accordion-header">';
                echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#veicolo'.$IDVeicolo.'" aria-expanded="true" aria-controls="veicolo'.$IDVeicolo.'">';
                    echo 'VEICOLO #'.$IDVeicolo;
                echo '</button>';
            echo '</h2>';

            echo '<div id="veicolo'.$IDVeicolo.'" class="accordion-collapse collapse" data-bs-parent="#Veicoli">';
                echo '<div class="accordion-body">';

                    echo '<div class="row">';
                
                        echo '<div class="col-6">';
                            echo '<div class="card">';
                                echo '<div class="card-body">';
                                    
                                    echo '<p class="card-text"><strong> NOME: </strong>'.$row['Nome'].'</p>';
                                    echo '<p class="card-text"><strong> TIPO: </strong>'.$tipo['Nome'].'</p>';
                                    echo '<p class="card-text"><strong> DESCRIZIONE: </strong>'.$row['Descrizione'].'</p>';
                                    echo '<p class="card-text"><strong> COSTO GIORNALIERO: </strong>'.$row['CostoGiornaliero'].'  &euro;</p>';
                                    
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="col-6 ">';
                            echo '<div class="card text-center" style="width: 15rem;">';
                                echo '<img src="'.$row['NomeFile'].'" class="img-thumbnail rounded" alt="'.$row['Nome'].'">';
                            echo '</div>';
                        echo '</div>';

                    echo '</div>';

                    echo '<a href="updateVeicoloPage.php?ID='.$IDVeicolo.'" class="btn btn-primary mt-3"> MODIFICA DATI VEICOLO </a>';

                echo '</div>';
            echo '</div>';
        echo '</div>';
    
    }

    function printItemResponsabile($responsabile, $sedi) {

        $IDResponsabile = $responsabile['IDResponsabile'];

        echo '<div class="accordion-item">';

            echo '<h2 class="accordion-header">';
                echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#responsabile'.$IDResponsabile.'" aria-expanded="true" aria-controls="responsabile'.$IDResponsabile.'">';
                    echo 'RESPONSABILE #'.$IDResponsabile;
                echo '</button>';
            echo '</h2>';

            echo '<div id="responsabile'.$IDResponsabile.'" class="accordion-collapse collapse" data-bs-parent="#Responsabili">';
                echo '<div class="accordion-body">';
                    echo '<div class="row">';
                    
                            echo '<div class="card border-primary">';
                                echo '<div class="card-body">';
                                    
                                    echo '<p class="card-text"><strong> NOME: </strong>'.$responsabile['Nome'].'</p>';
                                    echo '<p class="card-text"><strong> COGNOME: </strong>'.$responsabile['Cognome'].'</p>';
                                    echo '<p class="card-text"><strong> DATA DI NASCITA: </strong>'.$responsabile['DataNascita'].'</p>';
                                    
                                    echo '<p class="card-text"><strong> CODICE FISCALE: </strong>'.$responsabile['CodFiscale'].'</p>';
                                    echo '<p class="card-text"><strong> EMAIL: </strong>'.$responsabile['Email'].'</p>';

                                    $privilegi = "NO";
                                    if ( $responsabile['Administrator'] == 1)
                                        $privilegi = "SI";

                                    echo '<p class="card-text"><strong> PRIVILEGI SUPER ADMIN: </strong>'.$privilegi.'</p>';

                                echo '</div>';
                            echo '</div>';
                            echo '<div class="card border-primary mt-3">';
                                echo '<div class="card-header"><strong> SEDE ASSOCIATA</strong></div>';
                                echo '<div class="card-body">';

                                    echo '<p class="card-text"><strong> ID : </strong>'.$responsabile['IDSede'].'</p>';
                                    echo '<p class="card-text"><strong> NOME: </strong>'.$sedi[ $responsabile['IDSede'] ].'</p>';
                                    echo '<button class="btn btn-primary" onclick="conferma2(\'SceltaSede\', \''.$IDResponsabile.'\')"> CAMBIA SEDE  </button>';
                                echo '</div>';

                                
                            echo '</div>';

                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';

    }

    function printItemSede($sede, $responsabili) {

        $IDSede = $sede['IDSede'];
        $indirizzo = $sede['TipoIndirizzo'].' '.$sede['NomeStrada']. ', ' .$sede['Civico']. ', ' .$sede['Citta']. ', ' .$sede['CAP'];
        echo '<div class="accordion-item">';

            echo '<h2 class="accordion-header">';
                echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#sede'.$IDSede.'" aria-expanded="true" aria-controls="sede'.$IDSede.'">';
                    echo 'SEDE #'.$IDSede;
                echo '</button>';
            echo '</h2>';

            echo '<div id="sede'.$IDSede.'" class="accordion-collapse collapse" data-bs-parent="#Sedi">';
                echo '<div class="accordion-body">';
                    echo '<div class="row">';
                    
                            echo '<div class="card border-primary">';
                                echo '<div class="card-body">';
                                    
                                    echo '<p class="card-text"><strong> LOCALITA\': </strong>'.$sede['Nome'].'</p>';

                                    echo '<p class="card-text"><strong> INDIRIZZO: </strong>'.$indirizzo.'</p>';

                                    echo '<p class="card-text"><strong> E-MAIL: </strong>'.$sede['Email'].'</p>';
                                    echo '<p class="card-text"><strong> TELEFONO: </strong>'.$sede['Telefono'].'</p>';

                                echo '</div>';
                            echo '</div>';

                            echo '<div class="card border-primary mt-3">';
                                echo '<div class="card-header"><strong> RESPONSABILI ASSOCIATI </strong></div>';

                                
                                foreach ($responsabili as $responsabile) {
                
                                    echo '<div class="card-body">';
                                        echo '<p class="card-text"><strong> ID : </strong>'.$responsabile["IDResponsabile"].'</p>';
                                        echo '<p class="card-text"><strong> NOME E COGNOME: </strong>'.$responsabile["Nome"].' '.$responsabile["Cognome"].'</p>';
                                    echo '</div>';
                            
                                }
                                
                            echo '</div>';

                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';

       

    }

?>