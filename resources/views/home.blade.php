@extends('master')

@section('title', 'Restaurants reviews')


@section('content')
    <section class="py-5 container-fluid text-center bg-primary text-white">
        <h1 class="fw-light">Restaurants reviews</h1>
        <p>Find your next restaurant to try!</p>

        @guest
        <div>
          <a class="btn btn-light mr-4" href="{{ route('login') }}" role="button">Login</a>
          <a class="btn btn-primary" href="{{ route('register') }}" role="button">Sign in</a>
        </div>
        @endguest

        @auth
        <div>Logged in as: {{ Auth::user()->name }}</div>
          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a :href="route('logout')"
                class="btn btn-light my-2"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
        @endauth
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
                  <x-stars-review :avg-stars='$restaurant->avg_stars' />
                  
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