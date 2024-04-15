<?php
session_start();

if (!isset($_POST['Naam']) || !isset($_POST['password']) || !isset($_POST['email'])) {
    echo "Geen naam, wachtwoord of e-mailadres ingevoerd";
    exit();
}

// Підключення до бази даних
$mysql = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');

// Отримання та фільтрація логіна та паролю
$naam = filter_var(trim($_POST['Naam']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

// Підготовка та виконання запиту до бази даних
$stmt = $mysql->prepare("SELECT * FROM `users` WHERE `naam` = :naam AND `email` = :email AND `password` = :password");
$stmt->bindParam(':naam', $naam);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Onjuiste gebruikersnaam of wachtwoord";
    exit();
}

$_SESSION['user'] = $user;

setcookie('user', session_id(), time() + (86400 * 30 * 5), "/"); // 86400 second is een dag

header("Location: home.html");
exit();
?>