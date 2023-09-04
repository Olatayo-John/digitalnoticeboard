let isAnimating = false;

function clearAlert() {
    $('.alertDiv,.alertDivAjax').hide();
    $('.alertMsgDiv').children().remove();
}

function gsapAlert() {

    if (!isAnimating) {
        isAnimating = true;

        gsap.from(".alertDiv,.alertDivAjax", {
            duration: 1,
            x: 500,
            ease: "bounce",
            onComplete: function () {
                isAnimating = false;
            }
        });

        timeoutClearAlert();
    }
}

function timeoutClearAlert() {
    setTimeout(function () {
        $('.alertDiv,.alertDivAjax').hide();
        $('.alertMsgDiv').children().remove();
    }, 5000)
}


// dom 
$(document).on('click', '.alertClose', function (e) {
    e.preventDefault();

    clearAlert();
});
// 

// onready
$(document).ready(function () {

    gsapAlert();

    $(document).on('click', 'button.InFormDeleteBtn', function () {

        var formClass = $(this).attr('formClass');
        var con = confirm('Are you sure you want to perform this action?');

        if (con === false) {
            return false;
        } else if (con === true) {
            return true;
            // $('form.' + formClass + '').submit();
        }

    });

    $(document).on('submit', 'form', function (e) {
        // e.preventDefault();
        $('form button.InFormSubmitBtn').prop('disabled',true);

    });

});
// 

// editors
ClassicEditor
    .create(document.querySelector('#objectiveEditor'))
    .catch(error => {
        console.error(error);
    });
ClassicEditor
    .create(document.querySelector('#notesEditor'))
    .catch(error => {
        console.error(error);
    });
ClassicEditor
    .create(document.querySelector('#remarksEditor'))
    .catch(error => {
        console.error(error);
    });
ClassicEditor
    .create(document.querySelector('#credentialsEditor'))
    .catch(error => {
        console.error(error);
    });

