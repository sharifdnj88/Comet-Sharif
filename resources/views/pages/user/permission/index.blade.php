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
                        <div class="card-header">
                            <h4 class="card-title">All Permission</h4>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <div class="table-responsive">
                                <table class="table mb-0 data-table-said table-bordered table-primary">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Created-Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_permission as $item)
                                            <tr>
                                                <td>{{$loop-> index  + 1}}</td>
                                                <td>{{ $item -> name }}</td>
                                                <td>{{ $item -> slug }}</td>
                                                <td>{{ $item -> created_at -> diffForHumans() }}</td>
                                                <td>
                                                    {{-- <a class="btn btn-sm btn-info" href=""><i class="fa fa-eye" ></i></a> --}}
                                                    <a class="btn btn-sm btn-warning" href="{{route('permission.edit', $item -> id)}}"><i class="fa fa-edit" ></i></a>
                                                    <form action="{{route('permission.destroy', $item -> id)}}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger delete-btn"  type="submit"><i class="fa fa-trash" ></i></button>
                                                    </form>
                                            </td>
                                            </tr>    
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center font-weight-bold" colspan="5">No records found</td>
                                            </tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  Edit Option --}}
                <div class="col-md-4">
                    @if( $form_type == 'edit' )
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Permission</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('permission.update', $edit -> id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" value="{{ $edit -> name }}" type="text" class="form-control">
                                </div>
                                <div class="text-right">
                                    <a class="btn btn-warning" href="{{route('permission.index')}}">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    @if( $form_type == 'create' )
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add new Permission</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('permission.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" class="form-control">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>         
            
        </div>			
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

        
@endsection