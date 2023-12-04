@include('frontend.layouts.header')
<style type="text/css">
    /*----------------------*/
    .base-timer {
      position: relative;
      width: 190px;
      height: 190px;
      margin:30px auto 0;
    }

    .base-timer__svg {
      transform: scaleX(-1);
    }

    .base-timer__circle {
      fill: none;
      stroke: none;
    }

    .base-timer__path-elapsed {
      stroke-width: 6px;
      stroke: #efefef;
    }

    .base-timer__path-remaining {
      stroke-width: 4px;
      stroke-linecap: round;
      transform: rotate(90deg);
      transform-origin: center;
      transition: 1s linear all;
      fill-rule: nonzero;
      stroke: currentColor;
    }

    .base-timer__path-remaining.green {
      color: #39b37d;
    }

    .base-timer__path-remaining.orange {
      color: orange;
    }

    .base-timer__path-remaining.red {
      color: red;
    }

    .base-timer__label {
      position: absolute;
      width: 190px;
      height: 190px;
      top: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 30px;
      font-weight: 600;
      letter-spacing: 0.3px;
    }
    .timer-countdn {
    position: relative;
    border-radius: 20px;
}
    .timer-countdn .close{
      position: absolute;
    right: 10px;
    top: 0px;
    background: transparent;
    border: 0;
    padding: 0;
    font-size: 35px;
    }
    .timer-countdn h4{
      font-size: 30px;
      color: #000;
    }

    .bid-and-time {
    margin-top: 24px;
    }
    .prty-sect{
      background: #3e0269;
      padding: 10px;
    }
        .prty-sect p, .prty-sect a{
          color: #fff;
        }
  </style>
<section class="prty-sect">
    <div class="container">
        <div class="row ">
            <div class=" ">
                <p class="m-0">
                <a href="#"> Home /</a> Auction Type /project 
                </p>

            </div>
        </div>
    </div>
