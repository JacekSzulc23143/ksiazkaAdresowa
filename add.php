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
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
            <div>
                <label for="name_surname">Podaj imię i nazwisko:</label>
                <input type="text" name="name_surname" id="name_surname" placeholder="Wpisz imię i nazwisko" autofocus>
            </div>
            <div>
                <label for="phone">Podaj telefon:</label>
                <input type="number" name="phone" id="phone" placeholder="Wpisz telefon">
            </div>
            <div>
                <label for="email">Podaj email:</label>
                <input type="email" name="email" id="email" placeholder="Wpisz email">
            </div>
            <input class="btn" type="submit" name="submit" value="Dodaj kontakt">
            <input type="reset" value="Wyczyść">
        </form>
    </div>

    <!-- <div class="wrapper"> -->

        <?php

        //mysqli_connect(serwer, użytkownik, hasło, nazwa_bazy);
        $id_polaczenia = new mysqli($dane["serwer"], $dane["uzytkownik"], $dane["haslo"], $dane["baza"]);
        if ($id_polaczenia->connect_error) {
            // echo "<h1>Błąd połączenia</h1>";
            die("<h1>Błąd połączenia z bazą</h1>");
        } else {
            // wyświetlenie danych z formularza
            if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
                // echo $_POST["name_surname"] . " " . $_POST["phone"] . " " . $_POST["email"];
                // trim usuwa zbędne znaki np. spacje
                $contact = array(
                    "name_surname"       => trim(htmlspecialchars($_POST["name_surname"])),
                    "phone"       => trim(htmlspecialchars($_POST["phone"])),
                    "email" => trim(htmlspecialchars($_POST["email"]))
                );

                if (preg_match("/^[a-zA-Z.\s]+$/u", $contact["name_surname"])) {
                    if (strlen($contact["name_surname"]) >= 5 && strlen($contact["phone"]) > 7 && ($contact["email"]) > 5) {

                        // $sql_add = "INSERT INTO contacts (contacts.name, contacts.phone, contacts.email) VALUES ('$contact[name_surname]', '$contact[phone]', '$contact[email]');";
                        // mysqli_query($id_polaczenia, $sql_add);

                        $sql_add = $id_polaczenia->prepare("INSERT INTO contacts (contacts.name, contacts.phone, contacts.email) VALUES (?,?,?)");
                        $sql_add->bind_param("sis", $contact["name_surname"], $contact["phone"], $contact["email"]);
                        $sql_add->execute();
                        $sql_add->close();
                        
                        header("location: index.php");
                    }
                } else {
                    echo "Tekst zawiera inne znaki";
                }
            }
        }
        mysqli_close($id_polaczenia);

        ?>

    <!-- </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>