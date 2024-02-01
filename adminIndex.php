<!-- HOME SECTION  -->
<section id="home" style="background: url(images/home.jpg) no-repeat; background-size: cover; min-height: calc(100vh - 100px);">
    
    <div class="container">
        
        <div class="row">
            <div class="col-12 mt-3">

                <?php alert(); ?>

                <div class="card text-center">
                    <div class="card-body">
                        <p class="h1"> AREA AMMINISTRATIVA </p>
                    </div>
                </div>
                
            </div>
        </div>   
        <div class="row">
            <div class="col-6 mt-3">

                <?php 
                if (session_status() == PHP_SESSION_NONE) {

                    session_start();
                }

                if ( isset( $_SESSION['adm'] ) ) {

                    require_once("PHPconfig/config.php");

                    echo '<div class="card border-success mb-3 mt-3" style="max-width: 20rem;">';
                        echo '<div class="card-header bg-transparent border-success"> SUPER ADMIN </div>';
                        echo '<div class="card-body text-success">';
                            echo '<h5 class="card-title"> <strong> ADMIN: '.$_SESSION['Nome'].'</strong></h5>';
                            echo '<p class="card-text"> <strong>Quale Sede vuole gestire oggi ? </strong></p>';

                            ?>
                            <div class="row mb-3">

                                <form action="setSede.php" method="post">

                                    <select class="form-select mt-3 mb-3" aria-label="select example" id="IDSede" name="IDSede">
                                    <?php
                                        
                                        // RECUPERO INFORMAZIONI SULLE SEDI DISPONIBILI

                                        $sql = "SELECT Nome, IDSede FROM Sede ORDER BY Nome";
                                        $result = $connessione->query($sql);

                                        if ($result->num_rows > 0) {

                                            while ( $row = $result->fetch_assoc() ) {
                                                
                                                $selected = ($_SESSION['IDSede'] == $row["IDSede"]) ? 'selected' : '';
                                                echo '<option value="' . $row["IDSede"] . '" '. $selected .'>' . $row["Nome"] . '</option>';
                                            }

                                        } else {

                                            echo '<option value="nothing" selected> ERRORE </option>';
                                        }

                                    ?>
                                    </select>

                                    <button class="btn btn-primary mt-3 mb-3" type="submit"> SELEZIONA </button> 

                                </form>

                            </div>
                            <?php 
                            

                        echo '</div>';
                    echo '</div>';


                } else { 

                    echo '<div class="card text-center mt-3 mb-3" style="max-width: 18rem">';
                        echo '<div class="card-header"> ID #'.$_SESSION['IDResponsabile'].' </div>';
                        echo '<div class="card-body">';
                            echo '<h4 class="card-title mb-3"> DATI DIPENDENTE: </h4>'; 
                            echo '<p class="card-text"> <strong>'.$_SESSION['Nome'].' '.$_SESSION['Cognome'].'</strong></p>';
                        echo '</div>';
                    echo '</div>';
                }
                
                ?>
            </div>

            <div class="col-3 mt-3">
            </div>

            <div class="col-3 mt-3">
                <div class="card border-success mb-3 mt-3" style="max-width: 20rem;">
                    <div class="card-header bg-transparent border-success"> SEDE DI RIFERIMENTO </div>
                    <div class="card-body text-success">
                        <?php echo '<h5 class="card-title"> <strong> ID SEDE: '.$_SESSION['IDSede'].'</strong></h5>'; ?>
                    </div>
                </div>
            </div>
        
        </div>
        
    </div>

</section>
<!-- END HOME SECTION  -->