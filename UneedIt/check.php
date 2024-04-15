<?php
$naam = filter_var(trim($_POST['naam']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);


if (!isset($_POST['naam']) || !isset($_POST['password']) || !isset($_POST['email'])) {
    echo "Voer uw registratiegegevens in";
    exit();
}

// Перевірка довжини логіна, паролю та електронної пошти
if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
    echo "Недопустима довжина логіна (від 5 до 90 символів)";
    exit();
} elseif (mb_strlen($password) < 4 || mb_strlen($password) > 15) {
    echo "Недопустима довжина паролю (від 4 до 15 символів)";
    exit();
} elseif (mb_strlen($email) < 8 || mb_strlen($email) > 90) {
    echo "Недопустима довжина електронної пошти (від 8 до 90 символів)";
    exit();
}

// Хешування паролю
$password = md5($password."shdvpiejuanvpfaivn212389549032");

try {
    // Підключення до бази даних
    $mysql = new PDO('mysql:host=localhost;dbname=uneedit', 'root', '');
    $mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Підготовка та виконання запиту для додавання користувача
    $stmt = $mysql->prepare("INSERT INTO `users` (`naam`, `password`, `email`) VALUES (:login, :password, :email)");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Виведення підтвердження успішної реєстрації
    echo "Реєстрація успішна!";
} catch (PDOException $e) {
    // Виведення помилки у разі виникнення виключення
    echo "Помилка: " . $e->getMessage();
    exit(); // Вихід з програми у разі помилки
}

// Перенаправлення на головну сторінку
header('Location:home.html');
?>