<?php

$title = "O mnie";

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <?php

    require_once("link.php");

    ?>
</head>

<body>

    <?php

    require_once("nav.php");

    ?>

    <h1><?php echo $title; ?></h1>

    <div class="form">
        <p>
            Jestem kursantem w Centrum Kształcenia Ustawicznego w Sopocie INF.03 - Luty 2024 r.
        </p>
        <p>
            Kierunek: Tworzenie i administrowanie stronami i aplikacjami internetowymi oraz bazami danych.
        </p>
        <p>
            Aplikacja <i>"Książa adresowa"</i> - zaliczenie przedmiotu "Programowanie aplikacji internetowych".
        </p>
        <p>
            Prowadzący zajęcia: Pan Marcin Putra.
        </p>
    </div>

    <?php

    require_once("footer.php");

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>