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
                            <h4 class="card-title">All Posts</h4>
                            <a href="" class="font-weight-bold btn btn-danger">Trash Posts <i class="fa fa-arrow-right"></i></a>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <div class="table-responsive">
                                <table class="table mb-0  data-table-said table-bordered table-secondary">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Types</th>
                                            <th>Category</th>
                                            <th>Tags</th>
                                            <th>Created-Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @forelse ($posts as $item)
                                            <tr>
                                                <td>{{ $loop -> index + 1 }}</td>
                                                <td>{{ $item -> title }}</td>
                                                <td>
                                                    @php
                                                        $featured = json_decode( $item -> featured );
                                                        echo $featured -> post_type;
                                                    @endphp
                                                </td>
                                                <td>
                                                    <ul style="padding-left: 10px">
                                                        @foreach ($item -> categorypost as $cat)
                                                            <li>{{$cat -> name}}</li>                                                            
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul style="padding-left: 10px">
                                                        @foreach ($item -> tag as $tag)
                                                            <li>{{$tag -> name}}</li>                                                            
                                                        @endforeach
                                                    </ul>
                                                </td>
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
                                                    <a href="{{route('portfolio-category.edit', $item -> id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit" ></i></a>
                                                    <form action="{{route('portfolio-category.destroy', $item -> id)}}" method="POST" class="d-inline">
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
                            <h4 class="card-title">Add new Posts</h4>
                        </div>
                        <div class="card-body">
                            @include('validate')
                            <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" type="text" value="{{old('title')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Post Types</label>
                                    <select name="type" class="form-control" id="post-type-selector">
                                        <option value="Standard">Standard</option>
                                        <option value="Gallery">Gallery</option>
                                        <option value="Video">Video</option>
                                        <option value="Audio">Audio</option>
                                        <option value="Quote">Quote</option>
                                    </select>
                                </div>
                                 {{-- Featured Photo Start --}}
                                 <div class="form-group post-standard">
                                    <label>Featured Photo</label>
                                    <hr>
                                    <img src="" id="slider-photo-preview" style="max-width: 100%" alt="">
                                    <br>
                                    <input name="standard" type="file" id="slider-photo" class="form-control d-none">                                    
                                    <label for="slider-photo">
                                        <img src="{{asset('assets/img/gallery.png')}}" alt="" style="width: 100px;cursor:pointer">
                                    </label>
                                </div>
                                {{-- Featured Photo End --}}

                                {{-- Gallery Start --}}
                                <div class="form-group post-gallery">
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
                                <div class="form-group post-video">
                                    <label>Video Post</label>
                                    <input name="video" type="text" value="{{old('video')}}" class="form-control">
                                </div>
                                <div class="form-group post-audio">
                                    <label>Audio Post</label>
                                    <input name="audio" type="text" value="{{old('audio')}}" class="form-control">
                                </div>
                                <div class="form-group post-quote">
                                    <label>Quote Post</label>
                                    <input name="quote" type="text" value="{{old('quote')}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Post Content</label>
                                    <hr>
                                    <textarea name="content" id="portfolio-desc"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Select Categories</label>
                                    <hr>
                                    <ul class="comet-list">
                                        @foreach ($cats as $cat)
                                            <li>
                                                <label><input name="cat[]" value="{{$cat -> id}}" type="checkbox"> <span style="cursor: pointer;"> {{ $cat -> name }}</span> </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label>Tags</label>
                                    <select name="tag[]" class="form-control comet-select" id="" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag -> id}}">{{$tag -> name}}</option>
                                        @endforeach
                                    </select>
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
                            <h4 class="card-title">Edit Posts</h4>
                        </div>
                        <div class="card-body">
                            @include('main-validate')
                            <form action="{{route('post.update', $edit -> id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" value="{{ $edit -> name }}" class="form-control">
                                </div>
                                {{-- Submit Button Start --}}                               
                                <div class="text-right">
                                    <a class="btn btn-danger" href="{{route('post-tags.index')}}">Back</a>
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