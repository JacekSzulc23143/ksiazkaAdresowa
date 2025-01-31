<?php

require("config.php");

?>

<?php
$title = "Książka adresowa";

$flag = FALSE;
$id_polaczenia = mysqli_connect($dane["serwer"], $dane["uzytkownik"], $dane["haslo"], $dane["baza"]);
if (!($id_polaczenia)) {
    die("Błąd połączenia z bazą");
} else {
    // echo $_GET["id"];

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1><?php echo $title; ?></h1>

    <?php

    require_once("nav.php");

    ?>

    <?php

    if ($flag) {

    ?>

        <div class="form">
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">

                <input type="number" name="id" id="id" value="<?php echo $wiersz["id"]; ?>">

                <input type="text" name="name_surname" id="name_surname" value="<?php echo $wiersz["name"]; ?>">

                <input type="number" name="phone" id="phone" value="<?php echo $wiersz["phone"]; ?>">

                <input type="email" name="email" id="email" value="<?php echo $wiersz["email"]; ?>">

                <input type="submit" value="Zaktualizuj" name="submit">
                <input type="reset" value="Wyczyść">
            </form>
        </div>

    <?php

    }

    ?>

    <!-- <div class="form">
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <div>
                <label for="name_surname">Podaj imię i nazwisko:</label>
                <input type="text" name="name_surname" id="name_surname" placeholder="Wpisz imię i nazwisko" autofocus>
            </div>
            <div>
                <label for="number">Podaj telefon:</label>
                <input type="number" name="phone" id="number" placeholder="Wpisz telefon">
            </div>
            <div>
                <label for="email">Podaj email:</label>
                <input type="email" name="email" id="email" placeholder="Wpisz email">
            </div>
            <input class="btn" type="submit" name="submit" value="Dodaj kontakt">
        </form>
    </div> -->

    <div class="wrapper">

        <?php

        //mysqli_connect(serwer, użytkownik, hasło, nazwa_bazy);
        if (!($id_polaczenia = mysqli_connect($dane["serwer"], $dane["uzytkownik"], $dane["haslo"], $dane["baza"]))) {
            echo "<h1>Błąd połączenia</h1>";
            die("<h1>Błąd połączenia z bazą</h1>");
        } else {
            // wyświetlenie danych z formularza
            if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
                // echo $_POST["name_surname"] . " " . $_POST["phone"] . " " . $_POST["email"];
                // trim usuwa zbędne znaki np. spacje
                $contact = array(
                    "id"          => trim(htmlspecialchars($_POST["id"])),
                    "name_surname"       => trim(htmlspecialchars($_POST["name_surname"])),
                    "phone"       => trim(htmlspecialchars($_POST["phone"])),
                    "email" => trim(htmlspecialchars($_POST["email"]))
                );

                if (preg_match("/^[a-zA-Z.\s]+$/u", $contact["name_surname"])) {
                    if (strlen($contact["name_surname"]) >= 5 && strlen($contact["phone"]) > 7 && ($contact["email"]) > 5) {

                        // $sql_edit = "UPDATE contacts SET name = ?, phone = ?, email = ? WHERE id = ?;) VALUES ('$contact[name_surname]', '$contact[phone]', '$contact[email]', '$contact[id]');";
                        // mysqli_query($id_polaczenia, $sql_edit);

                        $sql_edit = $id_polaczenia->prepare("UPDATE contacts SET name = ?, phone = ?, email = ? WHERE id = ?;");
                        $sql_edit->bind_param("sisi", $contact["name_surname"], $contact["phone"], $contact["email"], $contact["id"]);
                        $sql_edit->execute();
                        $sql_edit->close();

                        header("location: index.php");
                    }
                } else {
                    echo "Tekst zawiera inne znaki";
                }
            }
        }
        mysqli_close($id_polaczenia);

        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>