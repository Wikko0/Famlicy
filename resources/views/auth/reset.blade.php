@extends('layouts.main')
@section('content')
    <section class="login-page">
        <div class="left">
            <img src="{{asset('images/create-share.png')}}" alt="">
        </div>

        <div class="login-box mt-5">
            @include('include/alert')
            <h1>Reset Your Password</h1>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-sec">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" required>
                    <input type="password" name="password" class="form-control" placeholder="New Password" required>
                    <input type="password" name="password_confirmation" placeholder="Confirm New Password" class="form-control" required>
                </div>
                <div class="login-btn-sec mt-3">
                    <button class="login-btn">Reset Password</button>
                </div>
            </form>
        </div>
    </section>
@endsection
