// zakelijkscript.js

function checkLoginStatus() {
    // Perform AJAX request to check login status
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "checklogstatus.php", true);

    // Define what to do on successful response
    xhr.onload = function() {
        if (xhr.status == 200) {
            // Check the response text
            if (xhr.responseText.trim() === "logged_in") {
                // If user is logged in, redirect to another page for service
                window.location.href = "bestellen.html";
            } else {
                // If user is not logged in, redirect to login/signup page
                window.location.href = "login_or_signup.php";
            }
        }
    };

    // Send the request
    xhr.send();
}
