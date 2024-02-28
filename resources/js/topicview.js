document.addEventListener('DOMContentLoaded', function() {
    const name = document.getElementById('name');
    const content = document.getElementById('content');
    const submitBtn = document.getElementById('submit_button');

    name.addEventListener('input', function(_) {
        if (name.value.length >= 5  && content.value.length > 0) {
            submitBtn.removeAttribute('disabled');
        } else {
            submitBtn.setAttribute('disabled', true);
        }
    });

    content.addEventListener('input', function(_) {
        if (name.value.length >= 5  && content.value.length > 0) {
            submitBtn.removeAttribute('disabled');
        } else {
            submitBtn.setAttribute('disabled', true);
        }
    });
});
