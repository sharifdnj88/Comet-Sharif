@extends('frontend.layouts.app')

@section('frontend-main')
   @include('frontend.layouts.header')
   <!-- Home Section-->
   <section id="home">
    <!-- Home Slider-->
    <div id="home-slider" class="flexslider">
      <ul class="slides">

        @php
          $sliders = App\Models\Slider::latest()-> where('status', true) -> get();    
        @endphp

        @foreach ($sliders as $item)
          <li>
            <img src="{{url('storage/sliders/'. $item -> photo)}}" alt="">
            <div class="slide-wrap">
              <div class="slide-content">
                <div class="container">
                  <h1>{{ $item -> title }}<span class="red-dot"></span></h1>
                  <h6>{{ $item -> subtitle }}</h6>
                  <p>
                    @foreach (json_decode( $item -> btns ) as $item)
                      <a href="{{ $item -> btn_link }}" class="btn {{ $item -> btn_type }}">{{ $item -> btn_title }}</a>
                    @endforeach                    
                  </p>
                </div>
              </div>
            </div>
          </li>
        @endforeach

      </ul>
    </div>
    <!-- End Home Slider-->
  </section>
  <!-- End Home Section-->
   @include('frontend.sections.title')
   @include('frontend.sections.expertise')
   @include('frontend.sections.vision')
   @include('frontend.sections.portfolio')
   @include('frontend.sections.clients')
   @include('frontend.sections.testimonial')
   @include('frontend.sections.blog')
   @include('frontend.layouts.footer')
@endsection