</section>
<section class="detail-section">
    <div class="container">
      <div class="row">
      <h3>{{$product->lot_no}} : {{$product->title}}</h3>
        <div class="col-md-6">
       

          <div class="product-imgs mt-4">
            <div class="heat-like wishlist-heart @if(in_array($product->id, $wishlist)) active @endif" data-product-id="{{ $product->id }}">
              <input type="checkbox" name="" id="" @if(in_array($product->id, $wishlist)) checked @endif>
              <img src="{{asset('frontend/images/heart.png')}}" alt="">
          </div>
           <div class="img-select">
            @if ($product->galleries->isNotEmpty())
                        @foreach ($product->galleries as $gallery)
                        <div class="img-item">
                            <a href="#" data-id="{{ $loop->index + 1 }}">
                                <img src="{{ asset($gallery->image_path) }}" alt="shoe image"/>
                            </a>
                        </div>
                        @endforeach
                        @else
                        <div class="img-item">
                            <a href="#" data-id="1">
                                <img src="{{ asset('frontend/images/default-product-image.svg') }}" alt="shoe image"/>
                            </a>
                        </div>
                        @endif
            </div>
            <div class="img-display">
              <div class="img-showcase">
              @if ($product->galleries->isNotEmpty())
                            @foreach ($product->galleries as $gallery)
                            <img src="{{ asset($gallery->image_path) }}" alt="shoe image">
                            @endforeach
                            @else
                            <img src="{{ asset('frontend/images/default-product-image.png') }}" alt="shoe image" />
                            @endif
              </div>
            </div>
           
          </div>
          <div class="product-desc">
            <h4>Description</h4>
            <p>
            {{ strip_tags($product->description) }}
            </p>
            
          </div>
          
        </div>
      
        <div class="col-md-6">
        <div class="bid-and-time">
          <h4>Current Bid <span>$20,0379.00</span></h4>
          @if ($product->auctionType->name == 'Private' || $product->auctionType->name == 'Timed')
              @php
                  $currentTime = now()->timestamp; // Get current timestamp
                  $auctionEndTime = strtotime($product->auction_end_date); 
              @endphp
              @if ($currentTime < $auctionEndTime)
                  <div class="crt_bid">
                      <h6>Bidding Closes In</h6>
                      <div class="countdown-time thisisdemoclass" data-id='{{ $product->id }}' data-date='{{ $product->auction_end_date }}' id="countdown-{{ $product->id }}">
                          <ul>
                              @if ($product->auctionType->name == 'Private' || $product->auctionType->name == 'Timed')
                                  <li class="days-wrapper"><span class="days"></span>D</li>
                                  <li>:</li>
                              @endif
                              <li><span class="hours"></span>H</li>
                              <li>:</li>
                              <li><span class="minutes"></span>M</li>
                              <li>:</li>
                              <li><span class="seconds"></span>S</li>
                          </ul>
                      </div>
                  </div>
              @else
                  <p><span style="color: red;">Lot closed</span></p>
              @endif
          @else
              <p><span style="color: red;">Lot closed</span></p>
          @endif
        </div>
        @php
            $currentTime = now()->timestamp; 
            $auctionEndTime = strtotime($product->auction_end_date); 
        @endphp
        @if($bidRequest)
      <!-- @unless ($currentTime >= $auctionEndTime) -->
        <div class="bid-now-container">
            <div class="product-feature-box">
                <h4>BID NOW <img src="{{ asset('frontend/images/line.svg') }}" alt="" /></h4>
                <p>Bid Amount: Minimum Bid {{$product->reserved_price}}$</p>
                <p>Set Max Bid</p>
                <form action="" class="news-letter" id="bidForm">
                    <div class="form-group">
                        <select id="bidValueSelect">
                            @foreach ($calculatedBids as $bidValue)
                                <option value="{{ $bidValue }}">$ {{ $bidValue }}</option>
                            @endforeach
                        </select>
                        @if(Auth::check())
                            <button type="button" id="placeBidButton" data-bs-toggle="modal" data-bs-target="#myModal">Place Bid</button>
                            
                        @else
                            <button type="button" id="loginFirstButton">Place Bid</button>
                        @endif
                    </div>
              </form>
            </div>
        </div>
    <!-- @endunless -->
    @endif


          <div class="product-feature-box">
            <h4>{{$product->project->name}} <img src="{{ asset('frontend/images/line.svg') }}" alt="" /></h4>
          @php
            $originalDateTime = $product->project->start_date_time;
            $timestamp = strtotime($originalDateTime);
            $formattedDateTime = date("F j, g:i A", $timestamp);
         @endphp
            <p>{{$formattedDateTime}} <img class="ms-3" src="{{ asset('frontend/images/private.svg')}}"> <span >{{ $product->auctionType->name }}</span></p>
          </div>
           
          <div class="product-feature-box">
            <h4>Share Now <img src="{{ asset('frontend/images/line.svg') }}" alt="" /></h4>
            <ul class="social-link mt-4">
              <li>
                <a href="https://www.youtube.com/hashtag/youtubelink"><img src="{{ asset('frontend/images/youtube.svg') }}" alt=""></a>
              </li>
              <li>
                <a href="https://twitter.com/i/flow/login"><img src="{{ asset('frontend/images/twitter.svg') }}" alt=""></a>
              </li>
              <li>
                <a href="https://www.facebook.com/login/"><img src="{{ asset('frontend/images/facebook.svg') }}" alt=""></a>
              </li>
              <li>
                <a href="https://www.instagram.com/accounts/login/?hl=en"><img src="{{ asset('frontend/images/instagram.svg') }}" alt=""></a>
              </li>
              <li>
                <a href="https://www.linkedin.com/login"><img src="{{ asset('frontend/images/linkdin.png') }}" alt=""></a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </section>

  
  <div class="modal fade" id="prtyfilter" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="prty-filter p-4">
            <h2>Filter</h2>
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

                      <input type="number" class="input-min" value="2500" />
                    </div>
                    <div class="field">
                      <span>Max Price</span>
                      <input type="number" class="input-max" value="7500" />
                    </div>
                  </div>
                  <div class="slider">
                    <div class="progress"></div>
                  </div>
                  <div class="range-input">
                    <input type="range" class="range-min" min="0" max="10000" value="2500" step="100" />
                    <input type="range" class="range-max" min="0" max="10000" value="7500" step="100" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <h3>Auction Type</h3>
                <ul class="categry-list">
                  <li>
                    <input type="radio" name="1" id="" class="w-auto" />
                    Private
                  </li>
                  <li>
                    <input type="radio" name="1" id="" class="w-auto" /> Timed
                  </li>
                  <li>
                    <input type="radio" name="1" id="" class="w-auto" /> Live
                  </li>
                </ul>
              </div>
              <div class="form-group mt-4">
                <h3>Auction</h3>
                <ul class="categry-list">
                  <li>
                    <input type="radio" name="2" id="" class="w-auto" />
                    Active
                  </li>
                  <li>
                    <input type="radio" name="2" id="" class="w-auto" />
                    Upcoming
                  </li>
                  <li>
                    <input type="radio" name="2" id="" class="w-auto" /> Ended
                  </li>
                  <li>
                    <input type="radio" name="2" id="" class="w-auto" /> All
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


  <!-- <div id="alert-modal" class="modal fade " role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
         
        <div class="modal-body timer-countdn text-center py-5" id="base-timer-path-background">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <div class=" text-center">
            <h4>Live Auction</h4>
          </div> 
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div id="revese-timer" data-minute="1"></div>
              </div>
            </div>
          </div>
        </div>
        
      </div>

    </div>
  </div> -->


  <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->

      <!-- Modal body -->
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        <h4 class="modal-title">Submit Your Bid</h4>   
        <p>Select the highest amount you are willing to bid. If you are outbid, we will increase your bid by one increment, up to your max.</p>
      </div>
      <form>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
            <label>Estimate : ${{$product->start_price}} - ${{$product->end_price}}</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Current bid : $60 AUD</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
            <label>Your max bid <i class="fa fa-info-circle" title="Max Bid"></i></label>
                  <select class="form-control" id="bidValueSelect">
                      @foreach ($calculatedBids as $bidValue)
                          <option value="{{ $bidValue }}">$ {{ $bidValue }}</option>
                      @endforeach
                  </select>
            </div>
          </div>
          <div class="col-md-12">
          <div class="form-group">
              <label>Buyer's Premium <i class="fa fa-info-circle" id="buyerPremiumToolTip" data-toggle="tooltip" data-placement="right" title="If you win, you agree to pay a buyer's premium of up to bid value and any applicable taxes as described in the terms and conditions."><a href="#" class="ml-1" onclick="showTerms()">See Terms and Conditions</a></i> : ${{$project->buyers_premium}}</label>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label><b>Total : $89.60 AUD (+Shipping, taxes & fees)</b></label>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12"><h3>Shipping Address</h3></div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="" placeholder="laxmikant" class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="" placeholder="sharma"  class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" name="" placeholder="Address Line1"  class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="" placeholder="City"  class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <select  class="form-control">
                <option>Select Country</option>
                <option>Select Country</option>
                <option>Select Country</option>
                <option>Select Country</option>
                <option>Select Country</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="" placeholder="Zip Code"  class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="" placeholder="Province"  class="form-control">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <input type="text" name="" placeholder="Phone Number"  class="form-control">
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
              <h3>Card Details</h3>
              <p>You won’t be charged unless you win. If you win, the auction house may auto-charge this card 2 days after the invoice is sent.</p>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input class="form-control" placeholder="Card Number">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" placeholder="MM/YYYY">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" placeholder="CNV">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input class="form-control" placeholder="Name on Card">
              </div>
            </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group text-center">
              <a href="" class="btn btn-secondary">Place Bid</a>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
  <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
  <script src="{{ asset('frontend/js/main.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
  <script>
    const imgs = document.querySelectorAll(".img-select a");
    const imgBtns = [...imgs];
    let imgId = 1;

    imgBtns.forEach((imgItem) => {
      imgItem.addEventListener("click", (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
      });
    });

    function slideImage() {
      const displayWidth = document.querySelector(
        ".img-showcase img:first-child"
      ).clientWidth;

      document.querySelector(".img-showcase").style.transform = `translateX(${-(imgId - 1) * displayWidth
        }px)`;
    }

    window.addEventListener("resize", slideImage);


    $(document).ready(function () {
      $('#alert-modal').modal('show');
    });



    // --------Reveser-timer-----------
    if ($('#revese-timer').length) {

      const FULL_DASH_ARRAY = 283;
      const WARNING_THRESHOLD = 15;
      const ALERT_THRESHOLD = 10;

      const COLOR_CODES = {
        info: {
          color: "green"
        },
        warning: {
          color: "orange",
          threshold: WARNING_THRESHOLD
        },
        alert: {
          color: "red",
          threshold: ALERT_THRESHOLD
        }
      };


      var Minute = $('#revese-timer').data('minute');
      var Seconds = Math.round(60 * Minute);
      const TIME_LIMIT = Seconds;
      let timePassed = 0;
      let timeLeft = TIME_LIMIT;
      let timerInterval = null;
      let remainingPathColor = COLOR_CODES.info.color;

      document.getElementById("revese-timer").innerHTML = `
        <div class="base-timer">
          <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <g class="base-timer__circle">
              <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
              <path
                id="base-timer-path-remaining"
                stroke-dasharray="283"
                class="base-timer__path-remaining ${remainingPathColor}"
                d="
                  M 50, 50
                  m -45, 0
                  a 45,45 0 1,0 90,0
                  a 45,45 0 1,0 -90,0
                "
              ></path>
            </g>
          </svg>
          <span id="base-timer-label" class="base-timer__label">${formatTime(
        timeLeft
      )}</span>
        </div>
        `;

      startTimer();

      function onTimesUp() {
        clearInterval(timerInterval);
      }

      function startTimer() {
        timerInterval = setInterval(() => {
          timePassed = timePassed += 1;
          timeLeft = TIME_LIMIT - timePassed;
          document.getElementById("base-timer-label").innerHTML = formatTime(
            timeLeft
          );
          setCircleDasharray();
          setRemainingPathColor(timeLeft);

          if (timeLeft === 0) {
            onTimesUp();
          }
        }, 1000);
      }

      function formatTime(time) {
        const minutes = Math.floor(time / 60);
        let seconds = time % 60;

        if (seconds < 10) {
          seconds = `0${seconds}`;
        }

        return `${minutes}:${seconds}`;
      }

      function setRemainingPathColor(timeLeft) {
        const { alert, warning, info } = COLOR_CODES;
        if (timeLeft <= alert.threshold) {
          document
            .getElementById("base-timer-path-remaining")
            .classList.remove(warning.color);
          document
            .getElementById("base-timer-path-remaining")
            .classList.add(alert.color);

          var element = document.getElementById("base-timer-path-background")
          element.style.backgroundColor = ('#FFD9D9');
        } else if (timeLeft <= warning.threshold) {
          document
            .getElementById("base-timer-path-remaining")
            .classList.remove(info.color);
          document
            .getElementById("base-timer-path-remaining")
            .classList.add(warning.color);

          var element = document.getElementById("base-timer-path-background")
          element.style.backgroundColor = ('#FFECDF');
        }
      }

      function calculateTimeFraction() {
        const rawTimeFraction = timeLeft / TIME_LIMIT;
        return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
      }

      function setCircleDasharray() {
        const circleDasharray = `${(
          calculateTimeFraction() * FULL_DASH_ARRAY
        ).toFixed(0)} 283`;
        document
          .getElementById("base-timer-path-remaining")
          .setAttribute("stroke-dasharray", circleDasharray);
      }

    }


  </script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
 document.addEventListener('DOMContentLoaded', function () {
 const placeBidButton = document.getElementById('placeBidButton');
 const loginFirstButton = document.getElementById('loginFirstButton');

 if (placeBidButton) {
     placeBidButton.addEventListener('click', function () {
         const bidValue = document.getElementById('bidValueSelect').value;
         const projectId = '{{ $product->project->id }}'; 
         const auctionTypeId = '{{ $product->auctionType->id }}'; 
         const productId = '{{ $product->id }}'; 


         axios.post('{{ route("bidplaced") }}', {
             user_id: '{{ Auth::id() }}',
             project_id: projectId,
             auction_type_id:auctionTypeId, 
             bid_amount: bidValue,
             product_id: productId,
         })
         .then(function(response) {
             console.log(response.data.message); 
             
         })
         .catch(function(error) {
             console.error(error); 
             
         });
     });
 }

     if (loginFirstButton) {
         loginFirstButton.addEventListener('click', function () {
             
             Swal.fire({
                 icon: 'info',
                 title: 'Please Login First',
                 text: 'You need to log in For Place Bid.',
                 showCancelButton: true,
                 confirmButtonText: 'Login'
             }).then((result) => {
                 if (result.isConfirmed) {

                     localStorage.setItem('redirect_url', window.location.href);

                     window.location.href = '{{ route("signin") }}';
                 } else if (result.dismiss === Swal.DismissReason.cancel) {
                     window.location.reload();
                 }
             });
             return;
         });
     }
 });
</script>

    
     
    @include('frontend.layouts.footer')
@include('frontend.products.script.addToWishListScript')

