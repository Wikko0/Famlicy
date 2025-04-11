<div class="modal fade" id="changeProfileImageModal" tabindex="-1" aria-labelledby="changeProfileImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeProfileImageModalLabel">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="modal-profile-image"
                         src="{{ asset('images/users/user-' . $user->id . '.jpg') }}"
                         alt="Current Profile Image"
                         class="img-thumbnail"
                         width="150">
                </div>
                <form id="upload-form" method="POST" action="{{ route('user.updateProfileImage', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-3">
                        <label for="new-profile-image" class="form-label">Upload New Image</label>
                        <input type="file" class="form-control" name="image" id="new-profile-image" accept="image/*">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--<div class="profile">--}}
{{--    <div class="add-items">--}}
{{--        <a href="{{route('user.aboutme', Auth::user()->username)}}" class="item ">--}}
{{--            <div class="title">About Me</div>--}}
{{--            <button class="add-btn">Visit</button>--}}
{{--        </a>--}}
{{--        <a href="{{route('user.myinterests', Auth::user()->username)}}" class="item ">--}}
{{--            <div class="title">My interests & favourites</div>--}}
{{--            <button class="add-btn">Visit</button>--}}
{{--        </a>--}}
{{--        <a href="{{route('user.education', Auth::user()->username)}}" class="item ">--}}
{{--            <div class="title">Education</div>--}}
{{--            <button class="add-btn">Visit</button>--}}
{{--        </a>--}}
{{--        <a href="{{route('user.employment', Auth::user()->username)}}" class="item ">--}}
{{--            <div class="title">Employment & vocation</div>--}}
{{--            <button class="add-btn">Visit</button>--}}
{{--        </a>--}}
{{--        <a href="{{route('user.life', Auth::user()->username)}}" class="item ">--}}
{{--            <div class="title">Life events & accomplishments</div>--}}
{{--            <button class="add-btn">Visit</button>--}}
{{--        </a>--}}
{{--        <a href="{{route('user.goals', Auth::user()->username)}}" class="item ">--}}
{{--            <div class="title">Goals & ambitions</div>--}}
{{--            <button class="add-btn">Visit</button>--}}
{{--        </a>--}}
{{--        <a href="{{route('family.register', Auth::user()->username)}}" class="item ">--}}
{{--            <div class="title">Create account for transitioned</div>--}}
{{--            <button class="add-btn">Visit</button>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}
