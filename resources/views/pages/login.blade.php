@extends('admin.layouts.app')

@section('main')
    <!-- Main Wrapper -->
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="assets/img/logo-white.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <p class="account-subtitle">Access to our dashboard</p>
                            @include('validate')
                            <!-- Form -->
                            <form action="{{route('admin.login')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input name="email" class="form-control" type="text" placeholder="Email/Mobile">
                                </div>
                                <div class="form-group">
                                    <input name="password" class="form-control" type="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                </div>
                            </form>
                            <!-- /Form -->
                            
                            <div class="text-center forgotpass"><a href="{{route('forgot.password.page')}}">Forgot Password?</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Main Wrapper -->
@endsection