@extends('admin.layouts.app')

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
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{ Auth::guard('admin') -> User() -> name }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">All Testimonials</h4>
                            <a href="{{route('slider.trash')}}" class="font-weight-bold btn btn-danger">Trash Sliders <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <div class="table-responsive">
                                <table class="table mb-0 text-center data-table-said table-bordered table-secondary">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Client Name</th>
                                            <th>Company</th>
                                            <th>Created-Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse ($testimonials as $item)
                                            <tr>
                                                <td>{{ $loop -> index + 1 }}</td>
                                                <td>{{ $item -> name }}</td>
                                                <td>{{ $item -> company }}</td>
                                                <td>{{ $item -> created_at -> DiffForHumans() }}</td>
                                                <td>
                                                    @if( $item -> status )
                                                        <span class="badge badge-success">Published</span>
                                                        <a href="" class="text-danger"><i class="fa fa-times-rectangle-o"></i> </a>
                                                    @else
                                                        <span class="badge badge-danger">Unpublished</span>
                                                        <a href="" class="text-success"><i class="fa fa-check-square-o"></i> </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="" class="btn btn-sm btn-warning"><i class="fa fa-edit" ></i></a>
                                                    <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash" ></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  Edit Option --}}
                <div class="col-md-4">

                    {{-- Admin Create Start --}}
                    @if( $form_type == 'create' )
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add new Testimonial</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('testimonial.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Client Name</label>
                                    <input name="name" type="text" value="{{old('name')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Company</label>
                                    <input name="company" type="text" value="{{old('company')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Testimonial</label>
                                    <input name="testimonial" type="text" value="{{old('testimonial')}}" class="form-control">
                                </div>
                                {{-- Submit Button Start --}}                               
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    {{-- Admin Create End --}}

                          
                </div>
            </div>         
            
        </div>			
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

@endsection