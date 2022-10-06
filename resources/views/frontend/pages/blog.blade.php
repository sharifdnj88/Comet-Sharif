@extends('frontend.layouts.app')

@section('frontend-main')
@include('frontend.layouts.header')
@include('frontend.sections.contact.contact_header')
@php
    if( isset( $_GET['search'] ) ){
      $key  = $_GET['search'];
        $posts = App\Models\Post::where('title', 'LIKE', '%'.$key.'%') -> orWhere('content', 'LIKE', '%'.$key.'%') -> get();
    }
@endphp
<section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="blog-posts">

            @foreach ($posts as $post)
              <article class="post-single">
                <div class="post-info">
                  <h2><a href="#">{{$post -> title}}</a></h2>
                  <h6 class="upper"><span>By</span><a href="#"> {{$post -> author -> name}}</a><span class="dot"></span><span>{{date('F, d, Y', strtotime($post -> created_at))}}</span><span class="dot"></span>
                      
                      @foreach ($post -> tag as $tag)
                          <a href="#" class="post-tag">{{$tag -> name}}</a> @if ( ($loop -> index +1) < count( $post -> tag ) ) -   @endif </h6>                        
                      @endforeach

                </div>

                @php
                    $featured = json_decode($post -> featured);
                @endphp


                {{-- For Gallery Post --}}
                @if($featured -> post_type == 'Gallery')
                <div class="post-media">
                  <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true" class="flexslider nav-outside">
                    
                    <ul class="slides">
                      @foreach ( json_decode($featured -> gallery) as $gall)
                        <li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
                          <img src="{{url('storage/posts/' .$gall)}}" alt="" draggable="false">
                        </li>     
                      @endforeach                             

                    </ul>
                  </div>
                </div>
                @endif

                {{-- For Video Post --}}
                @if( $featured -> post_type == 'Video' )
                <div class="post-media">
                  <div class="media-video">
                    <iframe src="{{url($featured -> video)}}" frameborder="0"></iframe>
                  </div>
                </div>
                @endif

                {{-- For Standard Post --}}
                @if( $featured -> post_type == 'Standard' )
                <div class="post-media">
                  <a href="#">
                    <img src="{{url('storage/posts/' .$featured -> standard)}}" alt="">
                  </a>
                </div>
                @endif

                {{-- Audio Post --}}
                @if( $featured -> post_type == 'Audio' )
                <div class="post-media">
                  <div class="media-audio">
                    <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/51057943&amp;amp;color=ff5500&amp;amp;auto_play=false&amp;amp;hide_related=false&amp;amp;show_comments=true&amp;amp;show_user=true&amp;amp;show_reposts=false" frameborder="0"></iframe>
                  </div>
                </div>
                @endif


                <div class="post-body">

                  {!! Str::of( htmlspecialchars_decode( $post -> content ) ) -> words(20, '--->>') !!}                
                    
                  <p><a href="{{route('single.blog', $post -> slug)}}" class="btn btn-color btn-sm">Read More</a>
                  </p>
                </div>
              </article>
            <!-- end of article-->
            @endforeach





          </div>
          <ul class="pagination">
            <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="ti-arrow-left"></i></span></a>
            </li>
            <li class="active"><a href="#">1</a>
            </li>
            <li><a href="#">2</a>
            </li>
            <li><a href="#">3</a>
            </li>
            <li><a href="#">4</a>
            </li>
            <li><a href="#">5</a>
            </li>
            <li><a href="#" aria-label="Next"><span aria-hidden="true"><i class="ti-arrow-right"></i></span></a>
            </li>
          </ul>
          <!-- end of pagination-->


        </div>

        @include('frontend.layouts.blog-sidebar')
        
      </div>
      <!-- end of row-->
    </div>
    <!-- end of container-->
  </section>


@include('frontend.layouts.footer')
@endsection