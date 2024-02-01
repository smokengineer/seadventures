<!DOCTYPE html>

<html data-bs-theme="dark">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsabile Registrato - Seadventures</title>
    
    <?php require_once("../style.html"); ?>

    <link rel="stylesheet" href="/css/styleDemo.css">
</head>

<body>
    <!-- HOME SECTION  -->
    <section id="home">
        <div class="center-content">
            <h1> Registrazione Responsabile effettuata </h1>
            <p> <strong> E-MAIL:</strong> <?= $_GET['email'] ?> </p>
            <p> <strong> PASSWORD:</strong> <?= $_GET['password'] ?></p>
            <p> Puoi fornire le credenziali per l'accesso! </p>
            <a href="../superAdminManagementPage.php" class="btn btn-primary btn-custom"> TORNA ALLA GESTIONE </a>
        </div>
    </section>
    <!-- END HOME SECTION  -->
    
    <?php require_once("../js.html"); ?>
</body>
</html>