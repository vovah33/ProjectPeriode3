<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = filter_var(trim($_POST['naam']), FILTER_SANITIZE_STRING);
    $telefoonnummer = filter_var(trim($_POST['telefoonnummer']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
    $address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

    if (!isset($_POST['naam']) || !isset($_POST['password']) || !isset($_POST['email'])) {
        echo "Voer uw registratiegegevens in";
        exit();
    }

    if (empty($naam) || empty($telefoonnummer) || empty($email) || empty($address) || empty($password)) {
        echo "Please fill in all fields";
        exit();
    } elseif (mb_strlen($naam) < 5 || mb_strlen($naam) > 65) {
        echo "Toegestane lengte van naam van 5 tot 90 tekens";
        exit();
    } elseif (mb_strlen($telefoonnummer) < 4 || mb_strlen($telefoonnummer) > 15) {
        echo "Toegestane lengte van telefoonnummer van 5 tot 90 tekens";
        exit();
    } elseif (mb_strlen($address) < 5 || mb_strlen($address) > 50) {
        echo "Toegestane lengte van adress van 5 tot 50 teken";
        exit();
    } elseif (mb_strlen($email) < 8 || mb_strlen($email) > 50) {
        echo "Toegestane lengte van email van 8 tot 90 teken";
        exit();
    } elseif (mb_strlen($password) < 4 || mb_strlen($password) > 15) {
        echo "Toegestane lengte van password van 5 tot 90 tekens";
        exit();
    }

    try {
        $mysql = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');
        $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $mysql->prepare("INSERT INTO `users` (`naam`, `telefoonnummer`,`email`, `address`,  `password`) VALUES (:naam, :telefoonnummer, :email, :address, :password)");
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':telefoonnummer', $telefoonnummer);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':password', $password);
        $stmt->execute();


        echo "Registratie is succesvol!";
    } catch (PDOException $e) {
        echo "Fout: " . $e->getMessage();
        exit();
    }

    header('Location:home.html');
}
?>
