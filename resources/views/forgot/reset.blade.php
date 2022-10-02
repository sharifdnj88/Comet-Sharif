@extends('admin.layouts.app')

@section('main')

    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{asset('assets/img/logo-white.png')}}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Reset Password?</h1>
                            <p class="account-subtitle">Enter your new Password </p>
                            @include('validate')
                            <!-- Form -->
                            <form action="{{route('reset.password')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input name="email" class="form-control" value="{{ $email }}" type="email" Readonly >
                                </div>
                                <div class="form-group">
                                    <input name="password" class="form-control" type="password" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input name="password_confirmation" class="form-control" type="password" placeholder="Confirm Password">
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                                </div>
                            </form>
                            <!-- /Form -->
                            
                            <div class="text-center dont-have">Remember your password? <a href="{{route('login.page')}}">Login</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->

@endsection