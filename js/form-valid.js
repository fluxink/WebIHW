function handleFormSubmit(event) {
    event.preventDefault(); // prevent the form from submitting by default

    const form = event.target;
    const url = form.action;
    const method = form.method;
    const data = getFormData(form);
    console.log("Пук");

    if (!data) {
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open(method, url);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status < 400) {
                // successful response, redirect to new page
                const location = xhr.getResponseHeader("Location");
                if (location) {
                    window.location.replace(location);
                    return false;
                }
            } else {
                // error response, display error message to user
                const response = JSON.parse(xhr.responseText);
                const errors = response.errors;
                const errorKeys = Object.keys(errors);
                console.log(errorKeys);
                if (errorKeys.includes("email")) {
                    const emailError = errors["email"];
                    const emailInput = form.querySelector("input[name='email']");
                    emailInput.setAttribute("aria-invalid", true);
                    emailInput.setAttribute("title", emailError);
                }
                if (errorKeys.includes("password")) {
                    const passwordError = errors["password"];
                    const passwordInput = form.querySelector("input[name='password']");
                    passwordInput.setAttribute("aria-invalid", true);
                    passwordInput.setAttribute("title", passwordError);
                }
                if (errors === "Некоректні дані") {
                    const errorElement = document.createElement("div");
                    errorElement.classList.add("error");
                    errorElement.innerHTML = errors;
                    form.append(errorElement);
                }
            }
        }
    };
    xhr.send(JSON.stringify(data));
}

function getFormData(form) {
    const elements = form.elements;
    const data = {};
    let isValid = true;

    for (let i = 0; i < elements.length; i++) {
        const element = elements[i];
        if (element.tagName === "INPUT" || element.tagName === "TEXTAREA") {
            const name = element.name;
            const value = element.value.trim();

            if (element.required && !value) {
                element.classList.add("invalid");
                isValid = false;
            } else {
                element.classList.remove("invalid");
                data[name] = value;
            }
        }
    }

    if (!isValid) {
        const invalidElements = form.querySelectorAll(".invalid");
        invalidElements[0].focus();
        return null;
    }

    return data;
}

const forms = document.querySelectorAll("form");
forms.forEach(function (form) {
    form.addEventListener("submit", handleFormSubmit, false);
});
