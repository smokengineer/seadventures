<!DOCTYPE html>

<html data-bs-theme="dark">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A PRESTO - Seadventures</title>
    
    <?php require_once("../style.html"); ?>

    <link rel="stylesheet" href="/css/styleDemo.css">
</head>

<body>
    <!-- HOME SECTION  -->
    <section id="home">
        <div class="center-content">

            <h1> Logout in corso </h1>
            <p> Attendere... </p>
            <!-- Spinner Container -->
            <div class="spinner-container" id="spinnerContainer">
                <!-- Spinner di Bootstrap -->
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden"> <i class="fa-solid fa-ship"></i> </span>
                </div>
            </div>
            <h1 class="mt-5"> <i class="fa-solid fa-ship fa-2x"></i> Seadventures.com </h1>

        </div>
    </section>
    <!-- END HOME SECTION  -->

    <?php require_once("../js.html"); ?>
    
    <script>
        setTimeout(function() {
            window.location.href = '../index.php';
        }, 2000); // TEMPO IN MILLISECONDI
    </script>
</body>
</html>