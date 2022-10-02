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
                            <h4 class="card-title">All Vision</h4>
                            <a href="{{route('vision.trash')}}" class="font-weight-bold btn btn-danger">Trash Vision <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <div class="table-responsive">
                                <table class="table mb-0 text-center data-table-said table-bordered table-secondary">
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
                                        
                                        @forelse ($visions as $item)
                                            <tr>
                                                <td>{{ $loop -> index + 1 }}</td>
                                                <td>{{ $item -> title }}</td>
                                                <td>
                                                    <img style="max-width: 80px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.5);border-radius:5%;padding:3px;border:1px solid red;object-fit-cover" src="{{url('storage/visions/'. $item -> photo)}}" alt="">
                                                </td>
                                                <td>{{ $item -> created_at -> DiffForHumans() }}</td>
                                                <td>
                                                    @if( $item -> status )
                                                        <span class="badge badge-success">Published</span>
                                                        <a href="{{route('vision.status', $item -> id)}}" class="text-danger"><i class="fa fa-times-rectangle-o"></i> </a>
                                                    @else
                                                        <span class="badge badge-danger">Unpublished</span>
                                                        <a href="{{route('vision.status', $item -> id)}}" class="text-success"><i class="fa fa-check-square-o"></i> </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('vision.edit', $item -> id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit" ></i></a>
                                                    <a href="{{route('vision.trash.update', $item -> id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash" ></i></a>
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

                    {{-- Vision Create Start --}}
                    @if( $form_type == 'create' )
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add new Vision</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('vision.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" type="text" value="{{old('title')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input name="heading" type="text" value="{{old('heading')}}" class="form-control">
                                </div>                                
                                 {{-- Photo Start --}}
                                 <div class="form-group">
                                    <label>Photo</label>
                                    <hr>
                                    <img src="" id="slider-photo-preview" style="max-width: 100%" alt="">
                                    <br>
                                    <input name="photo" type="file" id="slider-photo" class="form-control d-none">
                                    <label for="slider-photo">
                                        <img src="{{asset('assets/img/gallery.png')}}" alt="" style="width: 100px;cursor:pointer">
                                    </label>
                                </div>
                                {{-- Photo End --}}

                                {{-- Vision Button Start --}}
                                <div class="form-group">
                                    <label class="btn btn-success btn-sm">Vision Name & Desc Add</label>
                                    <hr>
                                    <div class="vision-btn-opt">
                                        {{-- Vision data added --}}
                                    </div>


                                    <a href="#" id="add_vision_btn" class="btn btn-warning btn-sm">ADD</a>
                                </div>
                                {{-- Vision Button End --}}

                                {{-- Submit Button Start --}}                               
                                <div class="text-right">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    {{-- Vision Create End --}}


                    {{-- Vision Edit Start --}}
                    @if( $form_type == 'edit' )
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Vision</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('vision.update', $edit -> id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" type="text" value="{{ $edit -> title }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Heading</label>
                                    <input name="heading" type="text" value="{{ $edit -> heading }}" class="form-control">
                                </div>                                
                                 {{-- Photo Start --}}
                                 <div class="form-group">
                                    <label>Photo</label>
                                    <hr>
                                    <img src="{{url('storage/visions/' . $edit -> photo)}}" id="slider-photo-preview" style="max-width: 100%;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.5);border-radius:5%;padding:3px;border:1px solid red;object-fit-cover" alt="">
                                    <br>
                                    <input name="photo" type="file" id="slider-photo" class="form-control d-none">
                                    <input name="old_photo" type="hidden" value="{{ $edit -> photo }}" class="form-control d-none">
                                    <label for="slider-photo">
                                        <img src="{{asset('assets/img/gallery.png')}}" alt="" style="width: 100px;cursor:pointer">
                                    </label>
                                </div>
                                {{-- Photo End --}}

                                {{-- Vision Button Start --}}
                                <div class="form-group">
                                    <label class="btn btn-success btn-sm">Vision Name & Desc Add</label>
                                    <hr>
                                    @php
                                        $i = 1;
                                    @endphp
                                    <div class="vision-btn-opt">
                                        @foreach ( json_decode( $edit -> btns ) as $item)
                                            <div class="btn-opt-area">
                                                <div class="d-flex justify-content-between">
                                                    <span class="font-weight-bold btn btn-sm btn-info mb-2">Button  <span class="text-warning"> >> </span> {{$i}} </span>
                                                    <span class="text-danger remove_btn" style="cursor:pointer"><i class="fa fa-times-rectangle-o"></i></span>    
                                                </div>
                                                <input name="vision_name[]" value="{{ $item -> vision_name }}" type="text" class="form-control mb-2" placeholder="Vision Name">
                                                <input name="vision_desc[]" value="{{ $item -> vision_desc }}" type="text" class="form-control mb-2" placeholder="Vision Description">
                                            </div>  
                                            @php
                                                $i ++;
                                            @endphp
                                        @endforeach
                                    </div>


                                    <a href="#" id="add_vision_btn" class="btn btn-warning btn-sm">ADD</a>
                                </div>
                                {{-- Vision Button End --}}

                                {{-- Submit Button Start --}}                               
                                <div class="text-right">
                                    <a class="btn btn-warning" href="{{route('vision.index')}}">Back</a>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    {{-- Vision Edit End --}}

                          
                </div>
            </div>         
            
        </div>			
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

@endsection