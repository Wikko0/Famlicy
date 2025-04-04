function toggleMenu() {
    const menu = document.getElementById('dropdownMenu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

document.addEventListener('click', function (event) {
    const menu = document.getElementById('dropdownMenu');
    const userDetails = document.querySelector('.user-details');

    if (menu && userDetails && !userDetails.contains(event.target)) {
        menu.style.display = 'none';
    }
});

const notificationIcon = document.querySelector('.notification-icon');
if (notificationIcon) {
    notificationIcon.addEventListener('click', function() {
        var menu = document.getElementById('notification-dropdown');

        if (menu) {
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    var infoModal = document.getElementById("infoModal");


    if (infoModal) {
        infoModal.addEventListener("show.bs.modal", function (event) {
            var button = event.relatedTarget;
            var postId = button.getAttribute("data-post-id");
            var type = button.getAttribute("data-type");
            var modalTitle = document.getElementById("infoModalLabel");
            var infoList = document.getElementById("infoList");

            modalTitle.innerText = type === "likes" ? "People who liked this post" : "Comments";
            infoList.innerHTML = "<li class='list-group-item'>Loading...</li>";

            var url = type === "likes" ? `/posts/${postId}/likes` : `/posts/${postId}/comments`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    infoList.innerHTML = "";

                    if (data.items.length > 0) {
                        data.items.forEach(function (item) {
                            var li = document.createElement("li");
                            li.classList.add("list-group-item");

                            if (type === "likes") {
                                li.innerHTML = `
                                    <div class="d-flex align-items-start">
                                        <img src="/images/users/user-${item.user_id}.jpg" width="30" class="rounded-circle me-2">
                                        <strong>${item.user_name}</strong>
                                    </div>
                                `;
                            } else {
                                li.innerHTML = `
                                    <div class="d-flex align-items-start">
                                        <img src="/images/users/user-${item.user_id}.jpg" width="30" class="rounded-circle me-2">
                                        <div>
                                            <strong>${item.user_name}</strong>
                                            <p class="mb-0">${item.content}</p>
                                            <small class="text-muted">${item.created_at}</small>
                                        </div>
                                    </div>
                                `;
                            }

                            infoList.appendChild(li);
                        });
                    } else {
                        infoList.innerHTML = `<li class='list-group-item'>No ${type} yet.</li>`;
                    }
                })
                .catch(error => {
                    console.error("Error fetching data:", error);
                    infoList.innerHTML = "<li class='list-group-item text-danger'>Error loading data.</li>";
                });
        });
    }

});

function previewFile() {
    let input = document.getElementById('file-input');
    let previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = '';

    if (input.files.length > 0) {
        let file = input.files[0];
        let fileType = file.type.split('/')[0];

        let previewElement;
        if (fileType === 'image') {
            previewElement = document.createElement('img');
            previewElement.src = URL.createObjectURL(file);
            previewElement.style.maxWidth = '100px';
        } else if (fileType === 'audio') {
            previewElement = document.createElement('audio');
            previewElement.controls = true;
            previewElement.src = URL.createObjectURL(file);
        } else if (fileType === 'video') {
            previewElement = document.createElement('video');
            previewElement.controls = true;
            previewElement.style.maxWidth = '150px';
            previewElement.src = URL.createObjectURL(file);
        }

        if (previewElement) {
            previewContainer.appendChild(previewElement);
            previewContainer.style.display = 'block';
        }
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const shareButtons = document.querySelectorAll('.dropdown-item');

    shareButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            window.open(url, '_blank', 'width=600,height=400');
        });
    });
});


// Text area extend
function initTextareaResize() {
    let textarea = document.getElementById("content");
    if (!textarea) return;

    textarea.addEventListener("input", function () {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight + 5) + "px";

        let inputBox = this.parentElement;
        inputBox.style.height = (this.scrollHeight + 5) + "px";

        let shareMemory = document.querySelector(".share-memory");
        if (shareMemory) {
            shareMemory.style.height = (inputBox.offsetHeight + 20) + "px";
        }
    });
}

document.querySelectorAll(".toggle-comments").forEach(button => {
    button.addEventListener("click", function (event) {
        event.preventDefault();
        let postId = this.getAttribute("data-post-id");
        let commentsContainer = document.getElementById("comments-container-" + postId);
        commentsContainer.style.display = commentsContainer.style.display === "none" || commentsContainer.style.display === "" ? "block" : "none";
    });
});

document.querySelectorAll(".load-more-comments").forEach(button => {
    button.addEventListener("click", function () {
        let postId = this.getAttribute("data-post-id");
        let offset = parseInt(this.getAttribute("data-offset"));
        let loadMoreButton = this;
        let commentsList = document.getElementById("comments-list-" + postId);


        fetch(`/posts/${postId}/comment?offset=${offset}`)
            .then(response => response.json())
            .then(data => {

                if (!data.items || data.items.length === 0) {
                    console.warn("No comments returned from server.");
                    return;
                }


                let existingCommentIds = new Set();
                commentsList.querySelectorAll(".single-comment").forEach(commentDiv => {
                    existingCommentIds.add(commentDiv.getAttribute("data-comment-id"));
                });

                let newCommentsCount = 0;


                data.items.forEach(comment => {
                    if (!existingCommentIds.has(String(comment.id))) {
                        let commentHTML = `
                            <div class="single-comment" data-comment-id="${comment.id}">
                                <div class="comment-header">
                                    <div class="comment-img">
                                        <img src="/images/users/user-${comment.user_id}.jpg" alt="User Image">
                                    </div>
                                    <div class="comment-info">
                                        <a href="/profile/${comment.user_id}" class="comment-author">
                                            ${comment.user_name}
                                        </a>
                                        <span class="comment-time">${comment.created_at}</span>
                                    </div>
                                </div>
                                <div class="comment-body">
                                    <p>${comment.content}</p>
                                </div>
                            </div>
                        `;
                        commentsList.insertAdjacentHTML('beforeend', commentHTML);
                        newCommentsCount++;
                    }
                });

                if (newCommentsCount > 0) {
                    loadMoreButton.setAttribute("data-offset", offset + newCommentsCount);
                }

                if (!data.hasMore) {
                    loadMoreButton.remove();
                }
            })
            .catch(error => console.error("Error loading comments:", error));
    });
});

document.addEventListener("DOMContentLoaded", initTextareaResize);

document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const addItems = document.querySelector('.add-items');
    const arrowContainer = document.querySelector('.arrow-container');


    if (menuToggle && addItems && arrowContainer) {
        menuToggle.addEventListener('click', function () {
            addItems.classList.toggle('active');
            arrowContainer.classList.toggle('active');
        });
    }
});
document.addEventListener("DOMContentLoaded", function () {
    let postForm = document.getElementById("post-form");

    if (postForm) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    let lat = position.coords.latitude;
                    let lon = position.coords.longitude;

                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                        .then(response => response.json())
                        .then(data => {
                            let locationName = data.address.city || data.address.town || data.address.village ||
                                data.address.county || data.address.state || "Unknown location";

                            document.getElementById("location").value = locationName;
                        })
                        .catch(error => {
                            console.error("Error:", error);
                        });
                },
                function (error) {
                    console.warn("Error:", error.message);
                }
            );
        }
    }
});

