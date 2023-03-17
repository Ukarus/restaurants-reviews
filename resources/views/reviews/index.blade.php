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

  .rating {
  --dir: right;
  --fill: gold;
  --fillbg: rgba(100, 100, 100, 0.15);
  --heart: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.328l-1.453-1.313q-2.484-2.25-3.609-3.328t-2.508-2.672-1.898-2.883-0.516-2.648q0-2.297 1.57-3.891t3.914-1.594q2.719 0 4.5 2.109 1.781-2.109 4.5-2.109 2.344 0 3.914 1.594t1.57 3.891q0 1.828-1.219 3.797t-2.648 3.422-4.664 4.359z"/></svg>');
  --star: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.25l-6.188 3.75 1.641-7.031-5.438-4.734 7.172-0.609 2.813-6.609 2.813 6.609 7.172 0.609-5.438 4.734 1.641 7.031z"/></svg>');
  --stars: 5;
  --starsize: 3rem;
  --symbol: var(--star);
  --value: 1;
  --w: calc(var(--stars) * var(--starsize));
  --x: calc(100% * (var(--value) / var(--stars)));
  block-size: var(--starsize);
  inline-size: var(--w);
  position: relative;
  touch-action: manipulation;
  -webkit-appearance: none;
}
[dir="rtl"] .rating {
  --dir: left;
}
.rating::-moz-range-track {
  background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
  block-size: 100%;
  mask: repeat left center/var(--starsize) var(--symbol);
}
.rating::-webkit-slider-runnable-track {
  background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
  block-size: 100%;
  mask: repeat left center/var(--starsize) var(--symbol);
  -webkit-mask: repeat left center/var(--starsize) var(--symbol);
}
.rating::-moz-range-thumb {
  height: var(--starsize);
  opacity: 0;
  width: var(--starsize);
}
.rating::-webkit-slider-thumb {
  height: var(--starsize);
  opacity: 0;
  width: var(--starsize);
  -webkit-appearance: none;
}
.rating, .rating-label {
  display: block;
  font-family: ui-sans-serif, system-ui, sans-serif;
}
.rating-label {
  margin-block-end: 1rem;
}


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

  <div class="row mb-4 ">
    @guest
    <div class="col">
      You need to <a href="{{ route('register') }}">Sign in</a> to write reviews

    </div>
    @endguest


    @auth
      @if ($review != null)
      <!-- {{ $review }} -->
        <form action="{{ route('reviews.update', $review) }}" method="post">
          @csrf
          @method('put')

          <div class="col-3 my-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled placeholder="Enter name" name="name">
          </div>

          <label class="rating-label">
            <strong>Rating</strong>
            <input
              style="--value:{{ $review->stars }};"
              id="stars"
              name="stars"
              class="rating"
              max="5"
              oninput="this.style.setProperty('--value', this.value)"
              step="0.5"
              type="range"
              value="{{ $review->stars }}">
          </label>



          <div class="col-12 mb-3">
            <textarea name="review" id="review"  class="form-control" placeholder="Write your review here">
            {{ $review->review }}
            </textarea>
          </div>

          <button type="submit" class="btn btn-warning">Update your review</button>
        </form>
        
        <form action="{{ route('reviews.destroy', $review) }}" method="post" class="my-2">
          @method('delete')
          @csrf
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>

      @else
        <form action="{{ route('reviews.store') }}" method="post">
          @csrf
          <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
          
          <div class="col-3 my-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled placeholder="Enter name" name="name">
          </div>

          <label class="rating-label">
            <strong>Rating</strong>
            <input
              
              name="rating"
              class="rating"
              max="5"
              oninput="this.style.setProperty('--value', this.value)"
              step="0.5"
              type="range"
              value="1">
          </label>



          <div class="col-12 mb-3">
            <textarea name="review" id="review"  class="form-control" placeholder="Write your review here">
            </textarea>
          </div>

          <button type="submit" class="btn btn-primary">Post a review</button>
        </form>
      @endif
    @endauth
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

<script>

  // const review = {{ Js::from($review) }};
  // console.log(review);
  // @if ($review != null)
  //   let review = {{ Js::from($review) }};
  //   console.log(review);
  //   document.getElementById('rating').style.setProperty('--value', review.stars );
  // @endif

</script>

@endsection