@extends('layouts.main')
@section('content')

    <section class="login-page">
        <div class="left">
            <img src="{{asset('images/create-share.png')}}" alt="">
        </div>

        <div class="login-box mt-5">
            @include('include/alert')
            <h1>Welcome to Famlicy</h1>
            <form method="POST" action="{{ route('login.form') }}">
                @csrf
            <div class="input-sec">
                <input type="text" name="username" placeholder="Username" />
                <input type="password" name="password" placeholder="Password" />
            </div>
            <div class="forgotten mt-2 text-end">
                <a href="{{route('password.request')}}">Forgotten password</a>
            </div>
            <div class="login-btn-sec mt-3">
                <button class="login-btn">Login</button>
            </div>
            </form>
        </div>
    </section>
@endsection

