@extends('admin.layouts.app')
@section('title', 'Management Dashboard')
@section('main')
    <!-- Main Wrapper -->
    <div class="main-wrapper">
		
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')
                
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content container-fluid">
                
                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('login.page')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-header">
                            <div class="row align-items-center">
                                <div class="col-auto profile-image">
                                    <a href="#">
                                        <img class="rounded-circle" alt="User Image" src="{{ url('storage/admins/' .Auth::guard('admin') -> User() -> photo) }}">
                                    </a>
                                </div>
                                <div class="col ml-md-n2 profile-user-info">
                                    <h4 class="user-name mb-0">{{ Auth::guard('admin') -> User() -> name }}</h4>
                                    <h6 class="text-muted">{{ Auth::guard('admin') -> User() -> email }}</h6>
                                    <div class="user-Location"><i class="fa fa-map-marker"></i> {{ Auth::guard('admin') -> User() -> city }}, {{ Auth::guard('admin') -> User() -> country }}</div>
                                    <div class="about-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                </div>
                                <div class="col-auto profile-btn">
                                    
                                    <a href="#" class="btn btn-primary">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="profile-menu">
                            <ul class="nav nav-tabs nav-tabs-solid">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#password_tab">Password</a>
                                </li>
                            </ul>
                        </div>	
                        <div class="tab-content profile-tab-cont">
                            
                            <!-- Personal Details Tab -->
                            <div class="tab-pane fade show active" id="per_details_tab">
                            
                                <!-- Personal Details -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title d-flex justify-content-between">
                                                    <span>Personal Details</span> 
                                                    <a class="edit-link" data-toggle="modal" href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
                                                </h5>
                                                <div class="row">
                                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                                    <p class="col-sm-10">{{ Auth::guard('admin') -> User() -> name }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of Birth</p>
                                                    <p class="col-sm-10">{{ Auth::guard('admin') -> User() -> dob }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                                    <p class="col-sm-10">{{ Auth::guard('admin') -> User() -> email }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                                    <p class="col-sm-10">{{ Auth::guard('admin') -> User() -> mobile }}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                                                    <p class="col-sm-10 mb-0">{{ Auth::guard('admin') -> User() -> address }}<br>
                                                        {{ Auth::guard('admin') -> User() -> city }},<br>
                                                        {{ Auth::guard('admin') -> User() -> zip_code }},<br>
                                                        {{ Auth::guard('admin') -> User() -> country }}.</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Edit Details Modal -->
                                        <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" role="document" >
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Personal Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('validate')
                                                        <form action="{{route('admin.profile.change')}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row form-row">

                                                                <div class="col-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="change-avatar">
                                                                            <div class="profile-img text-center">
                                                                                @if ( Auth::guard('admin') -> User() -> photo )
                                                                                    <img style="width: 80px;height:80px;border-radius:50%;background-color:#555;padding:3px" src="{{url('storage/admins/'. Auth::guard('admin') -> User() -> photo )}}" alt="Sharif">
                                                                                    <hr>
                                                                                @else
                                                                                    <img src="" alt="User Image">
                                                                                @endif
                                                                            </div>
                                                                            <div class="upload-img text-center">
                                                                                <div class="change-photo-btn">
                                                                                    <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                                                    <input name="photo" type="file" class="upload">
                                                                                </div>
                                                                                <small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
                                                                                <hr>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>First Name</label>
                                                                        <input name="first_name" type="text" class="form-control" value="{{ Auth::guard('admin') -> User() -> first_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Last Name</label>
                                                                        <input name="last_name" type="text"  class="form-control" value="{{ Auth::guard('admin') -> User() -> last_name }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Date of Birth</label>
                                                                            <div class="said">
                                                                                <input name="dob" class="form-control" type="date" id="date" value="{{ Auth::guard('admin') -> User() -> dob }}">
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Email ID</label>
                                                                        <input name="email" type="email" class="form-control" value="{{ Auth::guard('admin') -> User() -> email }}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Mobile</label>
                                                                        <input name="mobile" type="text"  class="form-control" value="{{ Auth::guard('admin') -> User() -> mobile }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <h5 class="form-title"><span>Address</span></h5>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                    <label>Address</label>
                                                                        <input name="address" type="text" class="form-control" value="{{ Auth::guard('admin') -> User() -> address }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>City</label>
                                                                        <input name="city" type="text" class="form-control" value="{{ Auth::guard('admin') -> User() -> city }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Zip Code</label>
                                                                        <input name="zip_code" type="text" class="form-control" value="{{ Auth::guard('admin') -> User() -> zip_code }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Country</label>
                                                                        <input name="country" type="text" class="form-control" value="{{ Auth::guard('admin') -> User() -> country }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Edit Details Modal -->
                                        
                                    </div>

                                
                                </div>
                                <!-- /Personal Details -->

                            </div>
                            <!-- /Personal Details Tab -->
                            
                            <!-- Change Password Tab -->
                            <div id="password_tab" class="tab-pane fade">
                            
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Change Password</h5>
                                        <div class="row">
                                            <div class="col-md-10 col-lg-6">
                                                @include('validate')
                                                <form action="{{route('admin.password.change')}}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label>Old Password</label>
                                                        <input name="old_pass" type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Password</label>
                                                        <input name="pass" type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Confirm Password</label>
                                                        <input name="pass_confirmation" type="password" class="form-control">
                                                    </div>
                                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Change Password Tab -->
                            
                        </div>
                    </div>
                </div>
            
            </div>			
        </div>
        <!-- /Page Wrapper -->
    
    </div>
    <!-- /Main Wrapper -->
@endsection