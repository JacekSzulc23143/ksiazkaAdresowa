<?php

require("config.php");

?>

<?php

$title = "Edytuj kontakt";

$flag = FALSE;

$id_polaczenia = new mysqli($dane["serwer"], $dane["uzytkownik"], $dane["haslo"], $dane["baza"]);

if ($id_polaczenia->connect_error) {
    die("Błąd połączenia z bazą");
} else {
    if (isset($_GET["id"])) {
        $sqlSelect = "SELECT id, name, phone, email FROM contacts WHERE id=$_GET[id]";
        $wynik = $id_polaczenia->query($sqlSelect);

        if ($wynik->num_rows > 0) {
            $wiersz = $wynik->fetch_assoc();
            $flag = TRUE;
        }
    } else {
        header("location: index.php");
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

    <main>
        <h2><?php echo $title; ?></h2>

        <?php

        if ($flag) {

        ?>

            <div class="form">
                <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">

                    <label for="name_surname"><i class="fa-solid fa-id-badge"></i> ID:</label>
                    <input type="number" name="id" id="id" value="<?php echo $wiersz["id"]; ?>">

                    <label for="name_surname"><i class="fa-solid fa-person-circle-plus"></i> Imię i nazwisko:</label>
                    <input type="text" name="name_surname" id="name_surname" value="<?php echo $wiersz["name"]; ?>">

                    <label for="phone"><i class="fa-solid fa-phone"></i> Telefon:</label>
                    <input type="number" name="phone" id="phone" value="<?php echo $wiersz["phone"]; ?>">

                    <label for="email"><i class="fa-solid fa-at"></i> e-mail:</label>
                    <input type="email" name="email" id="email" value="<?php echo $wiersz["email"]; ?>">

                    <div class="container">
                        <input class="btn btn-primary" type="submit" value="Aktualizuj" name="submit">
                        <input class="btn btn-warning" type="reset" value="Wyczyść">
                    </div>

                </form>
            </div>

        <?php

        }

        ?>

    </main>

    <?php

    //mysqli_connect(serwer, użytkownik, hasło, nazwa_bazy);
    $id_polaczenia = new mysqli($dane["serwer"], $dane["uzytkownik"], $dane["haslo"], $dane["baza"]);
    if ($id_polaczenia->connect_error) {
        die("<h1>Błąd połączenia z bazą</h1>");
    } else {
        // wyświetlenie danych z formularza
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $contact = array(
                "id"          => trim(htmlspecialchars($_POST["id"])),
                "name_surname"       => trim(htmlspecialchars($_POST["name_surname"])),
                "phone"       => trim(htmlspecialchars($_POST["phone"])),
                "email" => trim(htmlspecialchars($_POST["email"]))
            );

            if (preg_match("/^[a-zA-Z.\s]+$/u", $contact["name_surname"])) {
                if (strlen($contact["name_surname"]) >= 5 && strlen($contact["phone"]) >= 4) {

                    $sql_edit = $id_polaczenia->prepare("UPDATE contacts SET name = ?, phone = ?, email = ? WHERE id = ?;");
                    $sql_edit->bind_param("sisi", $contact["name_surname"], $contact["phone"], $contact["email"], $contact["id"]);
                    $sql_edit->execute();
                    $sql_edit->close();

                    header("location: index.php");
                } else {
                    echo '<p id="error">Wypełnij wszystkie pola!</p>';
                }
            } else {
                echo '<p id="error">Tekst zawiera inne znaki</p>';
            }
        }
    }
    mysqli_close($id_polaczenia);

    ?>

    <?php

    require_once("footer.php");

    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>