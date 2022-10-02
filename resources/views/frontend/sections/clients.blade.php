<section>
    <div class="container">
      <div class="title center">
        <h4 class="upper">Some of the best.</h4>
        <h3>Our Clients<span class="red-dot"></span></h3>
        <hr>
      </div>
      <div class="section-content">
        <div class="boxes clients">
          <div class="row">

            @php
                $clients = App\Models\Client::where('status', true) -> latest() -> take(6) -> get();
                $i = 1;
            @endphp              

            @foreach ($clients as $item)

            @php
                  if( $i == 1 ){
                      $ClassName = 'border-right border-bottom';
                      $delay        = 0;
                  }elseif ( $i == 2 ) {
                      $ClassName = 'border-right border-bottom';
                      $delay        = 500;
                  }elseif ( $i == 3 ) {
                      $ClassName = 'border-bottom';
                      $delay        = 1000;
                  }elseif ( $i == 4 ) {
                      $ClassName = 'border-right';
                      $delay        = 0;
                  }elseif ( $i == 5 ) {
                      $ClassName = 'border-right';
                      $delay        = 500;
                  }elseif ( $i == 6 ) {
                      $ClassName = '';
                      $delay        = 1000;
                  }

              @endphp

              <div class="col-sm-4 col-xs-6 {{ $ClassName }}">
                <img src="{{url('storage/clients/'. $item -> logo)}}" alt="" data-animated="true" class="client-image" data-delay="{{$delay}}">
              </div>
              @php $i++;  @endphp
            @endforeach

          </div>
          <!-- end of row-->
        </div>
      </div>
      <!-- end of section content-->
    </div>
  </section>