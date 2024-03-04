// const Editor = require("@toast-ui/editor");
// require("@toast-ui/editor/dist/toastui-editor.css");
// require("codemirror/lib/codemirror.css");

import Editor from "@toast-ui/editor";
import "@toast-ui/editor/dist/toastui-editor.css";

document.addEventListener('DOMContentLoaded', function() {
    let submitBtn = document.getElementById('submit_button');
    let input = document.getElementById('editor');
    let content = document.getElementById('content');

    const editor = new Editor({
        el: input,
        events: {
            change: function() {
                content.value = editor.getMarkdown();
                if (content.value.length > 0) {
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
