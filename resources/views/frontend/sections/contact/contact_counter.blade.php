<section>
    @php
        $counter_contact = App\Models\Contact_counter::latest() ->take(4) -> get();
     @endphp
    <div class="container">
      <div class="row">

        @foreach ($counter_contact as $item)
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <div class="counter-icon"><i class="{{$item -> icon}}"></i>
            </div>
            <div class="counter-content">
                <h5><span data-count="{{$item -> counter}}" class="number-count">{{$item -> counter}}</span><span class="red-dot"></span></h5><span>{{$item -> title}}</span>                
              </div>
          </div>
          <!-- end of counter              -->
        </div>
        @endforeach

      </div>
    </div>
  </section>