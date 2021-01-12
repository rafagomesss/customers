$(document).ready(() => {
    var loc = window.location.pathname;

    $('nav').find('a').each(function () {
        $(this).toggleClass('active', $(this).attr('href') == loc);
    });
});

function formValidate(form) {
    var validate = true;
    removeAllInvalid();
    Array.from(form.elements).forEach((input) => {
        input.classList.remove('is-invalid');
        if (input.hasAttribute('required') && input.value === '') {
            input.classList.add('is-invalid');
            let invalidAlert = document.createElement('div');
            invalidAlert.classList.add('invalid-feedback');
            invalidAlert.innerHTML = 'Esse campo é obrigatório!';
            insertAfter(input, invalidAlert);
            validate = false;
        }
    });
    return validate;
}

function insertAfter(referenceNode, newNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function removeAllInvalid() {
    document.querySelectorAll(".invalid-feedback").forEach(e => e.parentNode.removeChild(e));
}