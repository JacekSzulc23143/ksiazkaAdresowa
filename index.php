<?php

require("config.php");

?>

<?php

$title = "Książka adresowa";

if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $id_polaczenia = new mysqli($dane["serwer"], $dane["uzytkownik"], $dane["haslo"], $dane["baza"]);

    if ($id_polaczenia->connect_error) {
        die("Błąd połączenia z bazą");
    } else {
        $sqlDelete = $id_polaczenia->prepare("DELETE FROM contacts WHERE id=?");
        $sqlDelete->bind_param("i", $_POST["id"]);
        $sqlDelete->execute();
        $sqlDelete->close();

        // zamknięcie połączenia z bazą
        $id_polaczenia->close();
    }
}

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

    <div class="wrapper">
        <p>Połączenie z bazą:

            <?php

            //mysqli_connect(serwer, użytkownik, hasło, nazwa_bazy);
            $id_polaczenia = new mysqli($dane["serwer"], $dane["uzytkownik"], $dane["haslo"], $dane["baza"]);
            if ($id_polaczenia->connect_error) {
                die("<h1>Błąd połączenia z bazą</h1>");
            } else {
                echo "contacts_db" . ' <i class="fa-regular fa-circle-dot fa-fade"></i>';
                $sql = "SELECT * FROM contacts";
                $res = mysqli_query($id_polaczenia, $sql);
                echo '<table class="table table-hover">';
                echo '<thead><tr><th>ID</th><th>Imię i Nazwisko</th><th>Telefon</th><th>e-mail</th><th colspan="2">Ustawienia</th></tr></thead>';
                foreach ($res as $element) {
                    echo "<tr>";
                    echo "<td>" . $element["id"] . "</td>";
                    echo "<td>" . $element["name"] . "</td>";
                    echo "<td>" . $element["phone"] . "</td>";
                    echo "<td>" . $element["email"] . "</td>";
            ?>
                    <td>
                        <form action="editForm.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $element["id"]; ?>">
                            <input class="btn btn-primary" type="submit" name="submit" value="Edytuj">
                        </form>
                    </td>
                    <td>
                        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $element["id"]; ?>">
                            <input class="btn btn-danger" type="submit" name="submit" value="Usuń">
                        </form>
                    </td>
            <?php
                    echo "</tr>";
                }
                echo "</table>";
            }
            mysqli_close($id_polaczenia);

            ?>

        </p>
    </div>

    <!-- <footer class="footer">
        <p class="footer__bottom-text">JS CKU_Sopot <span class="footer_year"></span></p>
    </footer> -->

    <?php

    require_once("footer.php");

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>