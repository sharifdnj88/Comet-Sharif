<section class="pb-50 pt-50">
      @php
          $clients = App\Models\Client::where('status', true) -> latest() -> take(6) -> get();
          // $i = 1;
      @endphp     
    <div class="container">
      <div data-options="{&quot;items&quot;: 6, &quot;autoplay&quot;: true, &quot;margin&quot;: 100, &quot;mdItems&quot;: 5, &quot;smItems&quot;: 4, &quot;xsItems&quot;: 3}" class="owl-carousel">
        
        @foreach ($clients as $item)
          <div class="client">
            <img src="{{url('storage/clients/'. $item -> logo)}}" alt="">
          </div>
        @endforeach

        

      </div>
    </div>
    <!-- end of container-->
  </section>