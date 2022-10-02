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
                            <h1>Forgot Password?</h1>
                            <p class="account-subtitle">Enter your email to get a password reset link</p>
                            @include('validate')
                            <!-- Form -->
                            <form action="{{route('forgot.password')}}" method="POST">
                                @csrf
                                <div class="form-group form-focus">
                                    <label class="focus-label">Email</label>
                                    <input name="email" type="email" class="form-control" placeholder="enter your valid email">                                    
                                </div>
                                <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Reset Password</button>
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