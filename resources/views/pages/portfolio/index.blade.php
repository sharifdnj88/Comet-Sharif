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
                            <h4 class="card-title">All Categories</h4>
                            <a href="" class="font-weight-bold btn btn-danger">Trash Clients <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <div class="table-responsive">
                                <table class="table mb-0  data-table-said table-bordered table-secondary">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Feature</th>
                                            <th>Category</th>
                                            <th>Client</th>
                                            <th>Date</th>
                                            <th>Created-Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse ($portfolios as $item)
                                            <tr>
                                                <td>{{ $loop -> index + 1 }}</td>
                                                <td>{{ $item -> title }}</td>
                                                <td>
                                                    <img style="max-width: 80px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.5);border-radius:5%;padding:3px;border:1px solid red;object-fit-cover" src="{{url('storage/portfolio/'. $item -> featured)}}" alt="">
                                                </td>
                                                <td>
                                                    <ul class="comet-list">
                                                        @foreach ($item -> category as $cat)
                                                            <li> <span class="text-danger"><i class="fa fa-angle-double-right"></i></span> {{ $cat -> name }}</li>                                                            
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $item -> client }}</td>
                                                <td>{{ date('F d, Y', strtotime( $item -> date ) ) }}</td>
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
                                                    <a href="{{route('portfolio.edit', $item -> id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit" ></i></a>
                                                    <form action="{{route('portfolio.destroy', $item -> id)}}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger delete-btn"  type="submit"><i class="fa fa-trash" ></i></button>
                                                    </form>
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
                            <h4 class="card-title">Add new Portfolio</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('portfolio.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" type="text" value="{{old('title')}}" class="form-control">
                                </div>
                                 {{-- Featured Photo Start --}}
                                 <div class="form-group">
                                    <label>Featured Photo</label>
                                    <hr>
                                    <img src="" id="slider-photo-preview" style="max-width: 100%" alt="">
                                    <br>
                                    <input name="photo" type="file" id="slider-photo" class="form-control d-none">                                    
                                    <label for="slider-photo">
                                        <img src="{{asset('assets/img/gallery.png')}}" alt="" style="width: 100px;cursor:pointer">
                                    </label>
                                </div>
                                {{-- Featured Photo End --}}

                                {{-- Gallery Start --}}
                                <div class="form-group">
                                    <label>Gallery Photo</label>
                                    <hr>
                                    <div class="port-gall">

                                    </div>
                                    <input name="gallery[]" multiple type="file" id="portfolio-gallery" class="form-control d-none">                                    
                                    <label for="portfolio-gallery">
                                        <img src="{{asset('assets/img/gallery.png')}}" alt="" style="width: 100px;cursor:pointer">
                                    </label>
                                </div>
                                {{-- Gallery End --}}
                                <div class="form-group">
                                    <label>Select Categories</label>
                                    <hr>
                                    <ul class="comet-list">
                                        @foreach ($categories as $cat)
                                            <li>
                                                <label><input name="cat[]" value="{{$cat -> id}}" type="checkbox"> <span style="cursor: pointer;"> {{ $cat -> name }}</span> </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label>Project Description</label>
                                    <hr>
                                    <textarea name="desc" id="portfolio-desc"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Project Steps</label>
                                        <div id="accordion">
                                            {{-- Step One --}}
                                            <div class="card portfolio-step shadow-sm">
                                            <div class="card-header" id="headingOne">
                                                <h4 class="mb-0" data-toggle="collapse" data-target="#collapseOne" style="cursor: pointer">
                                                    Step 01
                                                </h4>
                                            </div>                                        
                                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                
                                                    <div class="my-3">
                                                        <label>Steps Title</label>
                                                        <input class="form-control" name="stitle[]" type="text">
                                                    </div>
                                                    <div class="my-3">
                                                        <label>Steps Description</label>
                                                        <textarea name="sdesc[]" id="" cols="30" rows="10" class="form-control"></textarea>
                                                    </div>

                                                </div>
                                            </div>
                                            </div>
                                            {{-- Step Two Start --}}
                                                <div class="card portfolio-step shadow-sm">
                                                <div class="card-header" id="headingOne">
                                                    <h4 class="mb-0" data-toggle="collapse" data-target="#collapseTwo" style="cursor: pointer">
                                                        Step 02
                                                    </h4>
                                                </div>                                        
                                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                    
                                                        <div class="my-3">
                                                            <label>Steps Title</label>
                                                            <input class="form-control" name="stitle[]" type="text">
                                                        </div>
                                                        <div class="my-3">
                                                            <label>Steps Description</label>
                                                            <textarea name="sdesc[]" id="" cols="30" rows="10" class="form-control"></textarea>
                                                        </div>
    
                                                    </div>
                                                </div>
                                                </div>
                                            {{-- Step Two End --}}
                                            {{-- Step Three Start --}}
                                            <div class="card portfolio-step shadow-sm">
                                                <div class="card-header" id="headingOne">
                                                    <h4 class="mb-0" data-toggle="collapse" data-target="#collapseThree" style="cursor: pointer">
                                                        Step 03
                                                    </h4>
                                                </div>                                        
                                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                    
                                                        <div class="my-3">
                                                            <label>Steps Title</label>
                                                            <input class="form-control" name="stitle[]" type="text">
                                                        </div>
                                                        <div class="my-3">
                                                            <label>Steps Description</label>
                                                            <textarea name="sdesc[]" id="" cols="30" rows="10" class="form-control"></textarea>
                                                        </div>
    
                                                    </div>
                                                </div>
                                                </div>
                                            {{-- Step Three End --}}
                                      </div>

                                </div>
                                <div class="form-group">
                                    <label>Client Name</label>
                                    <input name="client" type="text" value="{{old('client')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Project Link</label>
                                    <input name="link" type="text" value="{{old('link')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Project Types</label>
                                    <input name="types" type="text" value="{{old('types')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Project Date</label>
                                    <input name="date" type="date" value="{{old('date')}}" class="form-control">
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
                    {{-- Admin Edit Start --}}
                    @if( $form_type == 'edit' )
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Portfolio</h4>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <form action="{{route('portfolio.update', $edit -> id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" value="{{ $edit -> name }}" class="form-control">
                                </div>
                                {{-- Submit Button Start --}}                               
                                <div class="text-right">
                                    <a class="btn btn-danger" href="{{route('portfolio-category.index')}}">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    {{-- Admin Edit End --}}

                          
                </div>
            </div>         
            
        </div>			
    </div>
    <!-- /Page Wrapper -->

</div>
<!-- /Main Wrapper -->

@endsection