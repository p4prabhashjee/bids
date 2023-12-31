@include('frontend.layouts.header')

<section class="hero-ther">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6 text-center">
           <h1>Projects</h1>
          
            <form action="" class="search-frm-prdt" id="searchForm">
              <input type="text" name="search" id="searchInput" placeholder="Search projects...">
              <button type="button" onclick="submitSearchForm()"><img class="w-100" src="{{ asset('frontend/images/rounded-sr.svg') }}" alt=""></button>
            </form>
        </div>
      </div>
    </div>
  </section>
  <section class="list-fliter">
    <div class="container">
      <div class="result-lst">
        <h3>Showing all  results</h3>
        <div class="fliter-short">
          <form action="" class="cmn-frm">
            <select name="" id="" class="m-0">
              <option value="">Default sorting</option>
              <option value="">Default sorting</option>
              <option value="">Default sorting</option>
              <option value="">Default sorting</option>
            </select>
          </form>
          <button class="fliter-button btn btn-secondary" data-bs-target="#prtyfilter" data-bs-toggle="modal" data-bs-dismiss="modal" type="button">Filter <img class="ms-2" src="./images/filter.svg" alt=""></button>
        </div>
      </div>
    </div>
  </section>

  <section class="product-list-man">
    <div class="container">
      <div class="row">
        @foreach($projects as $pro)
            <div class="col-md-6">
            
                <div class="card-product">
                <a href="{{ url('products', $pro->slug) }}">
                <div class="product-image">
                        @if (!empty($pro->image_path))
                                <img src="{{ asset("img/projects/$pro->image_path") }}" alt="{{ $pro->title }}">
                            @else
                                <img src="{{ asset('frontend/images/default-product-image.png') }}" alt="Default Image">
                            @endif
                
                </div>
                </a>
                <div class="bid-box-status">
                    <div class="bid-box-status-ic"><img src="{{ asset('frontend/images/live.svg') }}"><span>{{ $pro->auctionType->name }}</span></div>
                </div>
                <div class="card-product-dtl">
                    <h3>{{$pro->name}}  </h3>
                    @if ($pro->auctionType->name == 'Live' || $pro->auctionType->name == 'Private')
                                    <h5>${{$pro->deposit_amount}}</h5>
                                    @endif
                    @php
                            $originalDateTime = $pro->start_date_time;
                            $timestamp = strtotime($originalDateTime);
                            $formattedDateTime = date("F j, g:i A", $timestamp);
                        @endphp
                    <p>{{  $formattedDateTime }}</p>
                    @php
                        $loggedInUserId = Auth::id();
                        $bidRequest = \App\Models\BidRequest::where('user_id', $loggedInUserId)
                            ->where('project_id', $pro->id)
                            ->first();
                    @endphp
                 
                    @if ($pro->auctionType->name == 'Timed')
                    <button class="text-btn">Bid Now <img class="img-fluid ms-2"
                            src="{{ asset('frontend/images/next-arrow.svg') }}" alt=""></button>
                    @elseif($bidRequest && $bidRequest->status == 1)
                      <button class="text-btn" onclick="bidNow()">Bid Now <img class="img-fluid ms-2"
                              src="{{ asset('frontend/images/next-arrow.svg') }}" alt=""></button>
                  @else
                  <button class="text-btn" onclick="requestBid('{{ $pro->name }}', '{{ $pro->id }}', '{{ $pro->auction_type_id }}', '{{ $pro->deposit_amount }}')">Request Bid <img class="img-fluid ms-2" src="{{ asset('frontend/images/next-arrow.svg') }}" alt=""></button>

                  @endif
                </div>
                </div>
           
            </div>
            @endforeach
      </div>
      
        <ul class="pagination">
        {{ $projects->appends($_GET)->links('pagination::bootstrap-5') }} 
        </ul>
       
    </div>
  </section>

  
  <div class="modal fade" id="prtyfilter" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          
          <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="prty-filter p-4">
              <h2 class="text-dark">Filter</h2>
              <form action="" class="cmn-frm mt-4">
                <div class="form-group">
                  <select name="" id="">
                    <option value="">Room type,</option>
                    <option value="">Room type,</option>
                  </select>
                </div>
                <div class="form-group mt-2">
                  <div class="wrapper mb-4">
                    <h3>Price</h3>
                    <div class="price-input">
                      <div class="field">
                        <span>Min Price</span>

                        <input type="number" class="input-min" value="2500">
                      </div> 
                      <div class="field">
                        <span>Max Price</span>
                        <input type="number" class="input-max" value="7500">
                      </div>
                    </div>
                    <div class="slider">
                      <div class="progress"></div>
                    </div>
                    <div class="range-input">
                      <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                      <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
                    </div>
                  </div>
                </div>
                <div class="form-group ">
                  <h3>Auction Type</h3>
                  <ul class="categry-list">
                    <li>
                      <div class="form-check">
                            <input class="form-check-input w-auto" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            Private
                            </label>
                          </div> </li>
                                              <li><div class="form-check">
                            <input class="form-check-input w-auto" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Timed
                            </label>
                          </div> </li>
                                              <li><div class="form-check">
                            <input class="form-check-input w-auto" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              Live
                            </label>
                          </div> </li>
                  </ul>
                </div>
                <div class="form-group mt-4">
                  <h3>Auction</h3>
                  <ul class="categry-list">
                    <li><div class="form-check">
                            <input class="form-check-input w-auto" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            Active
                            </label>
                          </div>
                           </li>
                    <li><div class="form-check">
                            <input class="form-check-input w-auto" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            Upcoming
                            </label>
                          </div>
                           </li>
                    <li><div class="form-check">
                            <input class="form-check-input w-auto" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            Ended
                            </label>
                          </div>
                           </li>
                    <li><div class="form-check">
                            <input class="form-check-input w-auto" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            All
                            </label>
                          </div>
                           </li>
                  </ul>
                </div>
                <div class="btn-submit-flter mt-5">
                  <button class="btn btn-secondary w-100">Apply filters</button>
                  <button class="btn btn-border w-100">Clear All</button>
                </div>
              </form>
            </div>
          </div>
           
        </div>
      </div>
    </div>

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

 
@include('frontend.layouts.requestbidscript')

@include('frontend.layouts.footer')
 