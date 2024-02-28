document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('submit_button').addEventListener('click', function() {
        const topicId = +document.getElementById('topicId').value;
        const name = document.getElementById('name').value;
        const content = document.getElementById('content').value;
        const userId = +document.getElementById('userId').value;

        fetch(url, {
            method: "POST",
            mode: "cors",
            cache: "no-cache",
            credentials: "same-origin",
            headers: {
              "Content-Type": "application/json",
            },
            redirect: "follow",
            referrerPolicy: "no-referrer",
            body: JSON.stringify({
                topic_id: topicId,
                name: name,
                content: content,
                user_id: userId,
            }),
        });
    });
});
