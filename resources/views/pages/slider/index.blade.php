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
                            <h4 class="card-title">All Sliders</h4>
                            <a href="{{route('slider.trash')}}" class="font-weight-bold btn btn-danger">Trash Sliders <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <div class="table-responsive">
                                <table class="table mb-0 text-center data-table-said table-bordered table-secondary">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>title</th>
                                            <th>Photo</th>
                                            <th>Created-Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse ($all_slider as $item)
                                            <tr>
                                                <td>{{ $loop -> index + 1 }}</td>
                                                <td>{{ $item -> title }}</td>
                                                <td> <img style="max-width: 80px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.5);border-radius:5%;padding:3px;border:1px solid red" src="{{ url('storage/sliders/'. $item -> photo) }}" alt=""> </td>
                                                <td>{{ $item -> created_at ->diffForHumans() }}</td>
                                                <td>
                                                    @if( $item -> status )
                                                        <span class="badge badge-success">Published</span>
                                                        <a href="{{route('slider.status', $item -> id)}}" class="text-danger"><i class="fa fa-times-rectangle-o"></i> </a>
                                                    @else
                                                        <span class="badge badge-danger">Unpublished</span>
                                                        <a href="{{route('slider.status', $item -> id)}}" class="text-success"><i class="fa fa-check-square-o"></i> </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('slider.edit', $item -> id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit" ></i></a>
                                                    <a href="{{route('slider.trash.update', $item -> id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash" ></i></a>
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
                            <h4 class="card-title">Add new Slider</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" type="text" value="{{old('title')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Sub Title</label>
                                    <input name="subtitle" type="text" value="{{old('subtitle')}}" class="form-control">
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
                                <div class="form-group font-weight-bold">
                                    <label>Slider Button</label>
                                    <hr>
                                    <div class="slider-btn-opt">
                                        {{-- btn sections --}}
                                    </div>
                                    
                                    <a href="#" id="add_new_slider_btn" class="btn btn-danger btn-sm">Add Slider Button</a>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                            <h4 class="card-title">Edit Slider</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('slider.update', $edit -> id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" value="{{ $edit -> title }}" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Sub Title</label>
                                    <input name="subtitle" value="{{ $edit -> subtitle }}" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Photo</label>
                                    <hr>
                                    <img src="{{url('storage/sliders/'. $edit -> photo)}}" id="slider-photo-preview" style="max-width: 100%;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.5);border-radius:5%;border:3px solid red;padding:3px" alt="">
                                    <br>
                                    <input name="photo" type="file" id="slider-photo" class="form-control d-none">
                                    <input name="old_photo" value="{{$edit -> photo}}" type="hidden" class="form-control d-none">
                                    <label for="slider-photo">
                                        <img src="{{asset('assets/img/gallery.png')}}" alt="" style="width: 100px;cursor:pointer">
                                    </label>
                                </div>
                                {{--Slider btn sections Start --}}
                                    @php
                                        $s = 1;
                                    @endphp
                                <div class="form-group font-weight-bold">
                                    <label>Slider Button</label>
                                    <hr>
                                    
                                    <div class="slider-btn-opt">                                       
                                    @foreach (json_decode( $edit -> btns ) as $btn)
                                     
                                            <div class="btn-opt-area">
                                                <div class="d-flex justify-content-between">
                                                    <span class="font-weight-bold btn btn-sm btn-info mb-2">Button <span class="text-warning"> >> </span> {{ $s  }}</span>
                                                    <span class="text-danger remove_btn" style="cursor:pointer"><i class="fa fa-times-rectangle-o"></i></span>    
                                                </div>
                                                <input name="btn_title[]" class="form-control mb-3" type="text" value="{{ $btn -> btn_title }}" placeholder="Button Title">
                                                <input name="btn_link[]" class="form-control mb-4" type="text" value="{{ $btn -> btn_link }}" placeholder="Button Link">
                                            
                                                <select name="btn_type[]" class="form-control">
                                                    <option @if( $btn -> btn_type == 'btn-light-out' ) selected @endif value="btn-light-out">Default</option>    
                                                    <option @if( $btn -> btn_type == 'btn-color btn-full' ) selected @endif value="btn-color btn-full">Red</option>    
                                                </select>
                                                <hr>
                                            </div>                                     
                                        @php
                                            $s ++;
                                        @endphp                                     
                                    @endforeach
                                    </div>
                                    
                                    <a href="#" id="add_new_slider_btn" class="btn btn-danger btn-sm">Add Slider Button</a>
                                </div>
                                {{-- SLider btn sections End --}}
                                <div class="text-right">
                                    <a class="btn btn-warning" href="{{route('slider.index')}}">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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