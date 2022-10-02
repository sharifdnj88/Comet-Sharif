@php
    $categories = App\Models\Category::all();
    $portfolios = App\Models\Portfolio::where('status', true) -> take(8) -> get();
@endphp

<section id="portfolio" class="pb-0">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="title m-0 txt-xs-center txt-sm-center">
            <h2 class="upper">Selected Works<span class="red-dot"></span></h2>
            <hr>
          </div>
        </div>
        <div class="col-md-6">
          <ul id="filters" class="no-fix mt-25">
            <li data-filter="*" class="active">All</li>

            @foreach ($categories as $cat)
              <li data-filter=".{{ $cat -> slug }}">{{ $cat -> name }}</li>                
            @endforeach
            
          </ul>
          <!-- end of portfolio filters-->
        </div>
      </div>
      <!-- end of row-->
    </div>
    <div class="section-content pb-0">
      <div id="works" class="four-col wide mt-50">

        @foreach ($portfolios as $port)
        <div class="work-item @foreach( $port -> category as $catt ) {{ $catt -> slug }} @endforeach ">
          <div class="work-detail">
            <a href="{{ route('portfolio.single.page', $port -> slug) }}">
              <img class="fimage" src="{{ url('storage/portfolio/' . $port -> featured ) }}" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>{{ $port -> title }}</h3>
                    <p>{{ $port -> types }}</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        @endforeach      

        
      </div>
      <!-- end of portfolio grid-->
    </div>
  </section>