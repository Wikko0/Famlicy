@extends('layouts.main')
@section('content')
    <section class="login-page">
        <div class="left">
            <img src="{{asset('images/create-share.png')}}" alt="">
        </div>

        <div class="login-box mt-5">
            @include('include/alert')
            <h1>Forgot Your Password?</h1>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="input-sec">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="login-btn-sec mt-3">
                    <button type="submit" class="login-btn">Send Password Reset Link</button>
                </div>
            </form>
        </div>
    </section>
@endsection
