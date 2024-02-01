<!DOCTYPE html>

<html data-bs-theme="dark">
<head>
    <title>Home - Seadventures</title>
    
    <?php require_once("style.html"); ?>
</head>

<body>
    <!-- HEADER  -->
    <?php require_once("header.php"); ?>
    <!-- END HEADER  -->

    <?php
        if ( isset($_SESSION['private']) && $_SESSION['private'] == 2 ) {

            require_once("adminIndex.php"); 

        } else if ( isset($_SESSION['private']) && $_SESSION['private'] == 1 ) {

            require_once("userIndex.php"); 

        } else {
            
            require_once("standardIndex.php");
        }
    ?>
    
	<!-- FOOTER SECTION  -->
    <?php require_once "footer.php"; ?>
    <!-- END FOOTER SECTION  -->

    <?php require_once("js.html"); ?>
</body>
</html>