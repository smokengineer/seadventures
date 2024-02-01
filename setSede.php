<!-- FILE PHP CHE IMPOSTA LA SEDE DESIDERATA DALL'ADMIN  -->
<?php
    if (session_status() == PHP_SESSION_NONE) {

        session_start();
    }

    if ( isset( $_SESSION['adm'] ) ) {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['IDSede'])) {

                $_SESSION['IDSede'] = $_POST['IDSede'];

                header("location: index.php");
                exit();
            }
        }
    }
?>