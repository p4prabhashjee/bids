@include('frontend.layouts.header')

<section class="hero-ther">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6 text-center">
           <h1>Products</h1>
           <p>Vivamus id ligula non turpis aliquam dignissim.  Fusce <br>
            tempor vulputate urna, quis malesuada.</p>
            <form action="" class="search-frm-prdt">
              <input type="text" name="" id="" placeholder="Search products...">
              <button><img class="w-100" src="{{asset('frontend/images/rounded-sr.svg')}}" alt=""></button>
            </form>
        </div>
      </div>
    </div>
  </section>
  <section class="list-fliter">
    <div class="container">
      <div class="result-lst">
        <h3>Showing all 9 results</h3>
        <div class="fliter-short">
          <form action="" class="cmn-frm">
            <select name="" id="" class="m-0">
              <option value="">Default sorting</option>
              <option value="">Default sorting</option>
              <option value="">Default sorting</option>
              <option value="">Default sorting</option>
            </select>
          </form>
          <button class="fliter-button btn btn-secondary" data-bs-target="#prtyfilter" data-bs-toggle="modal" data-bs-dismiss="modal" type="button">Filter <img class="ms-2" src="{{asset('frontend/images/filter.svg')}}" alt=""></button>
        </div>
      </div>
    </div>
  </section>

  <section class="product-list-man">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <a href="detail.html">
            <div class="card-product">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="detail.html">
            <div class="card-product">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 ">
          <a href="detail.html">
            <div class="card-product live-procut">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img-5.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <div class="countdown-time" id="countdown">
                  <ul>
                    <li><span id="days"></span>days</li>
                    <li><span id="hours"></span>Hours</li>
                    <li><span id="minutes"></span>Minutes</li>
                    <li><span id="seconds"></span>Seconds</li>
                  </ul>
                </div>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="detail.html">
            <div class="card-product live-procut">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img-6.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <div class="countdown-time" id="countdown">
                  <ul>
                    <li><span id="days"></span>days</li>
                    <li><span id="hours"></span>Hours</li>
                    <li><span id="minutes"></span>Minutes</li>
                    <li><span id="seconds"></span>Seconds</li>
                  </ul>
                </div>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="">
            <div class="card-product live-procut">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img-4.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <div class="countdown-time" id="countdown1">
                  <ul>
                    <li><span id="days1"></span>days</li>
                    <li><span id="hours1"></span>Hours</li>
                    <li><span id="minutes1"></span>Minutes</li>
                    <li><span id="seconds1"></span>Seconds</li>
                  </ul>
                </div>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class=" col-md-6">
          <a href="detail.html">
            <div class="card-product live-procut">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img-3.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <div class="countdown-time" id="countdown">
                  <ul>
                    <li><span id="days"></span>days</li>
                    <li><span id="hours"></span>Hours</li>
                    <li><span id="minutes"></span>Minutes</li>
                    <li><span id="seconds"></span>Seconds</li>
                  </ul>
                </div>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="detail.html">
            <div class="card-product">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="detail.html">
            <div class="card-product">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6 ">
          <a href="detail.html">
            <div class="card-product live-procut">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img-5.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <div class="countdown-time" id="countdown">
                  <ul>
                    <li><span id="days"></span>days</li>
                    <li><span id="hours"></span>Hours</li>
                    <li><span id="minutes"></span>Minutes</li>
                    <li><span id="seconds"></span>Seconds</li>
                  </ul>
                </div>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="detail.html">
            <div class="card-product live-procut">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img-6.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <div class="countdown-time" id="countdown">
                  <ul>
                    <li><span id="days"></span>days</li>
                    <li><span id="hours"></span>Hours</li>
                    <li><span id="minutes"></span>Minutes</li>
                    <li><span id="seconds"></span>Seconds</li>
                  </ul>
                </div>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a href="detail.html">
            <div class="card-product live-procut">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img-4.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <div class="countdown-time" id="countdown1">
                  <ul>
                    <li><span id="days1"></span>days</li>
                    <li><span id="hours1"></span>Hours</li>
                    <li><span id="minutes1"></span>Minutes</li>
                    <li><span id="seconds1"></span>Seconds</li>
                  </ul>
                </div>
                <button class="text-btn" >Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
        <div class=" col-md-6">
          <a href="detail.html">
            <div class="card-product live-procut">
              <div class="product-image">
                <img src="{{asset('frontend/images/product-img-3.png')}}" alt="">
                <i class="fa fa-heart-o"></i>
              </div>
              <div class="card-product-dtl">
                <h3>luxurious golden jewelry  </h3>
                <h5>$1200.00</h5>
                <p>Current Bid: <span> $1400.00</span></p>
                <div class="countdown-time" id="countdown">
                  <ul>
                    <li><span id="days"></span>days</li>
                    <li><span id="hours"></span>Hours</li>
                    <li><span id="minutes"></span>Minutes</li>
                    <li><span id="seconds"></span>Seconds</li>
                  </ul>
                </div>
                <button class="text-btn">Bid Now <img class="img-fluid ms-3" src="{{asset('frontend/images/next-arrow.svg')}}" alt=""></button>
              </div>
            </div>
          </a>
        </div>
      </div>
      
        <ul class="pagination">
          <li><a href=""><img src="{{asset('frontend/images/left-1.svg')}}" alt=""></a></li>
          <li><a href="">1</a></li>
          <li><a   class="active" href="">2</a></li>
          <li><a href="">3</a></li>
          <li><a href=""><img src="{{asset('frontend/images/left-1.svg')}}" alt=""></a></li>
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

    
    

    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{asset('frontend/js/bootstrap.js')}}"></script>
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
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

 </script>
@include('frontend.layouts.footer')
 