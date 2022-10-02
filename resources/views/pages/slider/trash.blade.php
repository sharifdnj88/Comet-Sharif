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
                        <h3 class="page-title">Welcome {{ Auth::guard('admin') -> User() -> name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-1"></div>
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">All Slider Trash</h4>
                            <a href="{{route('slider.index')}}" class="btn btn-info font-weight-bold"><i class="fa fa-arrow-left"></i> Publish Sliders</a>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <div class="table-responsive">
                                <table class="table mb-0 data-table-said">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Created-Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($all_slider as $item)
                                            @if ( $item -> name !== 'Sharif' )
                                                <tr>
                                                    <td>{{$loop-> index  + 1}}</td>
                                                    <td>{{ $item -> title }}</td>
                                                    <td>
                                                        @if ( $item -> photo == 'avatar.png' )
                                                            <img style="width: 60px;height:60px" src="{{url('storage/sliders/avatar.png')}}" alt="">                                                        
                                                        @else 
                                                            <img style="width: 60px;height:60px" src="{{url('storage/sliders/'.$item->photo)}}" alt="">
                                                        @endif                                                 
                                                    </td>
                                                    <td>{{ $item -> created_at -> diffForHumans() }}</td>
                                                    <td>
                                                        @if( $item -> status )
                                                            <span class="badge badge-success">Active Slider</span>
                                                            <a href="{{route('slider.status', $item -> id)}}" class="text-danger"><i class="fa fa-times-rectangle-o"></i> </a>
                                                        @else
                                                            <span class="badge badge-danger">Blocked Slider</span>
                                                            <a href="{{route('slider.status', $item -> id)}}"" class="text-success"><i class="fa fa-check-square-o"></i> </a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning" href="{{route('slider.trash.update', $item -> id)}}">Restore</a>
                                                        <form action="{{route('slider.destroy', $item -> id)}}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger delete-btn"  type="submit">Delete Permanently</button>
                                                        </form>
                                                </td>
                                                </tr>  
                                            @endif  
                                        @empty
                                            <tr>
                                                <td class="text-danger text-center" colspan="6">No records found</td>
                                            </tr>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>         
            
        </div>			
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

@endsection