<div>
    <!-- Be present above all else. - Naval Ravikant -->

    @php
      $n = $avgStars;
      $whole = floor($n);
      $fraction = $n - $whole;
      $blankStars = 5 - $whole;
    @endphp
    @for ($i = 0; $i < $whole; $i++) <i class="bi bi-star-fill btn-outline-warning"></i>
    @endfor
    @if ($fraction >= 0.5)
      <i class="bi bi-star-half btn-outline-warning"></i>
      @for ($i = 0; $i < 5 - $whole - 1; $i++) 
        <i class="bi bi-star btn-outline-warning"></i>
      @endfor
    @else
        @for ($i = 0; $i < $blankStars; $i++) <i class="bi bi-star btn-outline-warning"></i>
        @endfor
    @endif
    <p class="text-warning">{{ $n }} stars</p>
</div>