document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form submission for now

        // Get input values
        const fullName = document.getElementById("fullName").value;
        const email = document.getElementById("email").value;
        const mobile = document.getElementById("mobile").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        // Clear previous error messages
        clearErrors();

        let hasErrors = false;

        // Email validation using regular expression
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailRegex.test(email)) {
            showError("email", "Invalid email format.");
            hasErrors = true;
        }

        // Mobile validation (10 digits)
        const mobileRegex = /^\d{14}$/;
        if (!mobileRegex.test(mobile)) {
            showError("mobile", "Mobile number must be 14 digits.");
            hasErrors = true;
        }

        // Full Name validation (Minimum length 2 characters)
        const nameRegex = /^.{2,}$/;
        if (!nameRegex.test(fullName)) {
            showError(
                "fullName",
                "Full name must have a minimum length of 2 characters."
            );
            hasErrors = true;
        }

        // Password validation (At least 6 characters)
        if (password.length < 6) {
            showError(
                "password",
                "Password should be at least 6 characters long."
            );
            hasErrors = true;
        }

        // Password Confirmation validation
        if (password !== confirmPassword) {
            showError("confirmPassword", "Password confirmation does not match.");
            hasErrors = true;
        }

        // If there are no errors, submit the form
        if (!hasErrors) {
            form.submit();
        }
    });

    function showError(inputId, errorMessage) {
        const inputElement = document.getElementById(inputId);
        const errorElement = document.createElement("p");
        errorElement.className = "error-message";
        errorElement.textContent = errorMessage;
        inputElement.parentNode.appendChild(errorElement);
        inputElement.classList.add("input-error");
    }

    function clearErrors() {
        const errorMessages = document.querySelectorAll(".error-message");
        errorMessages.forEach((errorMessage) => {
            errorMessage.parentNode.removeChild(errorMessage);
        });

        const inputFields = document.querySelectorAll(".form-group input");
        inputFields.forEach((inputField) => {
            inputField.classList.remove("input-error");
        });
    }

    const locationInput = document.getElementById("location");

    locationInput.addEventListener("change", function () {
        changeColor(this);
    });

    locationInput.addEventListener("click", function () {
        clearInput(this);
    });

    function changeColor(input) {
        if (input.value === 'City-Street') {
            input.style.color = 'gray';
        } else {
            input.style.color = 'black';
        }
    }

    function clearInput(input) {
        if (input.value === 'City-Street') {
            input.value = '';
            input.style.color = 'black';
        }
    }
});