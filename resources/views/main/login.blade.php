@extends('layouts.main')
@section('content')

    <section class="login-page">
        <div class="left">
            <img src="{{asset('images/create-share.png')}}" alt="">
        </div>
        <div class="login-box mt-5">
            <h1>Welcome to Famlicy</h1>
            <div class="input-sec">
                <input type="text" placeholder="Username" />
                <input type="text" placeholder="Password" />
            </div>
            <div class="forgotten mt-2 text-end">
                <a href="">Forgotten password</a>
            </div>
            <div class="login-btn-sec mt-3">
                <button class="login-btn">Login</button>
            </div>
        </div>
    </section>
@endsection

