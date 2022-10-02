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
                            <h4 class="card-title">All About Skill</h4>
                            <a href="" class="font-weight-bold btn btn-danger">Trash About-Skill <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <div class="table-responsive">
                                <table class="table mb-0 text-center data-table-said table-bordered table-secondary">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Progress</th>
                                            <th>Created-Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($about_skill as $item)
                                            <tr>
                                                <td>{{ $loop -> index + 1 }}</td>
                                                <td>{{ $item -> name }}</td>
                                                <td>{{ $item -> progress  }} %</td>
                                                <td>{{$item -> created_at -> DiffForHumans()}}</td>
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
                                                    <a href="{{route('about_skill.edit', $item -> id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit" ></i></a>
                                                    <form action="{{route('about_skill.destroy', $item -> id)}}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger delete-btn"  type="submit"><i class="fa fa-trash" ></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
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
                            <h4 class="card-title">Add new About-Skill</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('about_skill.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" value="{{old('name')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Progress</label> <br>
                                    <div class="d-flex justify-content-between bg-danger text-white shadow-lg" style="border-radius: 10px;padding:5px 10px">
                                        <input type="range" id="percentage" name="progress" min="0" max="100"
                                            oninput="this.nextElementSibling.value = this.value">
                                        <output type="number">50</output>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-warning shadow">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    {{-- Admin Create End --}}

                    {{--  Admin Edit Start --}}
                    @if( $form_type == 'edit' )
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">About Skill Edit</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('about_skill.update', $edit -> id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" value="{{$edit -> name}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Progress</label> <br>
                                    <div class="d-flex justify-content-between bg-danger text-white shadow-lg" style="border-radius: 10px;padding:5px 10px">
                                        <input type="range" id="percentage" name="progress"  min="0" max="100"
                                            oninput="this.nextElementSibling.value = this.value">
                                        <output  type="number">{{$edit -> progress}}</output>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a class="btn btn-danger shadow-lg" href="{{route('about_skill.index')}}">Back</a>
                                    <button type="submit" class="btn btn-warning shadow">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif           
                     {{--  Admin Edit End --}}         
                </div>
            </div>         
            
        </div>			
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

@endsection