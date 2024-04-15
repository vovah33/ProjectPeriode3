<!-- In your account.php file -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <link rel="stylesheet" href="accountstyle.css">
</head>
<body>
<nav id="navbar">
    <!-- Your navigation bar code here -->
</nav>
<main id="mainAccount">
    <div class="account-info">
        <h1>My Account</h1>
        <?php
        session_start();
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            echo "<p>Naam: {$user['naam']}</p>";
            echo "<p>Telefoonnummer: {$user['telefoonnummer']}</p>";
            echo "<p>Adres: {$user['address']}</p>";
            echo "<p>Email: {$user['email']}</p>";
        } else {
            header("Location: login.html");
            exit();
        }
        ?>
    </div>
    <div class="buttons">
        <button onclick="window.location.href='change_information.php'">Change Information</button>
        <!-- Add a form with a logout button -->
        <form action="logout.php" method="post">
            <button type="submit" name="logout">Log Out</button>
        </form>
    </div>
</main>
</body>
</html>
