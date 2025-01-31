<?php
$title = "Książka adresowa";
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1><?php echo $title; ?></h1>

    <?php

    require_once("nav.php");

    ?>

    <?php

    require("config.php");

    ?>

    <div class="form">
        <p>Połączenie z bazą:

            <?php

            //mysqli_connect(serwer, użytkownik, hasło, nazwa_bazy);
            $id_polaczenia = new mysqli($dane["serwer"], $dane["uzytkownik"], $dane["haslo"], $dane["baza"]);
            if ($id_polaczenia->connect_error) {
                // echo "<h1>Błąd połączenia</h1>";
                die("<h1>Błąd połączenia z bazą</h1>");
            } else {
                echo "contacts_db";
                $sql = "SELECT * FROM contacts";
                $res = mysqli_query($id_polaczenia, $sql);
                echo "<table>";
                echo "<thead><tr><th>ID</th><th>Imię i Nazwisko</th> <th>Telefon</th><th>e-mail</th></tr></thead>";
                foreach ($res as $element) {
                    echo "<tr>";
                    echo "<td>" . $element["id"] . "</td>";
                    echo "<td>" . $element["name"] . "</td>";
                    echo "<td>" . $element["phone"] . "</td>";
                    echo "<td>" . $element["email"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            mysqli_close($id_polaczenia);

            ?>

        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>