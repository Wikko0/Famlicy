@extends('layouts.main')
@section('content')
    <section class="welcome-section education">
        @include('ads.ad-container-970')
        <div class="container">
            @include('include.leftMenu')

            <div class="main">
                @include('include.alert')

                <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="primary">
                        <div class="message-box">
                            <textarea name="content" class="form-control" rows="4">{{ $post->content }}</textarea>
                        </div>

                        <div class="item mt-3">
                            <select name="type" class="form-control">
                                <option value="Global" @if($post->type == 'Global') selected @endif>Global</option>
                                @foreach ($userCommunities as $community)
                                    <option value="{{ $community->name }}" @if($post->type == $community->name) selected @endif>{{ $community->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="image-section mt-4">
                            <label for="image" class="form-label">Change Image</label>
                            <div class="mb-3">
                                @if($post->image_path)
                                    <img id="current-image" src="{{ asset($post->image_path) }}" alt="Post Image" class="img-thumbnail" width="150">
                                @else
                                    <p>No image uploaded.</p>
                                @endif
                            </div>
                            <input type="file" name="image" id="image" class="form-control" onchange="previewImage(event)">
                        </div>

                        <div class="btn-section mt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>

            </div>
            @include('include.invite')
        </div>
    </section>

    @include('include.modal')
@endsection

@section('scripts')
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('current-image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
