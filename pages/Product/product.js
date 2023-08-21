// <!-- -----------------Table that display the comments --------------- -->

document.getElementById("submit-comment").addEventListener("click", function() {
    var comment = document.getElementById("comment").value;
    if (comment.trim() !== "") {
        var username = prompt("Please enter your username:");
        if (!username) {
            return; // User canceled the prompt
        }

        var currentDate = new Date().toLocaleString();

        // Create a new row in the comments table
        var commentsTable = document.getElementById("comments-table").getElementsByTagName("tbody")[0];
        var newRow = commentsTable.insertRow();

        var usernameCell = newRow.insertCell(0);
        var commentCell = newRow.insertCell(1);
        var dateCell = newRow.insertCell(2);

        usernameCell.innerHTML = username;
        commentCell.innerHTML = comment;
        dateCell.innerHTML = currentDate;

        // Clear the textarea
        document.getElementById("comment").value = "";
    }
});


// <!-- -----------------/Table that display the comments --------------- -->

document.addEventListener('DOMContentLoaded', function() {
    const commentForm = document.getElementById('commentForm');
    const commentList = document.getElementById('commentList');
    
    commentForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const username = document.getElementById('username').value;
        const commentText = document.getElementById('commentText').value;
        
        const currentTime = new Date().toLocaleString();
        
        // Create a new comment element
        const newComment = document.createElement('div');
        newComment.className = 'comment';
        newComment.innerHTML = `<strong>${username}</strong> (${currentTime}): ${commentText}`;
        
        commentList.appendChild(newComment);
        
        // Clear the form fields
        document.getElementById('username').value = '';
        document.getElementById('commentText').value = '';
    });
});
