<?php

require("config.php");

?>

<?php

$title = "Dodaj kontakt";

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

        <div class="form">
            <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
                <div>
                    <label for="name_surname"><i class="fa-solid fa-person-circle-plus"></i> Imię i nazwisko:</label>
                    <input type="text" name="name_surname" id="name_surname" placeholder="Wpisz imię i nazwisko" autofocus>
                </div>
                <div>
                    <label for="phone"><i class="fa-solid fa-phone"></i> Telefon:</label>
                    <input type="number" name="phone" id="phone" placeholder="Wpisz telefon">
                </div>
                <div>
                    <label for="email"><i class="fa-solid fa-at"></i> e-mail:</label>
                    <input type="email" name="email" id="email" placeholder="Wpisz e-mail">
                </div>
                <div class="container">
                    <input class="btn btn-primary" type="submit" name="submit" value="Dodaj">
                    <input class="btn btn-warning" type="reset" value="Wyczyść">
                </div>
            </form>
        </div>

    </main>

    <?php

    $id_polaczenia = new mysqli($dane["serwer"], $dane["uzytkownik"], $dane["haslo"], $dane["baza"]);
    if ($id_polaczenia->connect_error) {
        die("<h1>Błąd połączenia z bazą</h1>");
    } else {
        // wyświetlenie danych z formularza
        if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
            $contact = array(
                "name_surname"       => trim(htmlspecialchars($_POST["name_surname"])),
                "phone"       => trim(htmlspecialchars($_POST["phone"])),
                "email" => trim(htmlspecialchars($_POST["email"]))
            );

            if (preg_match("/^[a-zA-Z.\s]+$/u", $contact["name_surname"])) {
                if (strlen($contact["name_surname"]) >= 5 && strlen($contact["phone"]) >= 4) {
                    // if (!empty($contact["name_surname"]) && !empty($contact["phone"])) {

                    $sql_add = $id_polaczenia->prepare("INSERT INTO contacts (contacts.name, contacts.phone, contacts.email) VALUES (?,?,?)");
                    $sql_add->bind_param("sis", $contact["name_surname"], $contact["phone"], $contact["email"]);
                    $sql_add->execute();
                    $sql_add->close();

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