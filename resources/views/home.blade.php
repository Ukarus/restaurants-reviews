@extends('master')

@section('title', 'Restaurants reviews')


@section('content')
    <section class="py-5 container-fluid text-center bg-primary text-white">
        <h1 class="fw-light">Restaurants reviews</h1>
        <p>Find your next restaurant to try!</p>
    </section>

    <div class="py-5 bg-light">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

          @foreach($restaurants as $restaurant)
          <div class="col">

            <div class="card shadow-sm ">
              <img src="{{ $restaurant->photo }}" class="card-img-top" alt="">

              <div class="card-body">
                <h5 class="card-title">{{ $restaurant->name }}</h5>
                  @php
                    $n = $restaurant->avg_stars;
                    $whole = floor($n);
                    $fraction = $n - $whole;
                    $blankStars = 5 - $whole;
                  @endphp
                  @for ($i = 0; $i < $whole; $i++)
                      <i class="bi bi-star-fill btn-outline-warning"></i>
                  @endfor
                  @if ($fraction >= 0.5)
                    <i class="bi bi-star-half btn-outline-warning"></i>
                    @for ($i = 0; $i < 5 - $whole - 1; $i++)
                        <i class="bi bi-star btn-outline-warning"></i>
                    @endfor
                  @else
                    
                    @for ($i = 0; $i < $blankStars; $i++)
                        <i class="bi bi-star btn-outline-warning"></i>
                    @endfor
                  @endif
                <p class="card-text">{{ $restaurant->description}}</p>
                <a href="{{ route('reviews.index', ['restaurant' => $restaurant->id]) }}" class="btn btn-primary stretched-link">View more</a>
                <!-- <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div> -->
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
@endsection