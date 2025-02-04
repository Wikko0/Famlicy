@extends('layouts.main')
@section('content')
    <section class="welcome-section education employment">
        @include('ads.ad-container-970')
        @include('include.alert')
        <div class="container">
           @include('include.leftMenu')

                <div class="main">
                    <form action="{{ route('community.create') }}" method="POST">
                        @csrf
                    <div class="">
                        <div class="first-input">
                            <input type="text" name="name" placeholder="Community Name" />
                        </div>

                        <div class="message-box">
                            <textarea name="description" placeholder="Describe the community"></textarea>
                        </div>

                        <div class="btn-section">
                            <button type="submit" class="next-btn">Create Community</button>
                        </div>
                    </div>
                    </form>
                </div>



            <!-- ASIDE RIGHT SECITON -->

            @include('include.invite')
        </div>
    </section>
@endsection
