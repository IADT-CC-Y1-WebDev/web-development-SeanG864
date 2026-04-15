let submitBtn = document.getElementById('submit_btn');
let gameForm = document.getElementById('book_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let titleInput = document.getElementById('title');
let authorInput = document.getElementById('author');
let releaseDateInput = document.getElementById('year');
let publisherIdInput = document.getElementById('publisher_id');
let descriptionInput = document.getElementById('description');
let platformIdsInput = document.getElementsByName('format_ids[]');
let imageInput = document.getElementById('image');

let titleError = document.getElementById('title_error');
let authorError = document.getElementById('author_error');
let releaseDateError = document.getElementById('year_error');
let publisherIdError = document.getElementById('publisher_id_error');
let descriptionError = document.getElementById('description_error');
let platformIdsError = document.getElementById('platform_ids_error');
let imageError = document.getElementById('image_error');

let errors = {};

submitBtn.addEventListener('click', onSubmitForm);

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showErrorSummaryTop() {
    const messages = Object.values(errors);
    if (messages.length === 0) {
        errorSummaryTop.style.display = 'none';
        errorSummaryTop.innerHTML = '';
        return;
    }
    errorSummaryTop.innerHTML =
        '<strong>Please fix the following:</strong><ul>' +
        messages
            .map(function (m) {
                return '<li>' + m + '</li>';
            })
            .join('') +
        '</ul>';
    errorSummaryTop.style.display = 'block';
}

function showFieldErrors() {
    titleError.innerHTML = errors.title || '';
    authorError.innerHTML = errors.author || '';
    releaseDateError.innerHTML = errors.release_date || '';
    publisherIdError.innerHTML = errors.genre_id || '';
    descriptionError.innerHTML = errors.description || '';
    platformIdsError.innerHTML = errors.platform_ids || '';
    imageError.innerHTML = errors.image || '';

    console.log(errors)
}

function isRequired(value) {
    return String(value).trim() !== '';
}

function isMinLength(value, min) {
    return String(value).trim().length >= min;
}

function isMaxLength(value, max) {
    return String(value).trim().length <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = {};

    let titleMin = titleInput.dataset.minlength || 3;
    let titleMax = titleInput.dataset.maxlength || 255;
    let authorMin = authorInput.dataset.minlength || 6;
    let authorMax = authorInput.dataset.maxlength || 100;
    let descMin = 10;

    // title
    if(!isRequired(titleInput.value)) {
        addError('title', 'Title java is required');
    }

    else if (!isMinLength(titleInput.value, titleMin)) {
        addError('title', 'Title java must be at least ' + titleMin + ' characters');
    }

    else if (!isMaxLength(titleInput.value, titleMax)) {
        addError('title', 'Title java must be at less than ' + titleMax + ' characters');
    }

    // author
    if(!isRequired(authorInput.value)) {
        addError('author', 'Author is required');
    }

    else if (!isMinLength(authorInput.value, authorMin)) {
        addError('author', 'Author must be at least ' + authorMin + ' characters');
    }

    else if (!isMaxLength(authorInput.value, authorMax)) {
        addError('author', 'Author must be at less than ' + authorMax + ' characters');
    }

    // release date
    if (!isRequired(releaseDateInput.value)) {
        addError('year', 'Release year is required');
    }

    // genre
    if (!isRequired(publisherIdInput.value)) {
        addError('publisher_id', 'Publisher is required');
    }

    // description
    if (!isRequired(descriptionInput.value)) {
        addError('description', 'Description is required');
    }

    else if (!isMinLength(descriptionInput.value, descMin)) {
        addError('description', `Description must be at least ${descMin} characters long`);
    }

    // platforms
    let platformSelected = false;
    for (let i = 0; i < platformIdsInput.length; i++) {
        if (platformIdsInput[i].checked) {
            platformSelected = true;
            break;
        }
    }

    if (!platformSelected) {
        addError('format_ids', 'Select at least one format');
    }

    // images
    // if (imageInput.files.length === 0) {
    //     addError('image', 'Image is required');
    // }


    showFieldErrors();
    showErrorSummaryTop();

    if (Object.keys(errors).length === 0) {
        // gameForm.submit();
        alert('Form validated');
    }
    
}
