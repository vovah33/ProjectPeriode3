<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <link rel="stylesheet" href="accountstyle.css">
</head>
<body>
<nav id="navbar">
    <div id="logonav">
        <a href="home.html">
            <img src="Photos/cropped-logo%20UNEED-IT.png">
        </a>
    </div>
    <div id="logoptions">
        <ul>
            <li class="redc"> <a href="home.html">Home</a> </li>
            <li class="bluec"> <a href="OverOns.html">Over ons </a></li>
            <li class="redc"> <a href="service.html">Service </a></li>
            <li class="bluec"> <a href="zakelijk.html">Zakelijk </a></li>
            <li class="redc"> <a href="#Neuws">IT Neuws </a> </li>
            <li class="bluec"> <a href="#Reparaties">Reparaties </a> </li>
            <li class="redc"> <a href="#Contacten"> Contacten</a> </li>
            <li class="bluec"> <a href="faq.html">Faq </a> </li>
            <li class="redc"> <a href="account.php">Account </a> </li>
        </ul>
    </div>
</nav>
<main id="mainAccount">
    <div class="account-info">
        <h1>My Account</h1>
        <div class="info-block">
            <?php
            session_start();
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                echo "<p><strong>Naam:</strong> {$user['naam']}</p>";
                echo "<p><strong>Telefoonnummer:</strong> {$user['telefoonnummer']}</p>";
                echo "<p><strong>Adres:</strong> {$user['address']}</p>";
                echo "<p><strong>Email:</strong> {$user['email']}</p>";
            } else {
                header("Location: login_or_signup.html");
                exit();
            }
            ?>
        </div>
    </div>
    <div class="edit-info" style="display: none;">
        <h1>Edit Information</h1>
        <div class="changeForm">
            <form id="changeInfoForm" action="changeinfo.php" method="post" onsubmit="handleFormSubmission()">
                <label for="newName">New Name:</label><br>
                <input type="text" id="newName" name="newName" value="<?php echo $user['naam']; ?>"><br>
                <label for="newPhoneNumber">New Phone Number:</label><br>
                <input type="text" id="newPhoneNumber" name="newPhoneNumber" value="<?php echo $user['telefoonnummer']; ?>"><br>
                <label for="newAddress">New Address:</label><br>
                <input type="text" id="newAddress" name="newAddress" value="<?php echo $user['address']; ?>"><br>
                <label for="newEmail">Email:</label><br>
                <input type="text" id="newEmail" name="newEmail" value="<?php echo $user['email']; ?>"><br>

                <div class="button-group">
                    <button type="submit" style="background-color: mediumturquoise;">Save Changes</button>
                    <button type="button" onclick="cancelChanges()" id="cancelButton" style="background-color: red;">Cancel Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div class="buttons">
        <button id="editButton">Edit Information</button>

        <form action="logout.php" method="post">
            <button type="submit" name="logout">Log Out</button>
        </form>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to toggle edit mode
        function toggleEdit() {
            var infoBlock = document.querySelector('.info-block');
            var editBlock = document.querySelector('.edit-info');
            var editButton = document.getElementById('editButton');
            var cancelButton = document.getElementById('cancelButton');

            if (infoBlock.style.display === 'none') {
                infoBlock.style.display = 'block';
                editBlock.style.display = 'none';
                editButton.style.display = 'block';
                cancelButton.style.display = 'none';
            } else {
                infoBlock.style.display = 'none';
                editBlock.style.display = 'block';
                editButton.style.display = 'none';
                cancelButton.style.display = 'block';
                populateForm();
            }
        }

        // Function to populate form fields with user data
        function populateForm() {
            var user = <?php echo json_encode($user); ?>;
            document.getElementById('newName').value = user.naam;
            document.getElementById('newPhoneNumber').value = user.telefoonnummer;
            document.getElementById('newAddress').value = user.address;
            document.getElementById('newEmail').value = user.email;
        }

        // Function to cancel changes and revert to info mode
        function cancelChanges() {
            var infoBlock = document.querySelector('.info-block');
            var editBlock = document.querySelector('.edit-info');
            var editButton = document.getElementById('editButton');
            var cancelButton = document.getElementById('cancelButton');

            infoBlock.style.display = 'block';
            editBlock.style.display = 'none';
            cancelButton.style.display = 'none';
            editButton.style.display = 'block'; // Ensure "Edit Information" button is displayed in the middle
        }

        // Event listener for edit button
        var editButton = document.getElementById('editButton');
        editButton.addEventListener('click', function() {
            toggleEdit();
        });

        // Event listener for cancel button
        var cancelButton = document.getElementById('cancelButton');
        cancelButton.addEventListener('click', function() {
            cancelChanges();
        });
    });
</script>

</body>
</html>
