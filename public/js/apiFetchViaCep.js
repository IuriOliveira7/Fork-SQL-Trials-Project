const form = document.querySelector("#form");
const cepInput = document.querySelector("#cep");
const addressInput = document.querySelector("#address");
const cityInput = document.querySelector("#city");
const neighborhoodInput = document.querySelector("#neighborhood");
const regionInput = document.querySelector("#region");
const formInputs = document.querySelectorAll("[data-input]");

const closeButton = document.querySelector("#close-message");

// Validate CEP Input
cepInput.addEventListener("keypress", (event) => {
    const onlyNumbers = /[0-9]|\./;
    const key = String.fromCharCode(event.keyCode);

    // verify the numbers allow only numbers
    if (!onlyNumbers.test(key)) {
        event.preventDefault();
        return null;
    }
});

// Event to get address
cepInput.addEventListener("keyup", (event) => {
    const inputValue = event.target.value;

    //   Check if we have a CEP
    if (inputValue.length === 8) {
        getAddress(inputValue);
    }
});

// Get address from API
const getAddress = async (cep) => {
    toggleLoader();

    cepInput.blur();

    const apiUrl = `https://viacep.com.br/ws/${cep}/json/`;
    const response = await fetch(apiUrl);
    const data = await response.json();

    // Show error and reset form
    if (data.erro === "true") {
        if (!addressInput.hasAttribute("disabled")) {
            toggleDisabled();
        }

        addressForm.reset();
        toggleLoader();
        toggleMessage("CEP Inválido, tente novamente.");
        return;
    }

    // Activate disabled attribute if form is empty
    if (addressInput.value === "") {
        toggleDisabled();
    }

    addressInput.value = data.logradouro;
    cityInput.value = data.localidade;
    neighborhoodInput.value = data.bairro;
    regionInput.value = data.uf;

    toggleLoader();
};

// Add or remove disable attribute
const toggleDisabled = () => {
    if (regionInput.hasAttribute("disabled")) {
        formInputs.forEach((input) => {
            input.removeAttribute("disabled");
        });
    } else {
        formInputs.forEach((input) => {
            input.setAttribute("disabled", "disabled");
        });
    }
};

// Show or hide loader
const toggleLoader = () => {
    const fadeElement = document.querySelector("#fade");
    const loaderElement = document.querySelector("#loader");

    fadeElement.classList.toggle("hide");
    loaderElement.classList.toggle("hide");
};

// Show or hide message
const toggleMessage = (message) => {
    const fadeElement = document.querySelector("#fade");
    const messageElement = document.querySelector("#message");
    const messageTextElement = document.querySelector("#message p");

    messageTextElement.innerText = message;
    fadeElement.classList.toggle("hide");
    messageElement.classList.toggle("hide");
};

// Close message modal
closeButton.addEventListener("click", () => toggleMessage());

