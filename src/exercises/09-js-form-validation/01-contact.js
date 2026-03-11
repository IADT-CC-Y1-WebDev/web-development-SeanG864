let submitBtn = document.getElementById('submit_btn');
let commentForm = document.getElementById('comment_form');
let nameInput = document.getElementById('name');

let nameError = document.getElementById("name_error");

submitBtn.addEventListener('click', onSubmitForm);

let errors = {};

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showFieldErrors() {
    nameError.innerHTML = errors.name || '';
}

function onSubmitForm(evt) {
    errors = {};
    evt.preventDefault();

    const name = nameInput.value.trim();
    const nameRE = /^[a-zA-Z\-' ]*$/;
    if (name === '') {
        addError("name", "Name is required.");
    } else if (!nameRE.test(name)) {
        addError ("name", "Name can only contain letters and white space.");
    }

    if (Object.keys(errors).length === 0) {
        commentForm.submit();
    } else {
        showFieldErrors();
    }
}