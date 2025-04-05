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

                    <div class="primary">
                        <div class="message-box">
                            <textarea name="content" class="form-control" rows="4">{{ $post->content }}</textarea>
                        </div>

                        <div class="item mt-3">
                            <select name="type" class="form-select">
                                <option value="Global" @if($post->type == 'Global') selected @endif>Global</option>
                                @foreach ($userCommunities as $community)
                                    <option value="{{ $community->name }}" @if($post->type == $community->name) selected @endif>{{ $community->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="image-section mt-4">
                            <label for="image" class="form-label">Change File</label>
                            <div class="mb-3">
                                @if ($post->image_path)
                                    @php
                                        $fileExtension = pathinfo($post->image_path, PATHINFO_EXTENSION);
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                        $audioExtensions = ['mp3', 'wav', 'ogg'];
                                        $videoExtensions = ['mp4', 'mov', 'avi', 'wmv'];
                                    @endphp

                                    <div class="post-media">
                                        @if (in_array($fileExtension, $imageExtensions))
                                            <div class="post-image">
                                                <div class="img">
                                                    <img src="{{ asset($post->image_path) }}" alt="Post Image" />
                                                </div>
                                            </div>
                                        @elseif (in_array($fileExtension, $audioExtensions))
                                            <div class="post-audio">
                                                <audio controls>
                                                    <source src="{{ asset($post->image_path) }}" type="audio/{{ $fileExtension }}">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                        @elseif (in_array($fileExtension, $videoExtensions))
                                            <div class="post-video">
                                                <video controls width="100%">
                                                    <source src="{{ asset($post->image_path) }}" type="video/{{ $fileExtension }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <p>No image uploaded.</p>
                                @endif
                            </div>
                            <input type="file" name="file" id="file-input" class="form-control" accept="image/*,audio/*,video/*" onchange="previewFile()" />
                        </div>

                        <div class="img mt-5" id="preview-container" style="display: none"></div>
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
