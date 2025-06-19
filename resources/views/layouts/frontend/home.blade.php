@extends('layouts.frontend.layouts.app')
@section('content')
<div class="container">
    <h3 class="text-center text-danger card-title">Our Services</h3>
    <br>
    <div class="row">
        @foreach ($services as $service)
        <div class="col-md-4">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                  <h4 class="card-title text-danger">
                    <i class="text-danger material-icons">done_all</i>&nbsp;
                      {{$service->title}}
                    </h4>
                    <p class="card-text">
                        {{$service->description}}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <p class="card-text"><small class="text-muted">
    <a class="text-danger" href="{{url('/services')}}">Know More</a>
     </small></p>
</div>
<hr>
<br>
<div class="container">
      <h3 class="text-center text-danger card-title">About Us</h3>
      <br>
      <p class="card-text">
        @if($aboutData)
        {{$aboutData->description}}
        @endif
      </p>
      {{-- <p class="card-text"><small class="text-muted">
          <a class="text-danger" href="#">Know More</a>
       </small></p> --}}
    <img class="card-img-bottom" src="{{asset('/img/del.jpg')}}" rel="nofollow" alt="Card image cap">
  </div>
  <hr>
  <br>
  <div class="container">
    <h3 class="text-center text-danger card-title">Our Valuable Client</h3>
    <br>
    <div class="row">
        <div id='slider' class="owl-carousel owl-theme">
        @foreach ($clients as $client)
        {{-- <div class="col-md-3"> --}}
            <div class="card">
                <div class="">
                    <img src="{{asset('clients/'.$client->image)}}" alt="Rounded Image" class="rounded img-fluid">
                  </div>
                <div class="card-body">
                    <h4 class="card-title">{{$client->name}}</h4>
                    <h6 class="card-title">{{$client->title}}</h6>
                    <p>{{$client->body}}</p>
                </div>
            </div>
        {{-- </div> --}}
        @endforeach
    </div>
    </div>
  <hr>
  <br>
  <div class="container">
    <h3 class="text-center text-danger card-title">Meet Our Team</h3>
    <br>
    <div class="row">
        @foreach($authors as $author)
        <div class="col-md-3">
            <div class="card">
                <div class="">
                    <img src="{{asset('authority-team/'.$author->image)}}" alt="Rounded Image" class="rounded img-fluid">
                  </div>
                <div class="card-body">
                    <h4 class="card-title">{{$author->name}}</h4>
                    <h6 class="card-title">{{$author->title}}</h6>
                    <p>{{$author->body}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
  </div>
  <hr>
  <br>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
//   $("#myCarousel").on("slide.bs.carousel", function(e) {
//     var $e = $(e.relatedTarget);
//     var idx = $e.index();
//     var itemsPerSlide = 4;
//     var totalItems = $(".carousel-item").length;

//     if (idx >= totalItems - (itemsPerSlide - 4)) {
//       var it = itemsPerSlide - (totalItems - idx);
//       for (var i = 0; i < it; i++) {
//         // append slides to end
//         if (e.direction == "left") {
//           $(".carousel-item")
//             .eq(i)
//             .appendTo(".carousel-inner");
//         } else {
//           $(".carousel-item")
//             .eq(0)
//             .appendTo($(this).find(".carousel-inner"));
//         }
//       }
//     }
//   });


});

</script>
@endpush
