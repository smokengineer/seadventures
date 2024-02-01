<!DOCTYPE html>

<html data-bs-theme="dark">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRAZIE - Seadventures</title>
    
    <?php require_once("../style.html"); ?>

    <link rel="stylesheet" href="/css/styleDemo.css">
</head>

<body>
    <!-- HOME SECTION  -->
    <section id="home">
        <div class="center-content">

            <h1> Elaborazione della richiesta in corso </h1>
            <p> Non chiudere questa pagina </p>

            <!-- Spinner Container -->
            <div class="spinner-container" id="spinnerContainer">
                <!-- Spinner di Bootstrap -->
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

        </div>
    </section>
    <!-- END HOME SECTION  -->
    
    <?php require_once("../js.html"); ?>

    <script>
        setTimeout(function() {
            window.location.href = 'demoPrenotazione2.php';
        }, 2000); // TEMPO IN MILLISECONDI
    </script>
</body>
</html>