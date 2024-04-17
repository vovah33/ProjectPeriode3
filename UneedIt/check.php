<?php
session_start();

if (!isset($_POST['Naam']) || !isset($_POST['password']) || !isset($_POST['email'])) {
    echo "Geen naam, wachtwoord of e-mailadres ingevoerd";
    exit();
}

// Connect to the database
$mysql = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');

// Filter and sanitize the input
$naam = filter_var(trim($_POST['Naam']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);

// Prepare and execute the database query
$stmt = $mysql->prepare("SELECT * FROM `users` WHERE `naam` = :naam AND `email` = :email AND `password` = :password");
$stmt->bindParam(':naam', $naam);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);
$stmt->execute();

// Fetch the user data
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Onjuiste gebruikersnaam of wachtwoord";
    exit();
}

// Store user information in session
$_SESSION['user'] = $user;

// Redirect to the home page
header("Location: home.html");
exit();
?>
