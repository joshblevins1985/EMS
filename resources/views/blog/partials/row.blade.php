  <!-- Grid row -->
  <div class="row">



    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col-lg-12 col-xl-12">

      <!-- Post title -->
      <h3 class="font-weight-bold mb-3"><strong>{{$row->title}}</strong></h3>
      <!-- Excerpt -->
      <p class="dark-grey-text">
          {!!implode(' ', array_slice(explode(' ', $row->content), 0, 100));!!}
      </p>
      <!-- Post data -->
      <p>by <a class="font-weight-bold">{{$row->author}}</a>, {{Carbon\Carbon::createFromTimeStamp(strtotime($row->date_to_send))->diffForHumans()}} </p>
      <!-- Read more button -->
      <a class="btn btn-primary btn-md" href="/blog/{{$row->id}}">Read more</a>

    </div>
    <!-- Grid column -->

  </div>
  <!-- Grid row -->

  <hr class="my-5">