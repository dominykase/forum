document.addEventListener('DOMContentLoaded', function() {
    let submitBtn = document.getElementById('submit_button');
    let input = document.getElementsByName('content')[0];

    input.addEventListener('input', function(_) {
        console.log(submitBtn);
        if (input.value.length > 0) {
            submitBtn.removeAttribute('disabled');
        } else {
            submitBtn.setAttribute('disabled', true);
        }
    });
});
