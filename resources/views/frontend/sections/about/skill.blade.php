<section>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="title txt-sm-center txt-xs-center mt-0">
            <h3>This Is Our Story<span class="red-dot"></span></h3>
            <p class="serif">Voluptate reiciendis ducimus alias perspiciatis repellendus dolore voluptatibus dolor quae.</p>
            <hr>
          </div>
        </div>
        <div class="col-md-7 col-md-offset-1">
          <ul role="tablist" class="nav nav-tabs outline">
            <li role="presentation" class="active"><a href="#method-tab" role="tab" data-toggle="tab">Method</a>
            </li>
            <li role="presentation"><a href="#skills-tab" role="tab" data-toggle="tab">Skills</a>
            </li>
          </ul>
          <div class="tab-content">
            <div id="method-tab" role="tabpanel" class="tab-pane fade in active">
              <p class="alt-paragraph mb-15">Consectetur adipisicing elit. Nisi quibusdam adipisci dignissimos nihil cumque sapiente dolorem, laborum.</p>
              <p class="alt-paragraph mb-15">Aperiam maxime qui sed necessitatibus earum voluptatem nobis modi soluta, unde aliquid veniam reiciendis repudiandae voluptas possimus!</p>
              <p class="alt-paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur assumenda qui facilis magni quod quia quas recusandae cum rem amet, minus natus impedit autem dolores dolor, sed perspiciatis voluptate, est!</p>
            </div>

            @php
                $about_skill = App\Models\A_skill::latest() -> take(4) -> get();
            @endphp
              <div id="skills-tab" role="tabpanel" class="tab-pane fade">
                @foreach ($about_skill as $item)
                <div class="skill"><span class="skill-name">{{ $item -> name }}</span><span class="skill-perc">{{ $item -> progress }}%</span>
                  <div class="progress">
                    <div role="progressbar" data-progress="{{$item -> progress}}"  class="progress-bar colored"></div>
                  </div>
                </div>
                @endforeach        
              </div>
              
              
            </div>
          </div>
      </div>
      <!-- end of row                    -->
    </div>
    <!-- end of container                  -->
  </section>