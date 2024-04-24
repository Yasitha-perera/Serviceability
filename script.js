function validateForm() {
    var password1 = document.getElementById("password").value;
    var password2 = document.getElementById("repeat-password").value;

    if (password1 != password2) {
        alert("Passwords do not match");
        return false;
    }
    return true;
}
    function togglePassword() {
        var passwordFields = document.querySelectorAll(".input-field[type='password']");
        var checkbox = document.getElementById("register-check");

        passwordFields.forEach(function(passwordField) {
            if (checkbox.checked) {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        });
    }
    function validateForm() {
        var firstname = document.getElementById("firstname").value;
        var lastname = document.getElementById("lastname").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var repeatPassword = document.getElementById("repeat-password").value;

        // Simple validation checks
        if (firstname.trim() === "" || lastname.trim() === "" || email.trim() === "" || password.trim() === "" || repeatPassword.trim() === "") {
            alert("All fields are required");
            return false;
        }

        if (password !== repeatPassword) {
            alert("Passwords do not match");
            return false;
        }

        // Additional validation checks (e.g., email format)

        // If all validation passes, the form will be submitted
        return true;
    }
    function validateEmail(input) {
        // Get the input element's value
        var email = input.value;
    
        // Regular expression for validating email format
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
        // Check if the input value matches the email pattern
        if (!emailPattern.test(email)) {
            // If the email is invalid, add a red border or show an error message
            input.style.border = "2px solid red"; // Example: Adding red border
            // You can also display an error message to the user
            // Example: document.getElementById("error-message").innerText = "Please enter a valid email address";
        } else {
            // If the email is valid, remove the red border or clear the error message
            input.style.border = ""; // Example: Clearing the red border
            // Example: document.getElementById("error-message").innerText = "";
        }
    }
    