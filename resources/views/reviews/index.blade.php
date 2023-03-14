@extends('master')

@section('title', 'Restaurants reviews')

@section('content')

<style>
  #header{
      background-image: url('../images/trolltunga.jpg');
      width: 100%;
      height: auto;
      background-size: cover;
  }

  .maintxt {position: relative;}
.maintxt > img, .overlay-text {position: absolute;}

</style>


<section class="container">
  <div class="p-5 bg-primary text-white text-center rounded">
    <h1 class="fw-light ">{{ $restaurant->name }}</h1>
    <img src="{{ $restaurant->photo }}" alt="Restaurant photo" class="d-block mx-auto my-1 w-25 h-25" >
    <!-- <p class="fw-light carousel-caption">{{ $restaurant->name }}</p> -->
    <x-stars-review :avg-stars='$restaurant->avg_stars' />
    <p class="text-white">{{ $restaurant->address }}</p>
  </div>

</section>
<div class="container">
  <div class="row">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Reviews</li>
      </ol>
    </nav>
  </div>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    @foreach($restaurant->reviews as $review)
    <div class="col">
      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">{{ $review->author }}</h5>
          <x-stars-review :avg-stars='$review->stars' />
          <p class="card-text">{{ $review->review }}</p>
        </div>
      </div>

    </div>
    @endforeach
  </div>
</div>
@endsection