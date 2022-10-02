@extends('frontend.layouts.app')

@section('frontend-main')
@include('frontend.layouts.header')

<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="{{asset('frontend/images/bg/2.jpg')}}" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">Single Item<span class="red-dot"></span></h1>
              <h4>Our best work.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
  </section>
  
  {{-- Slider Start --}}
    <section class="b-0">
      <div class="container">
        <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true, &quot;directionNav&quot;: true}" class="flexslider nav-inside">
          <ul class="slides">

            @foreach (json_decode($portfolio -> gallery) as $gallery_files )
              <li style="width: 100%;height:450px;object-fit:cover">
                <img src="{{ url('storage/portfolio/' . $gallery_files) }}" alt="">
              </li>
            @endforeach            
            
          </ul>
        </div>
      </div>
    </section>
  {{-- Slider End --}}
  

  <section class="p-0 b-0">
    <div class="boxes">
      <div class="container-fluid">
        <div class="row">
            @php
                $step_no = 1;
            @endphp
            @foreach (json_decode($portfolio -> steps) as $item)
                <div data-bg-color="#eaeaea" class="col-md-4">
                    <div class="number-box"><span>Step No.</span>
                    <h2>0{{ $step_no }}<span class="red-dot"></span></h2>
                    <h4>{{ $item -> stitle }}</h4>
                    <p>{{ $item -> sdesc }}</p>
                    </div>
                </div>  
                @php $step_no ++; @endphp
            @endforeach                  

        </div>
        <!-- end of row-->
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="project-detail">
            <p><strong>Client:</strong>{{ $portfolio -> client }}</p>
            <p><strong>Date:</strong>{{ date( 'F, d, Y', strtotime( $portfolio -> date ) ) }}</p>
            <p><strong>Link:</strong><a href="{{ $portfolio -> link }}">{{ $portfolio -> title }}</a>
            </p>
            <p><strong>Type:</strong>{{ $portfolio -> types }}</p>
          </div>
        </div>
        <div class="col-sm-8">
          <p>{!! htmlspecialchars_decode( $portfolio -> desc  ) !!}</p>
        </div>
      </div>
    </div>
  </section>
  {{-- <section class="controllers p-0">
    <div class="container">
      <div class="projects-controller"><a href="#" class="prev"><span><i class="ti-arrow-left"></i>Previous</span></a><a href="#" class="all"><span><i class="ti-layout-grid2"></i></span></a><a href="#" class="next"><span>Next<i class="ti-arrow-right"></i></span></a>
      </div>
    </div>
  </section> --}}

@include('frontend.layouts.footer')
@endsection

