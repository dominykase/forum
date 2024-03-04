import Editor from "@toast-ui/editor";
import "@toast-ui/editor/dist/toastui-editor.css";

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

    let input = document.getElementById('editor');

    const editor = new Editor({
        el: input,
        events: {
            change: function() {
                content.value = editor.getMarkdown();
                if (name.value.length >= 5 && content.value.length > 0) {
                    submitBtn.removeAttribute('disabled');
                } else {
                    submitBtn.setAttribute('disabled', true);
                }
            }
        },
        height: "400px",
        initialEditType: "markdown",
        placeholder: "Write your content here!",
    });
});
