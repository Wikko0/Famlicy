<form action="{{ route('posts.store', ['contentType' => isset($community) && $community ? $community->name : 'Global']) }}" method="POST" enctype="multipart/form-data">    @csrf
    <div class="share-memory">
        <div class="img">
            <img src="{{ asset('images/users/user-' . Auth::user()->id . '.jpg') }}" alt="User Image" />
        </div>
        <div class="input-box">
            <input type="text" name="content" id="content" placeholder="Share your memory with everyone" />

            <input type="file" name="image" id="image-input" accept="image/*" style="display: none;" onchange="previewImage()" />

            <svg
                width="17"
                height="17"
                viewBox="0 0 17 17"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                onclick="document.getElementById('image-input').click();"
            >
                <path
                    d="M3.8125 16L11.7812 8.5L15.5312 12.25M3.8125 16H13.1875C14.7408 16 16 14.7408 16 13.1875V8.5M3.8125 16C2.2592 16 1 14.7408 1 13.1875V3.8125C1 2.2592 2.2592 1 3.8125 1H9.90625M12.25 2.90826L14.1674 1M14.1674 1L16 2.822M14.1674 1V5.6875M6.625 5.21875C6.625 5.9954 5.9954 6.625 5.21875 6.625C4.4421 6.625 3.8125 5.9954 3.8125 5.21875C3.8125 4.4421 4.4421 3.8125 5.21875 3.8125C5.9954 3.8125 6.625 4.4421 6.625 5.21875Z"
                    stroke="#2A804E"
                    stroke-width="1.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </div>

        <div id="image-preview-container" style="display: none" class="img">
            <img id="image-preview" src="" alt="Post Image" />
        </div>
    </div>

</form>
