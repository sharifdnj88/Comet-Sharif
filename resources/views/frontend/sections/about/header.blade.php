<section class="page-title parallax">
    @php
        $about_header = App\Models\A_header::latest() -> take(1) -> get();
    @endphp
    @foreach ($about_header as $item)
    <div data-parallax="scroll" data-image-src="{{url('storage/about_headers/' . $item -> photo)}}" class="parallax-bg"></div>        
    @endforeach
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              
              @foreach ($about_header as $item)
                <h1 class="upper">{{ $item -> header }}<span class="red-dot"></span></h1>
                <h4>{{ $item -> title }}</h4>
              @endforeach              
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
  </section>