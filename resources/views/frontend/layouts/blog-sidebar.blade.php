<div class="col-md-3 col-md-offset-1">
  <div class="sidebar hidden-sm hidden-xs">
    <div class="widget">
      <h6 class="upper">Search blog</h6>
      <form>
        <input name="search" type="text" placeholder="Search.." class="form-control">
      </form>
    </div>

    @php
        $category = App\Models\Categorypost::all();
    @endphp
    <!-- end of widget        -->
    <div class="widget">
      <h6 class="upper">Categories</h6>
      <ul class="nav">

       @foreach ($category as $cat)
          <li><a href="{{ route('blog.post.category', $cat -> slug) }}">{{ $cat -> name }}</a>
          </li>
       @endforeach

        </ul>
    </div>
    <!-- end of widget        -->
    @php
        $tags = App\Models\Tag::all();
    @endphp
    <div class="widget">
      <h6 class="upper">Popular Tags</h6>
      <div class="tags clearfix">
        @foreach ($tags as $tag)
          <a href="{{ route('blog.post.tag', $tag -> slug)}}">{{ $tag -> name }}</a>              
        @endforeach
      </div>
    </div>
    <!-- end of widget      -->
    @php
        $posts = App\Models\Post::latest() -> take(5) -> get();
    @endphp
    <div class="widget">
      <h6 class="upper">Latest Posts</h6>
      <ul class="nav">

        @foreach ($posts as $post)
            <li><a href="#">{{ $post -> title }}<i class="ti-arrow-right"></i><span>{{date( 'F, d, Y', strtotime($post -> created_at) )}}</span></a>
            </li>
        @endforeach
        
      </ul>
    </div>
    <!-- end of widget          -->
  </div>
  <!-- end of sidebar-->
</div>