@include('frontend.layouts.header')
<section class="hero-ther inner_header">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6 text-center">
           <h1>{{$projects->slug}}
           </h1>
           @php
                $originalDateTime = $projects->start_date_time;
                $timestamp = strtotime($originalDateTime);
                $formattedDateTime = date("F j, g:i A", $timestamp);
            @endphp
           <p>{{$formattedDateTime}}</p>
              <div class="bid-box-status">
                <div class="bid-box-status-ic"><img src="{{ asset('frontend/images/private.svg') }}"><span>{{ $projects->auctionType->name }}</span></div>
              </div>
           {{-- <div class="inner_header_status">/ --}}
              {{-- @if ($projects->auctionType->name == 'Private' || $projects->auctionType->name == 'Timed')
                    <div class="countdown-time thisisdemoclass" data-id='{{ $projects->id }}'
                            data-date='{{ $projects->start_date_time }}' id="countdown-{{ $projects->id }}">
                            <ul>
                                <li><span class="days"></span>days</li>
                                <li><span class="hours"></span>Hours</li>
                                <li><span class="minutes"></span>Minutes</li>
                                <li><span class="seconds"></span>Seconds</li>
                            </ul>
                    </div>
                    @endif --}}
           {{-- </div> --}}
           <!-- <form action="" class="search-frm-prdt" id="searchForm">
              <input type="text" name="search" id="searchInput" placeholder="Search products...">
              <button type="button" onclick="submitSearchForm()"><img class="w-100" src="{{ asset('frontend/images/rounded-sr.svg') }}" alt=""></button>
            </form> -->
            <form action="" class="search-frm-prdt" id="searchForm">
                <input type="text" name="search" id="searchInput" placeholder="Search products...">
                <button type="button" onclick="submitSearchForm()">
                    <img class="w-100" src="{{ asset('frontend/images/rounded-sr.svg') }}" alt="">
                </button>
            </form>

        </div>
      </div>
    </div>
  </section>
  <section class="list-fliter">
    <div class="container">
      <div class="result-lst">
      <h3>{{ $totalItems }} Items</h3>
        <div class="fliter-short">
          <form action="" class="cmn-frm">
            <select name="sort" class="m-0" onchange="this.form.submit()">
                <option value="price_low_high">Price: Low to High</option>
                <option value="price_high_low">Price: High to Low</option>
                <option value="">Number of Bids: Low to High</option>
                <option value="">Number of Bids: Low to High</option>
            </select>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="product-list-man">
    <div class="container">
      <div class="row">
      @foreach($products as $product)
        <div class="col-md-6">
          <a href="{{ url('productsdetail', $product->slug) }}">
            <div class="card-product">
              <div class="product-image">
              @if ($product->galleries->isNotEmpty())
                 <img src="{{ asset($product->galleries->first()->image_path) }}" alt="">
             @else
                <img src="{{asset('frontend/images/default-product-image.png')}}" alt="Default Image">
             @endif
               
                <div class="heat-like wishlist-heart @if(in_array($product->id, $wishlist)) active @endif" data-product-id="{{ $product->id }}">
                    <input type="checkbox" name="" id="" @if(in_array($product->id, $wishlist)) checked @endif>
                    <img src="{{asset('frontend/images/heart.png')}}" alt="">
                </div>
              </div>
              <div class="card-product-dtl" >
                <div style="height: 15px;"></div>
                <h3 >{{$product->lot_no}}: {{$product->title}}</h3>
                <h5>${{$product->reserved_price}}</h5>
                <p>Current Bid: <span> $1400.00</span></p>
             
                    @if ($product->auctionType->name == 'Private' || $product->auctionType->name == 'Timed')
                    <div class="countdown-time thisisdemoclass" data-id='{{ $product->id }}'
                            data-date='{{ $product->auction_end_date }}' id="countdown-{{ $product->id }}">
                            <ul>
                                <li><span class="days"></span>days</li>
                                <li><span class="hours"></span>Hours</li>
                                <li><span class="minutes"></span>Minutes</li>
                                <li><span class="seconds"></span>Seconds</li>
                            </ul>
                    </div>
                    @endif
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="./images/next-arrow.svg" alt=""></button>
                <div style="height: 15px;"></div>
              </div>
            </div>
          </a>
        </div>
        @endforeach

       </div>
      
        
        <ul class="pagination">
           
           {{ $products->appends($_GET)->links('pagination::bootstrap-5') }} 
       
        </ul>
       
    </div>
  </section>


    <script src="./js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="./js/bootstrap.js"></script>
    <script src="./js/slick.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
 <script>
  

  const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 1000;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});


function submitSearchForm() {
  var searchInputValue = document.getElementById('searchInput').value.trim();
  
  // Check if the search input is not empty
  if (searchInputValue !== '') {
      // Get the current URL
      var currentUrl = window.location.href;

      // Check if the URL already has parameters
      var separator = currentUrl.includes('?') ? '&' : '?';

      // Add the search parameter to the current URL
      var newUrl = currentUrl + separator + 'search=' + encodeURIComponent(searchInputValue);

      // Redirect to the new URL
      window.location.href = newUrl;
  }
}

document.addEventListener('DOMContentLoaded', function () {
  // Retrieve the search parameter from the URL
  var urlSearchParams = new URLSearchParams(window.location.search);
  var searchInputValue = urlSearchParams.get('search');

  // Set the search input value if it exists
  if (searchInputValue !== null) {
      document.getElementById('searchInput').value = decodeURIComponent(searchInputValue);
  }
});

</script>


@include('frontend.layouts.footer')
@include('frontend.products.script.addToWishListScript')