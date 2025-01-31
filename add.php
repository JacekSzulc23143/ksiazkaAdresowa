<?php

require("config.php");

?>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <h1><?php echo $title; ?></h1>

    <?php

    require_once("nav.php");

    ?>

    <div class="form">
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <div>
                <label for="name_surname">Imię i nazwisko:</label>
                <input type="text" name="name_surname" id="name_surname" placeholder="Wpisz imię i nazwisko" autofocus>
            </div>
            <div>
                <label for="phone">Telefon:</label>
                <input type="number" name="phone" id="phone" placeholder="Wpisz telefon">
            </div>
            <div>
                <label for="email">e-mail:</label>
                <input type="email" name="email" id="email" placeholder="Wpisz email">
            </div>
            <div class="container">
                <input class="btn btn-primary" type="submit" name="submit" value="Dodaj kontakt">
                <input class="btn btn-warning" type="reset" value="Wyczyść">
            </div>
        </form>
    </div>

    <?php

    //mysqli_connect(serwer, użytkownik, hasło, nazwa_bazy);
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
                if (strlen($contact["name_surname"]) >= 5 && strlen($contact["phone"]) > 7 && ($contact["email"]) > 5) {
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>