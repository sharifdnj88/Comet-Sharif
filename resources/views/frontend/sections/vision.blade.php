<section>
      @php
          $visions = App\Models\Vision::where('status', true) -> take(1) -> latest() -> get();
      @endphp
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-4 img-side img-right">
          <div class="img-holder">
            @foreach ($visions as $item)
              <img src="{{url('storage/visions/' . $item -> photo)}}" alt="" class="bg-img">
            @endforeach
          </div>
        </div>
        <!-- end of side background image-->
      </div>
      <!-- end of row-->
    </div>
    <div class="container">
      
      <div class="row">

        @foreach ($visions as $item)
        <div class="col-md-5 col-sm-8">
          <div class="title">
            <h4 class="upper">{{ $item -> title }}.</h4>
            <h3>{{ $item -> heading }}<span class="red-dot"></span></h3>
            <hr>
          </div>
          <div class="row">
            @foreach ( json_decode( $item -> btns ) as $item)
            <div class="col-sm-6">
              <div class="text-box">
                <h4 class="upper small-heading">
                        {{ $item -> vision_name }}
                      </h4>
                      <p>{{ $item -> vision_desc }}</p>
                    </div>
                    <!-- end of text box-->
                  </div>
                  @endforeach
          </div>
          <!-- end of row              -->
        </div>
        @endforeach
        
      </div>
      <!-- end of row-->
    </div>
    <!-- end of container-->
  </section>