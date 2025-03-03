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

function previewImage() {
    const file = document.getElementById('image-input').files[0];
    const reader = new FileReader();

    reader.onloadend = function() {
        const imagePreviewContainer = document.getElementById('image-preview-container');
        const imagePreview = document.getElementById('image-preview');

        imagePreview.src = reader.result;
        imagePreviewContainer.style.display = 'block';
    }

    if (file) {
        reader.readAsDataURL(file);
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

document.addEventListener("DOMContentLoaded", initTextareaResize);
